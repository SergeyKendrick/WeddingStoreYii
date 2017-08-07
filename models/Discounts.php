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
            [['discount', 'product_id', 'user_id'], 'integer'],
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
            'product_id' => 'Товар',
            'user_id' => 'Пользователь',
        ];
    }
    
    public function saveCoupon($product_id, $coupon) {
        $this->product_id = $product_id;
        $this->code = $coupon['coupon'];
        $this->discount = $coupon['discount'];
        
        return $this->save();
    }
    
    public function getProduct() {
        return $this->hasOne(Product::className(), ['id' => 'product_id']);
    }
    
    public function applyCoupon($code) {
        if(!Discounts::getDiscount() && !Discounts::find()->select('user_id')->where(['code' => $code])->one()) {
            if($model = Discounts::find()->where(['code' => $code])->one()) {
                $model->user_id = Yii::$app->user->id;

                return $model->save(false);
            }
        }
        
        return true; 
    }
    
    public static function getDiscount() {
        $discount = Discounts::find()->where(['user_id' => Yii::$app->user->id])->one();
        return $discount;
    
    }
}
