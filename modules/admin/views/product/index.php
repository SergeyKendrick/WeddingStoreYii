<?php

use yii\helpers\Html;
use yii\grid\GridView;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */
$product = new Product;
$this->title = 'Products';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="product-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Create Product', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            //'id',
            'sku',
            'title',
            'description:ntext',
            'price',
            'category_id' =>
            [
                'header' => 'Категория',
                'value' => function ($data) {
                    return $data->category->title;
                }
            ],
            // 'brand',
            // 'pearl_type',
            // 'color',
            // 'base_material',
            // 'precious_artif',
            // 'model_number',
            // 'occasion',
            // 'type',
            // 'ideal_for',
            // 'discount',
            // 'rating_id',

            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
