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
            [['price'], 'integer'],
            [['count'], 'integer'],
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
            'price' => 'Price',
        ];
    }
    
    public function addToCart($user_id, $items_count, $product_id, $price) {
        
        if(!Cart::find()->where(['product_id' => $product_id, 'user_id' => $user_id])->one()) {
            $this->id = false;
            $this->isNewRecord = true;
            $this->user_id = $user_id;
            $this->product_id = $product_id;
            $this->price = $price;
            $this->count = $items_count;
            
            return $this->save(false);
        } else {
            $id = Cart::find()->select('id')->where(['user_id' => $user_id, 'product_id' => $product_id])->one();
            $id = $id->id;
            $order = Cart::findOne($id);
            $order->count += $items_count;
            
            return $order->save(false);
        } 
    }
    
    public function addToCartAfterLogin() {
        $session = Yii::$app->session;
        
        if($session['products']) {
            foreach($session['products'] as $product) {

                for($i=0; $i < $product['items']; $i++) {
                    $this->id = false;
                    $this->isNewRecord = true;
                    $this->user_id = Yii::$app->user->id;
                    $this->product_id = $product['product_id'];
                    $this->price = $product['price'];
                    $this->count = 

                    $this->save();
                }
            }
            unset($session['products']);
        }
        
        return true;
        
    }
    
    public function addToCartForGuest($item_quantity, $product_id, $price) {
        $session = Yii::$app->session;
            
            if(!$session['products']) {
                $products[] = [
                    'product_id' => $product_id, 
                    'items' => $item_quantity, 
                    'price' => $price
                ];
            } else {
                $products = $session['products'];
                
                foreach($products as &$product) {
                    if($product['product_id'] == $product_id) {
                        $product['items'] += $item_quantity;
                        $check = true;
                    }
                }
                
                if(!$check) {
                    $products[] = [
                        'product_id' => $product_id, 
                        'items' => $item_quantity, 
                        'price' => $price
                    ];
                }
            }
            
            $session['products'] = $products;
        
            return $session['products'];
    }
    
    public function getOrders($session_order = NULL) {
        if($session_order) {
            foreach($session_order as $order) {
                $product = Product::find()->asArray()->select('`id`, `title`, `price`, `discount`')->where(['id' => $order['product_id']])->one();
                $product['count'] = $order['items'];
                $product['photo_preview'] = Product::getPreviewPhoto($order['product_id']);
                if($product['discount']) {
                    $product['price'] = $product['price'] - $product['price'] / 100 * $product['discount'];
                    $product['total_price'] = $product['price'] * $product['count'];
                } else {
                    $product['total_price'] = $product['price'] * $product['count'];
                }
                
                $orders[] = $product;
            }
            
            return $orders;
            
        } else {
            $products_id = Cart::find()->asArray()->select('product_id')->where(['user_id' => Yii::$app->user->id])->orderBy('product_id')->all();
        
        foreach($products_id as $id) {
            $orders[] = Product::find()->asArray()->select('`id`, `title`, `price`, `discount`')->where(['id' => $id['product_id']])->one();
        }
        
        if($orders) {
        
            foreach($orders as &$order) {
                $order['count'] = Cart::find()->select('count')->where(['product_id' => $order['id'], 'user_id' => Yii::$app->user->id])->one();
                $order['count'] = $order['count']->count; 
                $order['photo_preview'] = Product::getPreviewPhoto($order['id']);
                if($order['discount']) {
                    $order['price'] = $order['price'] - $order['price'] / 100 * $order['discount'];
                    $order['total_price'] = $order['price'] * $order['count'];
                } else {
                    $order['total_price'] = $order['price'] * $order['count'];
                }
            }
            
            return $orders;
        
        }
    
            return NULL;
    }
    }
    
    public function priceWork($orders) {
        if($orders) {
            $total_price_orders = round(Cart::getTotal(), 2);
            if(!Yii::$app->user->isGuest) {
                if($discount = Discounts::getDiscount()) {
                    $discount = $this->getDiscountProduct($discount->product_id, $orders) / 100 * $discount->discount;
                    $total_price = $total_price_orders - $discount + 100;
                } else {
                    $total_price = $total_price_orders + 100;
                }
            } else {
                $total_price = $total_price_orders + 100;
            }
            
            $data['total_price_orders'] = $total_price_orders;
            $data['total_price'] = $total_price;
            $data['discount'] = $discount;
            
            return $data;
            
        }
    } 
    
    public function deleteOrder($product_id) {
        
        if(Yii::$app->user->isGuest) {
            $session = Yii::$app->session;
            
            $products = $session['products'];
            
            foreach($products as $key => &$product) {
                if($product['product_id'] == $product_id) {
                    $product['items'] = $product['items'] - 1;
                }
                if($product['items'] <= 0) {
                    unset($products[$key]);
                }
            }
            
            $session['products'] = $products;
            
            return true;
        }
        
        $order = Cart::find()->where(['product_id' => $product_id])->one();
        $order->count -= 1;
        
        return $order->save(false);
    }
    
    public function getDiscountProduct($id, $orders) {
        foreach($orders as $order) {
            if($order['id'] == $id) {
                return $order['total_price'];
            }
        }
    }
    
    public static function getTotal() {
        if(Yii::$app->user->isGuest) {
            $session = Yii::$app->session;
            $sum = 0;
            if($session['products']) {
                foreach($session['products'] as $product) {
                    $sum += $product['price'] * $product['items'];
                }
                return $sum;
            }
        }
        $prices = Cart::find()->asArray()->select(' `price`, `count` ')->where(['user_id' => Yii::$app->user->id])->all();
        $sum = 0;
        
        foreach($prices as $price) {
            $total += $price['price'] * $price['count'];    
        }

        return $total;
    }
    
    public function getTotalOrders($orders) {
        foreach($orders as $product) {
            $total = $product['price'];
        }
        return $total;
    }

    
    public static function getCountOrders() {
        if(Yii::$app->user->isGuest) {
            $session = Yii::$app->session;
            $sum = 0;
            if($session['products']) {
                foreach ($session['products'] as $product) {
                    $sum += $product['items'];
                }
            }
            return $sum;
        }
        $count_array = Cart::find()->asArray()->select('count')->where(['user_id' => Yii::$app->user->id])->orderBy('product_id')->all();
        $count = 0;
        
        foreach($count_array as $count_element) {
            $count += $count_element['count'];
        }
        
        return $count;
    }
}
