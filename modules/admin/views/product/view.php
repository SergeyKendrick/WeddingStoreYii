<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Products', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сменить категорию', ['set-category', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Are you sure you want to delete this item?',
                'method' => 'post',
            ],
        ]) ?>
    </p>
    
    <?php 
    $tab1 = DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'Не указано'],
        'attributes' => [
            'sku',
            'title',
            'category_id',
            'description:ntext',
            'price',
        ],
    ]);
    $tab2 = DetailView::widget([
        'model' => $model,
        'formatter' => ['class' => 'yii\i18n\Formatter','nullDisplay' => 'Не указано'],
        'attributes' => [
            'brand',
            'pearl_type',
            'color',
            'base_material',
            'precious_artif',
            'model_number',
            'occasion',
            'type',
            'ideal_for',
            'discount',
            'rating_id',
        ],
    ]);
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

</div>
