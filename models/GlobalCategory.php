<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "global_category".
 *
 * @property integer $id
 * @property string $title
 */
class GlobalCategory extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'global_category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['title'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'title' => 'Title',
        ];
    }
    
    public static function getCategorie() {
        $categories = GlobalCategory::find()->asArray()->all();
        
        return $categories;
    }
    
}
