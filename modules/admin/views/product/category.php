<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">
    <?php $form = ActiveForm::begin(); ?>

    <?=Html::dropDownList('Category',$selectedCategory, $categories, ['class' => 'form-control']) ?>

    <div class="form-group">
        <?= Html::submitButton('Применить', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
