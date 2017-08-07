<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    form {
        width: 100%;
        max-width: 300px;
        margin: 10px auto;
    }
</style>

<div class="article-form" style="text-align: center;">
    <h3>Добавление купона для товара</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'coupon')->textInput(['placeholder' => 'Si1251s51'])->label('Введите код для получения скидки') ?>
    <?= $form->field($model, 'discount')->textInput(['value'=>'', 'placeholder' => '20'])->label('Введите разрмер скидки (%)') ?>
    

    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>