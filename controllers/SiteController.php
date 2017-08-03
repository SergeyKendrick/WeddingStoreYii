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
    
    public function actionWedding($id = NULL) {
        
        $product_obj = new Product;
        
        $data = $product_obj->getProducts($id, 'Одежда');
        
        return $this->render('catalog', [
            'products' => $data['products'],
            'pagination' => $data['pagination'],
        ]);
    }
    
    public function actionBrideStyle($id = NULL) {
        $product_obj = new Product;
        
        $data = $product_obj->getProducts($id, 'Украшения');
        
        return $this->render('catalog', [
            'products' => $data['products'],
            'pagination' => $data['pagination'],
        ]);
    }
    
    public function actionBrend($title = NULL) {
        
        $product_obj = new Product;
        
        $data = $product_obj->getProductsBrend($title);

        return $this->render('catalog', [
            'products' => $data['products'],
            'pagination' => $data['pagination'],
        ]);
    }
    
    public function actionProductDetail() {
        
        return $this->render('productDetail');
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
}
