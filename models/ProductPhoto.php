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
        
        $imageCount = $this->find()->where(['product_id' => $product_id])->count();
    
        $this->product_id = $product_id;
        
        $imageUpload = new ImageUpload;
        
        if($imageCount >= 4) {
            return false;
        }

        $this->filename = $files;
        
        foreach($files as $file) {
            $this->id = false;
            $this->isNewRecord = true;
    
            $this->filename = $imageUpload->uploadFileProduct($file);
            
            $this->save(false);
        }
        
        return true;
    }
    
    public function deleteImage($filename) {
        $photo = ProductPhoto::find()->where(['filename' => $filename])->one();
        return $photo->delete();
        
    }
}
