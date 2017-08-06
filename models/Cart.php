<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "cart".
 *
 * @property integer $id
 * @property string $user_id
 * @property integer $product_id
 */
class Cart extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'cart';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['product_id'], 'integer'],
            [['user_id'], 'integer'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'product_id' => 'Product ID',
        ];
    }
    
    public function addToCart($user_id, $items_count, $product_id) {
        
        for($i = 0; $i < $items_count; $i++) {
            $this->id = false;
            $this->isNewRecord = true;
            $this->user_id = $user_id;
            $this->product_id = $product_id;

            $this->save();
        }
        
        return true;
    }
    
    public function getOrders() {
        $products_id = Cart::find()->asArray()->select('product_id')->where(['user_id' => Yii::$app->user->id])->orderBy('product_id')->all();
        
        foreach($products_id as $id) {
            $orders[] = Product::find()->asArray()->select('`id`, `title`, `price`')->where(['id' => $id['product_id']])->one();
        }
        
        foreach($orders as &$order) {
            $order['count'] = Cart::find()->where(['product_id' => $order['id']])->count();
            $order['photo_preview'] = Product::getPreviewPhoto($order['id']);
            $order['total_price'] = $order['price'] * $order['count'];
        }
        
        $elem = $orders[0]['id'];
        for($i = 1; $i < Cart::getCountOrders(); $i++) {
            if($elem == $orders[$i]['id']) {
                unset($orders[$i]);
            } else {
                $elem = $orders[$i]['id'];
            }
        }
        
        return $orders;
    }
    
    public function deleteOrder($product_id) {
        $order = Cart::find()->where(['product_id' => $product_id])->one();
        return $order->delete();
    }
    
    public static function getTotal() {
        $products_id = Cart::find()->asArray()->select('product_id')->where(['user_id' => Yii::$app->user->id])->orderBy('product_id')->all();
        
        foreach($products_id as $id) {
            $products_sum = Product::find()->asArray()->select('price')->where(['id' => $id['product_id']])->one();
            $total += $products_sum['price'];
        }
        
        return $total;
        
    }
    
    public static function getCountOrders() {
        $count = Cart::find()->asArray()->select('product_id')->where(['user_id' => Yii::$app->user->id])->orderBy('product_id')->count();
        
        return $count;
    }
}
