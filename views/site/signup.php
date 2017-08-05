<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\LoginForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Регистрация';
$this->params['breadcrumbs'][] = $this->title;
?>
<!-- [if IE] 
    < link rel='stylesheet' type='text/css' href='ie.css'/>  
 [endif] -->  

 <!-- [if lt IE 7]>  
    < link rel='stylesheet' type='text/css' href='ie6.css'/>  
 <! [endif] -->  

<div class="container">
	  <ol class="breadcrumb">
		  <li><a href="/">Главная</a></li>
		  <li class="active"><?=$this->title?></li>
		 </ol>
	 <div class="registration">
		 <div class="registration_left">
			 <h2>Еще нет аккаунта? <span> Создайте его </span></h2>
			 <div class="registration_form">
			 <!-- Form -->
			 <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "{input}\n{error}",
                        'labelOptions' => ['class' => ''],
                    ],
                ]); ?>
                    <?= $form->field($model, 'first_name')->textInput(['autofocus' => true, 'class' => 'textbox', 'placeholder' => 'Имя'])?>
                    <?= $form->field($model, 'last_name')->textInput(['class' => 'textbox', 'placeholder' => 'Фамилия'])?>
                    <?= $form->field($model, 'email')->textInput(['class' => 'textbox', 'placeholder' => 'E-mail'])?>
                    <?= $form->field($model, 'mobile')->textInput(['class' => 'textbox', 'placeholder' => 'Телефон'])?>
                    
                        <?= $form->field($model, 'sex', ['radioTemplate' => '<div class=\"row\"><label class="radio col-md-4">{input}</label>{label}</div>'])->radioList([
                            '0' => 'Женский',
                            '1' => 'Мужской',
                        ]);?>
                    <?= $form->field($model, 'password')->passwordInput(['class' => 'textbox', 'placeholder' => 'Пароль', 'id' => 'pass']) ?>
                    <div class="field-retype-pass">
                        <input type="password" id="retypePass" style="margin-bottom: 20px;" placeholder="Повторите пароль">
                        <div class="help-block-error"></div>
                    </div>
                    <?= Html::submitButton('Создать аккаунт', ['class' => 'submit-form']) ?>

                <?php ActiveForm::end(); ?>
				<!-- /Form -->
			 </div>
		 </div>
		 <div class="registration_left">
			 <h2>Или он все-таки существует?</h2>
			 <div class="registration_form">
			 <!-- Form -->
			     <?php $form = ActiveForm::begin([
                    'id' => 'login-form',
                    'layout' => 'horizontal',
                    'fieldConfig' => [
                        'template' => "<h5>{label}</h5>\n{input}\n<div class=\"col-lg-8\">{error}</div>",
                        'labelOptions' => ['class' => ''],
                    ],
                ]); ?>

                    <?= $form->field($login, 'email')->textInput(['autofocus' => true, 'class' => 'textbox',])->label('Логин:') ?>

                    <?= $form->field($login, 'password')->passwordInput(['class' => 'textbox',])->label('Пароль:') ?>

                    <?= $form->field($login, 'rememberMe')->checkbox([
                        'template' => "<div class=\"row\" style=\"margin-bottom: 10px;\"><div class=\"col-lg-1\" style=\"text-align: center;\">{input}</div><div class=\"col-lg-4\">{label}</div>\n<p>{error}</p></div>",
                    ])->label('Запомнить меня') ?>

                    <?= Html::submitButton('Войти', ['class' => 'submit-form']) ?>
                    
                    <div class="forget">
                        <a href="#">Forgot Password ?</a>
                    </div>

                <?php ActiveForm::end(); ?>
			 </div>
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>
