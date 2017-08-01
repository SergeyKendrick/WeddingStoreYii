<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "category".
 *
 * @property integer $id
 * @property string $title
 * @property integer $global_category_id
 */
class Category extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'category';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['global_category_id'], 'integer'],
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
            'global_category_id' => 'Global Category ID',
        ];
    }
    
    public function saveCategory($category) {
        $this->title = $category['Category']['title'];
        $this->global_category_id = $category['globalCategory'];
        return $this->save();
    }
    
    public function getGlobalCategory() {
        return $this->hasOne(GlobalCategory::className(), ['id' => 'global_category_id']);
    }
}
