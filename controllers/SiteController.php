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
use yii\data\Pagination;

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
        
        $category_obj = new Category;
        $categoriesForSidebar = $category_obj->getAllCategories();
        $brends = Product::getBrends();
        $types = Product::getTypesForSidebar();
    
        
        return $this->render('catalog', [
            'products' => $data['products'],
            'pagination' => $data['pagination'],
            'categoriesForSidebar' => $categoriesForSidebar,
            'brends' => $brends,
            'types' => $types,
        ]);
    }
    
    public function actionBrend($title = NULL) {
        
        $product_obj = new Product;
        $data = $product_obj->getProductsBrend($title);
        
        $category_obj = new Category;
        $categoriesForSidebar = $category_obj->getAllCategories();
        $brends = Product::getBrends();
        $types = Product::getTypesForSidebar();

        return $this->render('catalog', [
            'products' => $data['products'],
            'pagination' => $data['pagination'],
            'categoriesForSidebar' => $categoriesForSidebar,
            'brends' => $brends,
            'types' => $types,
        ]);
    }
    
    public function actionProductDetail($id = NULL) {
        
        $product_obj = new Product;
        $product = $product_obj->getProductDetail($id);
        
        $category_obj = new Category;
        $categoriesForSidebar = $category_obj->getAllCategories();
        $brends = Product::getBrends();
        $types = Product::getTypesForSidebar();
        
        $relatedProducts = Product::getRecomendProducts();
        
        return $this->render('productDetail', [
            'product' => $product,
            'relatedProducts' => $relatedProducts,
            'categoriesForSidebar' => $categoriesForSidebar,
            'brends' => $brends,
            'types' => $types,
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
     * Login action.
     *
     * @return Response|string
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }

        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
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
}
