<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "product_photo".
 *
 * @property integer $id
 * @property integer $product_id
 * @property string $file_path
 */
class ProductPhoto extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'product_photo';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['file_path'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'product_id' => 'Product ID',
            'file_path' => 'File Path',
        ];
    }
    
    public function saveImages($product_id, $files) {
    
        $this->product_id = $product_id;
        
        $imageUpload = new ImageUpload;

        $this->filename = $files;
        
        foreach($files as $file) {
            $this->id = false;
            $this->isNewRecord = true;
    
            $this->filename = $imageUpload->uploadFileProduct($file);
            
            $this->save(false);
        }
        
        return true;
    }
    
    public function checkCountImg($id, $imageFiles) {
        $product = new Product;
        $countImages = $this->checkCountImages($id);
        $result = 4 - $countImages;
        $countUpload = $product->checkCountUploads($imageFiles);
        $message = "<p style='color: red;'>Ошибка!<br>Превышение максимально возможного числа загрузки.</p>";
        if($result < $countUpload) {
            return $message;
        } else {
            return false;
        }
    }
    
    public function deleteAllImageFromTable($product_id) {
        return $this->deleteAll(['product_id' => $product_id]);
    }
    
    public function checkCountImages($product_id) {
        return $this->find()->where(['product_id' => $product_id])->count();
    }
    
    public function deleteAllImages($product_id) {
        $filenames = $this->find()->select('filename')->where(['product_id' => $product_id])->asArray()->all();
        
        if(!$filenames) {
            return true;
        }
        
        $product = new Product;
        
        foreach ($filenames as $file) {
            $photo = $file['filename'];
            $this->deleteImageFromFolder($photo);
        }
        
        $this->deleteAllImageFromTable($product_id);
        
        return true;
    }
    
    public function deleteImageFromFolder($currentImage) {
        if(file_exists(Yii::getAlias('@web').'images/products/' . $currentImage) && $currentImage) {
            unlink(Yii::getAlias('@web').'images/products/' . $currentImage);
        }
        return true;
    }
    
    public function deleteImage($filename) {
        $photo = ProductPhoto::find()->where(['filename' => $filename])->one();
        return $photo->delete();
        
    }
    
    public static function getPreviewPhotoName($product_id) {
        return ProductPhoto::find()->select('filename')->where(['product_id' => $product_id])->asArray()->one();
    }
}
