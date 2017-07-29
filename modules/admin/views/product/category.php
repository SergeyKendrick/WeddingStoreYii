<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<style>
    form {
        display: inline-block;
        margin: 0 auto;
        width: 30%;
    }
    
    button {
        margin-top: 20px;
        width: 100px;
    }
</style>

<div class="product-search" style="text-align: center;">
    <h3>Изменение категории товара</h3>
    <?php $form = ActiveForm::begin(); ?>

    <?=Html::dropDownList('Category',$selectedCategory, $categories, ['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton('Применить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
