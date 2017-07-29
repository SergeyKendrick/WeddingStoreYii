<?php

namespace app\models;

use Yii;
use yii\base\Model;


class ImageUpload extends Model { 
    
    public $imageFiles;
    
    public $image;
    
    public $count = 4;
    
    public function rules() {
        return [
            [['image'], 'required'],
            [['image'], 'file', 'extensions' => 'jpg,png',]
        ];
    }
    
    
    public function uploadFileProduct($file) {
        
            $this->image = $file;

            $filename = $this->generateFilename($file);

            $file->saveAs($this->getFolderProduct().$filename);

            return $filename;
    }
    
    public static function getFolderProduct() {
        return Yii::getAlias('@web').'images/products/';
    }
    
    public static function getFolderProductForView() {
        return Yii::getAlias('@web').'/images/products/';
    }
    
    private function generateFilename($file) {
        return strtolower(md5(uniqid($file->basename))).'.'.$file->extension;
    }
        
    
}

