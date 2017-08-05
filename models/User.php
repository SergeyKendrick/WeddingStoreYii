<?php

namespace app\models;

use Yii;

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
class User extends \yii\db\ActiveRecord
{
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
