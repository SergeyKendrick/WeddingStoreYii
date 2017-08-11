<?php

namespace app\models;


use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "product".
 *
 * @property integer $id
 * @property string $sku
 * @property string $title
 * @property integer $category_id
 * @property string $description
 * @property integer $price
 * @property string $brand
 * @property string $pearl_type
 * @property string $color
 * @property string $base_material
 * @property string $precious_artif
 * @property string $model_number
 * @property string $occasion
 * @property string $type
 * @property string $ideal_for
 * @property integer $discount
 * @property integer $rating_id
 */
class Product extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    
    public $photo_preview;
    
    public $pricedown;
    
    public $coupon;
    
    public static function tableName()
    {
        return 'product';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['category_id', 'price', 'discount', 'rating'], 'integer'],
            [['description'], 'string'],
            [['sku', 'title', 'brand', 'pearl_type', 'color', 'base_material', 'precious_artif', 'model_number', 'occasion', 'type', 'ideal_for'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'sku' => 'Артикул',
            'title' => 'Заголовок',
            'category_id' => 'Категория',
            'description' => 'Описание',
            'price' => 'Цена',
            'brand' => 'Бренд',
            'pearl_type' => 'Тип жемчуга',
            'color' => 'Цена',
            'base_material' => 'Материал',
            'precious_artif' => 'Драгоценный/искусственный',
            'model_number' => 'Номер модели',
            'occasion' => 'Повод применения',
            'type' => 'Тип',
            'ideal_for' => 'Идеален для..',
            'discount' => 'Скидка (%)',
            'rating' => 'Рейтинг',
        ];
    }
    
    public function saveImageFile($filename, $currentImage) {
        
        $this->deleteCurrentImage($currentImage);
        
        $this->image = $filename;
        
        return $this->save(false); //Передаем false чтобы не проходить валидацию самой статьи
         
    }
    
    public function deleteCurrentImage($currentImage) {
        if(file_exists(Yii::getAlias('@web').'images/products/' . $currentImage) && $currentImage) {
            unlink(Yii::getAlias('@web').'images/products/' . $currentImage);
        }
    }
    
    public function deleteImage($filename) {

        $this->deleteCurrentImage($filename);
    }
    
    public function getImages($id) {
        return ProductPhoto::find()->select('filename')->where(['product_id' => $id])->asArray()->all();
    }
    
    public function getImagesArray($id) {
        $photos = ProductPhoto::find()->select('filename')->where(['product_id' => $id])->asArray()->all();
        foreach($photos as $photo) {
            $img[] = $photo['filename'];
        }
        
        return $img;
    }
    
    public function checkCountUploads($files) {
        $i = 0;
        
        foreach($files as $file) {
            $i++;
        }
        
        return $i;
    }
    
    public function saveProduct() {
        $this->date = date('Y-m-d');
        return $this->save();
    }
    
    public function getCategory() {
        return $this->hasOne(Category::className(), ['id' => 'category_id']);
    }
    
    public function saveCategory($category_id) {
        $category = Category::findOne($category_id);
        
        if($category) {
            $this->link('category', $category);
            return true;
        }
    }
    
    public static function getRecomendProducts() {
        $products = Product::find()->asArray()->limit(8)->all();
        
        foreach($products as &$product) {
            $product['photo_preview'] = Product::getPreviewPhoto($product['id']);
            if($product['discount']) {
                $product['pricedown'] = $product['price'] - ($product['price'] * ($product['discount'] / 100));
            }
        }
        
        return $products;
    }
    
    public static function getNewProducts() {
        $products = Product::find()->asArray()->orderBy('date desc')->limit(10)->all();
        
        foreach($products as &$product) {
            $product['photo_preview'] = Product::getPreviewPhoto($product['id']);
            if($product['discount']) {
                $product['pricedown'] = $product['price'] - ($product['price'] * ($product['discount'] / 100));
            }
            
        }
        
        return $products;
    }
    
    public static function getPreviewPhoto($id) {
        $photo = ProductPhoto::getPreviewPhotoName($id);
        return ImageUpload::getFolderProductForView().$photo['filename'];
    }
    
    public static function getBrends() {
        return Product::find()->select('DISTINCT `brand`')->asArray()->all();
        
    }
    
    public function getProducts($id, $title) {
        
        $category_obj = new Category;
        
        if($title) {
            $connection = \Yii::$app->db;
            $categories = $category_obj->getCategoriesForMenu($title);

            $query = "SELECT `id`, `sku`, `title`, `price`, `discount` FROM product ";

            foreach($categories as $category) {
                if(!$i) {
                    $query = $query . "WHERE category_id = " . $category['id'];
                    $i = 1;
                } else {
                    $query = $query . " OR category_id = " . $category['id'];
                }
            }
            
            // get the total number of articles (but do not fetch the article data yet)
            $count = "SELECT count(*) ". substr($query, stripos($query, "FROM"));
            
            $count = $connection->createCommand($count);
            $count = $count->queryOne();
            $count = $count['count(*)'];

            // create a pagination object with the total count
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 12]);
            
            $query = $query." LIMIT ". $pagination->limit. " OFFSET ".$pagination->offset; 

            $products = $connection->createCommand($query);
            $products = $products->queryAll();
            
            
        } else {
            // build a DB query to get all articles with status = 1
            $query = Product::find();
            // get the total number of articles (but do not fetch the article data yet)
            $count = $query->count();
            // create a pagination object with the total count
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 12]);
            $products = Product::find()->asArray()->where(['category_id' => $id])
                ->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        
        foreach($products as &$product) {
            $product['photo_preview'] = Product::getPreviewPhoto($product['id']);
            if($product['discount']) {
                $product['price'] = $product['price'] - $product['price'] / 100 * $product['discount'];
            }
        }
        
        $data['products'] = $products;
        $data['pagination'] = $pagination;
        
        return $data;
        
    }
    
    public function getProductsBrend($title = NULL) {
        if($title) {
            // build a DB query to get all articles with status = 1
            $query = Product::find()->where(['brand' => $title]);
            // get the total number of articles (but do not fetch the article data yet)
            $count = $query->count();
            // create a pagination object with the total count
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 12]);
            // limit the query using the pagination and retrieve the articles
            $products = $query->asArray()->offset($pagination->offset)
                ->limit($pagination->limit)
                ->where(['brand' => $title])
                ->all();
            
        } else {
            // build a DB query to get all articles with status = 1
            $query = Product::find();
            // get the total number of articles (but do not fetch the article data yet)
            $count = $query->count();
            // create a pagination object with the total count
            $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 12]);
            // limit the query using the pagination and retrieve the articles
            $products = $query->asArray()->offset($pagination->offset)
                ->limit($pagination->limit)
                ->all();
        }
        
        foreach($products as &$product) {
            $product['photo_preview'] = Product::getPreviewPhoto($product['id']);
            if($product['discount']) {
                $product['price'] = $product['price'] - $product['price'] / 100 * $product['discount'];
            }
        }
        
        $data['products'] = $products;
        $data['pagination'] = $pagination;
        
        return $data;
        
    }
    
    public function getProductDetail($id) {
        $product = Product::find()->asArray()->where(['id' => $id])->one();
        
        $product['photo_preview'] = $this->getImagesArray($id); 
        foreach($product['photo_preview'] as &$photo) {
            $photo = ImageUpload::getFolderProductForView().$photo;
        }
        
        if($product['discount']) {
            $product['pricedown'] = $product['price'] - $product['price']/100*$product['discount'];
        } else {
            $product['pricedown'] = $product['price'];
        }
        
        $product['rating'] = $this->getRating($product['id']);
        
        return $product; 
    }
    
    public function setRating($product_id, $count) {
        $model = Product::findOne($product_id);
        $model->rating += $count;
        $model->voted_users++;
        
        return $model->save(false);
    }
    
    public function getRating($product_id) {
        $model = Product::findOne($product_id);
        $total = ($model->voted_users) ? $total = $model->rating / $model->voted_users : $total = 0;
        
        return round($total, 2);
    }
    
}

