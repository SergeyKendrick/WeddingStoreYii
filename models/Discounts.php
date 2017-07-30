<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "discounts".
 *
 * @property integer $id
 * @property string $code
 * @property integer $discount
 */
class Discounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'discounts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['discount'], 'integer'],
            [['code'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'code' => 'Код',
            'discount' => 'Скидка по купону(%)',
        ];
    }
}
