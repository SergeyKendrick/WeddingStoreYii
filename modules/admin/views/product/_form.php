<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Product */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="product-form">

    <?php $form = ActiveForm::begin(); ?>
    
    <?php 
        $tab1 = $form->field($model, 'sku')->textInput(['maxlength' => true])->label('Артикул').
                $form->field($model, 'title')->textInput(['maxlength' => true])->label('Наименование').
                $form->field($model, 'description')->textarea(['rows' => 6])->label('Описание').
                $form->field($model, 'price')->textInput()->label('Цена').
                $form->field($model, 'discount')->textInput()->label('Скидка');
        
        $tab2 = $form->field($model, 'brand')->textInput(['maxlength' => true])->label('Бренд').
                $form->field($model, 'pearl_type')->textInput(['maxlength' => true])->label('Тип жемчуга').
                $form->field($model, 'color')->textInput(['maxlength' => true])->label('Цвет').
                $form->field($model, 'base_material')->textInput(['maxlength' => true])->label('Материал').
                $form->field($model, 'precious_artif')->textInput(['maxlength' => true])->label('Драгоценное/искусственное изделие').
                $form->field($model, 'model_number')->textInput(['maxlength' => true])->label('Номер модели').
                $form->field($model, 'occasion')->textInput(['maxlength' => true])->label('Повод применения').
                $form->field($model, 'type')->textInput(['maxlength' => true])->label('Тип').
                $form->field($model, 'ideal_for')->textInput(['maxlength' => true])->label('Подходит для..');
    ?>
    
    <?=Tabs::widget([
        'items' => 
        [
            [
                'label' => 'Основные свойства',
                'content' => $tab1,
                'active' => true
            ],
            [
                'label' => 'Дополнительные свойства',
                'content' => $tab2,
            ],
                      
        ],
    ]);?>

    <div class="form-group">
        <?= Html::submitButton($model->isNewRecord ? 'Создать' : 'Обновить', ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>
