<?php

namespace app\models;

use Yii;
use yii\base\Model;

/**
 * LoginForm is the model behind the login form.
 *
 * @property User|null $user This property is read-only.
 *
 */
class SignupForm extends Model {
    public $first_name;
    public $last_name;
    public $email;
    public $mobile;
    public $sex;
    public $password;
    public $retypePassword;
    
    public function rules() {
        return [
        [['first_name', 'email', 'mobile', 'sex', 'password', 'retypePassword'], 'required', 'message' => 'Это поле обязательно для заполнения'],
        [['first_name', 'last_name', 'mobile'], 'string'],
        [['email'], 'email', 'message' => 'Введите корректный e-mail'],
        [['email'], 'unique', 'targetClass'=>'app\models\User', 'targetAttribute' => 'email'],
        ];
    }
    
    public function signup() {
            $user = new User();
            $user->attributes = $this->attributes;
            
            return $user->create();
    }
}
    