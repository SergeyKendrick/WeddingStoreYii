<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/* @var $this yii\web\View */
/* @var $model app\models\ProductSearch */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-search">

    <?php $form = ActiveForm::begin([
        'action' => ['index'],
        'method' => 'get',
    ]); ?>

    <?= $form->field($model, 'id') ?>

    <?= $form->field($model, 'sku') ?>

    <?= $form->field($model, 'title') ?>

    <?= $form->field($model, 'category_id') ?>

    <?= $form->field($model, 'description') ?>

    <?php // echo $form->field($model, 'price') ?>

    <?php // echo $form->field($model, 'brand') ?>

    <?php // echo $form->field($model, 'pearl_type') ?>

    <?php // echo $form->field($model, 'color') ?>

    <?php // echo $form->field($model, 'base_material') ?>

    <?php // echo $form->field($model, 'precious_artif') ?>

    <?php // echo $form->field($model, 'model_number') ?>

    <?php // echo $form->field($model, 'occasion') ?>

    <?php // echo $form->field($model, 'type') ?>

    <?php // echo $form->field($model, 'ideal_for') ?>

    <?php // echo $form->field($model, 'discount') ?>

    <?php // echo $form->field($model, 'rating_id') ?>

    <div class="form-group">
        <?= Html::submitButton('Search', ['class' => 'btn btn-primary']) ?>
        <?= Html::resetButton('Reset', ['class' => 'btn btn-default']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
