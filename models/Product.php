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
            'sku' => 'Sku',
            'title' => 'Title',
            'category_id' => 'Category ID',
            'description' => 'Description',
            'price' => 'Price',
            'brand' => 'Brand',
            'pearl_type' => 'Pearl Type',
            'color' => 'Color',
            'base_material' => 'Base Material',
            'precious_artif' => 'Precious Artif',
            'model_number' => 'Model Number',
            'occasion' => 'Occasion',
            'type' => 'Type',
            'ideal_for' => 'Ideal For',
            'discount' => 'Discount',
            'rating_id' => 'Rating ID',
        ];
    }
}
