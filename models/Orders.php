<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "orders".
 *
 * @property integer $id
 * @property string $order_number
 * @property string $products
 * @property integer $user_id
 * @property string $status
 * @property string $date
 */
class Orders extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'orders';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'integer'],
            [['date'], 'safe'],
            [['order_number', 'products', 'status'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'order_number' => 'Номер заказа',
            'products' => 'Товары',
            'user_id' => 'Пользователь',
            'status' => 'Статус',
            'date' => 'Дата',
        ];
    }
    
    public function createOrder($products) {
        
        
        $products = unserialize($products);
        
        foreach($products as $product) {
            $products_id[] = $product['id'];
        }
        
        $products_id = serialize($products_id);
        
        $this->order_number = $this->generateNumber();
        $this->products = $products_id;
        if(!Yii::$app->user->isGuest) {
            $this->user_id = Yii::$app->user->id;
        }
        $this->status = "Принят в обработку";
        $this->date = date('Y:m:d h:i:s');
        
        if($this->save(false)) {
            if(!Yii::$app->user->isGuest) {
                Cart::deleteAll(['user_id' => Yii::$app->user->id]);
            } else {
                $session = Yii::$app->session;
                unset($session['products']);
            }
        }
        
        return true;
        
    }
    
    public function generateNumber($length = 14) {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890";
        $numChars = strlen($chars);
        $string = "";
        
        for($i=0; $i <= $length; $i++) {
            $string .= substr($chars, rand(1, $numChars) - 1, 1);
        }
        
        return $string;
    }
    
}
