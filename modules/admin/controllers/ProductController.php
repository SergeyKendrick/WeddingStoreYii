<?php

namespace app\modules\admin\controllers;

use Yii;
use app\models\Product;
use app\models\ProductSearch;
use app\models\Category;
use app\models\ProductPhoto;
use app\models\ImageUpload;
use app\models\Discounts;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\UploadedFile;
use yii\filters\VerbFilter;
use yii\helpers\ArrayHelper;


/**
 * ProductController implements the CRUD actions for Product model.
 */
class ProductController extends Controller
{
    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'verbs' => [
                'class' => VerbFilter::className(),
                'actions' => [
                    'delete' => ['POST'],
                ],
            ],
        ];
    }

    /**
     * Lists all Product models.
     * @return mixed
     */
    public function actionIndex()
    {
        $searchModel = new ProductSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

        
        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Product model.
     * @param integer $id
     * @return mixed
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model['category_id'] = $model->category->title;
        if($model['discount']) {
            $model['price'] = $model['price'] - $model['price']/100*$model['discount']." (Основная цена: ".$model['price'].")";
        }
        
        $product = new Product;
        $path = ImageUpload::getFolderProductForView();
        $photos = $product->getImages($id);
        foreach($photos as $photo) {
            $img[] = $photo['filename'];
        }
            
        return $this->render('view', [
            'model' => $model,
            'img' => $img,
            'path' => $path,
        ]);
    }

    /**
     * Creates a new Product model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Product();

        if ($model->load(Yii::$app->request->post()) && $model->saveProduct()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('create', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Updates an existing Product model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param integer $id
     * @return mixed
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        } else {
            return $this->render('update', [
                'model' => $model,
            ]);
        }
    }

    /**
     * Deletes an existing Product model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param integer $id
     * @return mixed
     */
    public function actionDelete($id)
    {
        $productPhoto = new ProductPhoto;
        
        $productPhoto->deleteAllImages($id);
        
        $this->findModel($id)->delete();

        return $this->redirect(['index']);
    }
    
    public function actionSetCategory($id) 
    {
        $product = $this->findModel($id);
        
        $categories = ArrayHelper::map(Category::find()->all(), 'id', 'title');
        $selectedCategory = $product->category->id;
        
        if(Yii::$app->request->isPost) {
            $category = Yii::$app->request->post('Category');
            
            if($product->saveCategory($category)) {
                return $this->redirect(['view', 'id' => $product->id]);
            }
        }
        
        return $this->render('category', [
            'model' => $product,
            'categories' => $categories,
            'selectedCategory' => $selectedCategory,
        ]);
    }
    
    public function actionSetImages($id) {
        $product = $this->findModel($id);
        $model = new ImageUpload;
        $savePhoto = new ProductPhoto;
        
        $path = ImageUpload::getFolderProductForView();
        $img = $product->getImagesArray($id);
        
        if(Yii::$app->request->isPost) {
            $savePhoto = new ProductPhoto;
            $imageFiles = UploadedFile::getInstances($model, 'imageFiles');
            
            if($savePhoto->checkCountImg($id, $imageFiles)) {
                $message = $savePhoto->checkCountImg($id, $imageFiles);
                return $this->render('images', ['model' => $model, 'img' => $img, 'path' => $path, 'message' => $message]);
            }
            
            if($savePhoto->saveImages($product->id, $imageFiles)) {
                return $this->redirect(['view', 'id' => $product->id]);
            }
        }
        
        return $this->render('images', ['model' => $model, 'img' => $img, 'path' => $path]);
        
    }
    
    public function actionDeleteImage($id, $filename) {
        $product = new Product;
        $productPhoto = new ProductPhoto;
        
        $productPhoto->deleteImage($filename);
        $product->deleteImage($filename);
        
        return $this->redirect(['view', 'id' => $id]);
        
    }
    
    public function actionAddCoupon($id) {
        $model = $this->findModel($id);
        
        
        if(Yii::$app->request->isPost) {
            $coupon = Yii::$app->request->post('Product');
            
            $discount = new Discounts;
            
            if($discount->saveCoupon($model->id, $coupon)) {
                $this->redirect(['view', 'id' => $model->id]);
            }
            
        }
        
        return $this->render('discount', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Product model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param integer $id
     * @return Product the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    protected function findModel($id)
    {
        if (($model = Product::findOne($id)) !== null) {
            return $model;
        } else {
            throw new NotFoundHttpException('The requested page does not exist.');
        }
    }
}
