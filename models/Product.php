<?php

namespace app\models;

use Yii;

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
            [['category_id', 'price', 'discount', 'rating_id'], 'integer'],
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
            'rating_id' => 'Рейтинг',
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
    
    public function getProducts() {
        $connection = \Yii::$app->db;
        
        $category_obj = new Category;
        $categories = $category_obj->getCategoriesForMenu('Одежда');
        
        $query = "SELECT `id`, `sku`, `title`, `price`, `discount` FROM product ";
        
        foreach($categories as $category) {
            if(!$i) {
                $query = $query . "WHERE category_id = " . $category['id'];
                $i = 1;
            } else {
                $query = $query . " OR category_id = " . $category['id'];
            }
        }
        
        $products = $connection->createCommand($query);
        $products = $products->queryAll();
        
        foreach($products as &$product) {
            $product['photo_preview'] = Product::getPreviewPhoto($product['id']);
            if($product['discount']) {
                $product['price'] = $product['price'] - $product['price'] / 100 * $product['discount'];
            }
        }
        
        return $products;
        
        
    }
    
    
}

