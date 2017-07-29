<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\Article */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    form {
        display: inline-block;
        margin: 0 auto;
    }
    
    button {
        width: 150px;
    }
</style>

<div class="article-form" style="text-align: center;">
    <h3>Добавление изображений для товара</h3>
    <?php $form = ActiveForm::begin(['options' => ['enctype' => 'multipart/form-data']]); ?>
    <?php
        if($message) {
            echo $message;
        }
    ?>

    <?= $form->field($model, 'imageFiles[]')->fileInput(['multiple' => true, 'maxFiles' => 4])->label('') ?>


    <div class="form-group">
        <?= Html::submitButton('Добавить', ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
