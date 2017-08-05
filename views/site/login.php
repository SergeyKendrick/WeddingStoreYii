<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;

$this->title = 'Авторизация';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="login_sec">
	 <div class="container">
		 <h2><?=$this->title?></h2>
		 <div class="col-md-6 log">			 
				<p>Добро пожаловать, заполните, пожалуйста, поля ниже.</p>
				<p>Если Вы здесь первый раз, <span>нажмите здесь</span></p>
				 
				<?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "<h5>{label}</h5>\n{input}\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => ''],
                    ],
                ]); ?>

                    <?= $form->field($model, 'username')->textInput(['autofocus' => true, 'class' => 'textbox',])->label('Логин:') ?>

                    <?= $form->field($model, 'password')->passwordInput(['class' => 'textbox',])->label('Пароль:') ?>

                    <?= $form->field($model, 'rememberMe')->checkbox([
                        'template' => "<div class=\"row\" style=\"margin-bottom: 10px;\"><div class=\"col-lg-1\" style=\"text-align: center;\">{input}</div><div class=\"col-lg-4\">{label}</div>\n<p>{error}</p></div>",
                    ])->label('Запомнить меня') ?>

                    <?= Html::submitButton('Войти', ['class' => 'submit-form']) ?>
                    <a class="acount-btn" href="account.html">Создать новый аккаунт</a>

                <?php ActiveForm::end(); ?>
                <a href="#">Forgot Password ?</a>
		 </div>	
				
		 <div class="clearfix"></div>
	 </div>
</div>