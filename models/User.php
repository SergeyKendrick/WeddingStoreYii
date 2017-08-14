<?php

namespace app\models;

use Yii;
use yii\web\IdentityInterface;
/**
 * This is the model class for table "user".
 *
 * @property integer $id
 * @property string $first_name
 * @property string $last_name
 * @property string $email
 * @property string $mobile
 * @property integer $sex
 * @property string $password
 * @property integer $isAdmin
 */
class User extends \yii\db\ActiveRecord implements IdentityInterface
{
    
    public static function findIdentity($id)
    {
      return static::findOne($id);
    }

    public static function findIdentityByAccessToken($token, $type = null)
    {
      return static::findOne(['access_token' => $token]);
    }

    public function getId()
    {
      return $this->id;
    }

    public function getAuthKey()
    {
      return $this->authKey;
    }

    public function validateAuthKey($authKey)
    {
      return $this->authKey === $authKey;
    }
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'user';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['sex', 'isAdmin'], 'integer'],
            [['first_name', 'last_name', 'email', 'mobile', 'password'], 'string', 'max' => 255],
            [['email'], 'email'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'first_name' => 'Имя',
            'last_name' => 'Фамилия',
            'email' => 'Email',
            'mobile' => 'Телефон',
            'sex' => 'Пол',
            'password' => 'Пароль',
            'isAdmin' => 'Это админ?',
        ];
    }
    
    public function create() {
        return $this->save(false);
    }
    public function validatePassword($password) {
        return ($this->password == $password) ? true : false; 
    }
    
    public function admin($id) {
        $user = User::findOne($id);
    
        
        if($user['isAdmin']) {
            return $this->isAdmin = 0;
        } else {
            return $this->isAdmin = 1;
        }
     
    }
    
    public static function findByUseremail($email) {
        return User::find()->where(['email' => $email])->one();
    }
    
    public function findByUserId($id) {
        return User::find()->where(['id' => $id])->one();
    }
    
    public function getHistoryOrders($user_id) {
        $orders = Orders::find()->asArray()->where(['user_id' => $user_id])->all();
        
        foreach($orders as &$order) {
            $order['products'] = unserialize($order['products']);   
            $products = [];
            foreach($order['products'] as $product) {
                $products[] = Product::find()->asArray()->select(' `id`, `title`, `price`, `pricedown` ')->where(['id' => $product])->one();
            }
            
            foreach($products as &$product) {
                $product['photo_preview'] = Product::getPreviewPhoto($product['id']);
                if($product['pricedown']) {
                    $product['price'] = $product['pricedown'];
                } else {
                    $product['pricedown'] = 0;
                }
                
                $product['count'] = 0;
                
                
                foreach($products as &$product_count) {
                    if($product['id'] == $product_count['id']) {
                        $product['count'] += 1;
                    }
                }    
                
                $product['totalPrice'] = $product['price'] * $product['count'];
                $totalCount += $product['count'];
            }
            
            for($i=0; $i < $totalCount; $i++) {
                $is_product = FALSE;
                $id = $products[$i]['id'];
                
                for($j=0; $j < $totalCount; $j++) {
                    if($products[$j]['id'] == $id) {
                        if($is_product) {
                            unset($products[$j]);
                        }
                        $is_product = TRUE;
                    }
                }
                
            }
    
            $order['products'] = serialize($products);
        }
        return $orders;

    }

}
