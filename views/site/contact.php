<?php

/* @var $this yii\web\View */
/* @var $form yii\bootstrap\ActiveForm */
/* @var $model app\models\ContactForm */

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\captcha\Captcha;

$this->title = 'Контакты';
?>

<?php
$this->params['breadcrumbs'][] = $this->title;
?>
			<!---start-contact---->
<div class="contact">
<h3>Наши контакты</h3>
    <div class="section group">				
        <div class="col-md-6 span_1_of_3">
            <div class="contact_info">
                <h4>Найдите нас здесь</h4>
                    <div class="map">
                        <iframe width="100%" height="175" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.co.in/maps?f=q&amp;source=s_q&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265&amp;output=embed"></iframe><br><small><a href="https://maps.google.co.in/maps?f=q&amp;source=embed&amp;hl=en&amp;geocode=&amp;q=Lighthouse+Point,+FL,+United+States&amp;aq=4&amp;oq=light&amp;sll=26.275636,-80.087265&amp;sspn=0.04941,0.104628&amp;ie=UTF8&amp;hq=&amp;hnear=Lighthouse+Point,+Broward,+Florida,+United+States&amp;t=m&amp;z=14&amp;ll=26.275636,-80.087265" style="color:#666;text-align:left;font-size:0.85em">Показать на карте</a></small>
                    </div>
            </div>
      			<div class="company_address">
                    <h4>Информация о компании :</h4>
                    <p>500 Lorem Ipsum Dolor Sit,</p>
                    <p>22-56-2-9 Sit Amet, Lorem,</p>
                    <p>USA</p>
                    <p>Телефон:(00) 222 666 444</p>
                    <p>Факс: (000) 000 00 00 0</p>
                    <p>Email: <a href="mailto:info@example.com">info@mycompany.com</a></p>
                    <p>Подписывайтесь на: <a href="#">Facebook</a>, <a href="#">Twitter</a></p>
				</div>
				</div>				
				<div class="col-md-6 span_2_of_3">
				    <div class="contact-form">
                        <?php $form = ActiveForm::begin([
                        'id' => 'contact-form',
                        'fieldConfig' => [
                            'template' => "<span>{label}</span>\n<span>{input}</span>\n<div>{error}</div>",
                            'labelOptions' => ['class' => ''],
                        ],
                        ]); ?>

                        <?= $form->field($model, 'name')->textInput(['autofocus' => true, 'class' => 'textbox',])->label('Ваше имя') ?>

                        <?= $form->field($model, 'email')->textInput(['class' => 'textbox',])->label('Ваш email') ?>

                        <?= $form->field($model, 'subject')->textInput(['class' => 'textbox',])->label('Тема') ?>

                        <?= $form->field($model, 'body')->textarea(['class' => 'textbox', 'rows' => 6])->label('Сообщение') ?>

                        <?= $form->field($model, 'verifyCode')->widget(Captcha::className(), [
                        ]) ?>

                        <div class="form-group">
                            <?= Html::submitButton('Отправить', ['class' => 'btn btn-primary', 'name' => 'contact-button']) ?>
                        </div>

                        <?php ActiveForm::end(); ?>

				    </div>
  				</div>				
		  </div>
	  </div>
