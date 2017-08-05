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
}
