<?php

namespace app\controllers;

use Yii;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;
use yii\filters\VerbFilter;
use app\models\LoginForm;
use app\models\ContactForm;
use app\models\Product;
use app\models\ImageUpload;
use app\models\Category;
use app\models\SignupForm;
use app\models\User;
use app\models\Cart;
use app\models\Discounts;
use app\models\Article;
use app\models\Sidebar;
use yii\data\Pagination;
use yii\web\Cookie;
use yii\web\CookieCollection;

class SiteController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::className(),
                'only' => ['logout'],
                'rules' => [
                    [
                        'actions' => ['logout'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => 'yii\web\ErrorAction',
            ],
            'captcha' => [
                'class' => 'yii\captcha\CaptchaAction',
                'fixedVerifyCode' => YII_ENV_TEST ? 'testme' : null,
            ],
        ];
    }
    
    /**
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        
        $cart = new Cart;

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            $cart->addToCartAfterLogin();
            return $this->goBack();
        }
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->goHome();
    }
    
    public function actionSignup() {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $login = new LoginForm();
        $model = new SignupForm();
        
        if(Yii::$app->request->post()) {
            if(!$model->load(Yii::$app->request->post())) {
                if ($login->load(Yii::$app->request->post()) && $login->login()) {
                    return $this->goHome();
                }
            } else {
                $model->load(Yii::$app->request->post());
                if($model->signup()) {
                    return $this->redirect(['site/login']);
                } 
            }
        }
        
        return $this->render('signup', ['model'=>$model, 'login'=>$login]);
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        $newProducts = Product::getNewProducts();
        $recomendProducts = Product::getRecomendProducts();
        $imgPath = ImageUpload::getFolderProduct();
        
        return $this->render('index', [
            'newProducts' => $newProducts,
            'recomendProducts' => $recomendProducts,
            'imgPath' => $imgPath,
        ]);
    }
    
    public function actionCatalog($id = NULL, $title = NULL) {
        $product_obj = new Product;
        $data = $product_obj->getProducts($id, $title);
        
        $sidebar = Sidebar::getItems();
        
        return $this->render('catalog', [
            'products' => $data['products'],
            'pagination' => $data['pagination'],
            'sidebar' => $sidebar,
        ]);
    }
    
    public function actionProductDetail($id = NULL) {
        
        $product_obj = new Product;
        $product = $product_obj->getProductDetail($id);
        
        $sidebar = Sidebar::getItems();
        
        $relatedProducts = Product::getRecomendProducts();
        
        return $this->render('productDetail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'sidebar' => $sidebar,
        ]);
    }
    
    public function actionSubmit() {
        $sidebar_obj = new Sidebar;
        
        if(Yii::$app->request->isPost) {
            $post = Yii::$app->request->post();
            $data = $sidebar_obj->getProducts($post);
            $sidebar = Sidebar::getItems();
        
            return $this->render('catalog', [
                'products' => $data['products'],
                'pagination' => $data['pagination'],
                'sidebar' => $sidebar,
            ]);
        }
    }
    
    public function actionBrend($title = NULL) {
        
        $product_obj = new Product;
        $data = $product_obj->getProductsBrend($title);
        
        $sidebar = Sidebar::getItems();

        return $this->render('catalog', [
            'products' => $data['products'],
            'pagination' => $data['pagination'],
            'sidebar' => $sidebar,
        ]);
    }
    
    public function actionRating($product_id, $count) {
        $product = new Product;
        if(!$product->setRating($product_id, $count)) {
            return "Error";
        }
        
        return $this->redirect(['site/product-detail', 'id' => $product_id]);
    }

    /**
     * Displays contact page.
     *
     * @return Response|string
     */
    public function actionContact()
    {
        $model = new ContactForm();
        if ($model->load(Yii::$app->request->post()) && $model->contact(Yii::$app->params['adminEmail'])) {
            Yii::$app->session->setFlash('contactFormSubmitted');

            return $this->refresh();
        }
        return $this->render('contact', [
            'model' => $model,
        ]);
    }

    /**
     * Displays about page.
     *
     * @return string
     */
    public function actionAbout()
    {
        return $this->render('about');
    }
    
    public function actionOffice() {
        $user = new User;
        $id = Yii::$app->user->id;
        $userInfo = $user->findByUserId($id);
        
        return $this->render('office', [
            'userInfo' => $userInfo,
        ]);
    }
    
    public function actionCart() {
        
        $cart = new Cart;
        $session = Yii::$app->session; 
        
        if($session['products']) {
            $orders = $cart->getOrders($session['products']);
        } else {
            $orders = $cart->getOrders();
        }
        
        $total_count = Cart::getCountOrders();
        $data = $cart->priceWork($orders);
        
        return $this->render('cart', [
            'orders' => $orders,
            'total_count' => $total_count,
            'total_price_orders' => $data['total_price_orders'],
            'discount' => $data['discount'],
            'total_price' => $data['total_price'],
        ]);
    }
    
    public function actionAddCart($item_quantity, $product_id, $price) {
        $cart = new Cart;
        
        if(Yii::$app->user->isGuest) {
            $products = $cart->addToCartForGuest($item_quantity, $product_id, $price);
            
            return $this->redirect($_SERVER['HTTP_REFERER']);
        }
         
        $cart->addToCart(Yii::$app->user->id, $item_quantity, $product_id, $price);
        
        return $this->redirect($_SERVER['HTTP_REFERER']);
    }
    
    public function actionDeleteOrder($id) {
        $cart = new Cart;
        
        if($cart->deleteOrder($id)) {
            $this->redirect('cart');
        }
    }
    
    public function actionApplyCoupon($code) {
        $discount = new Discounts;
        
        $discount->applyCoupon($code);
        
        $this->redirect(['cart']);
    }
    
    public function actionArticle($id) {
        $article_obj = new Article;
        $article = $article_obj->getArticle($id);
        
        return $this->render('article', [
            'article' => $article,
        ]);
    }
    
}
