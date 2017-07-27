<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\ProductSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

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

            'id',
            'sku',
            'title',
            'category_id',
            'description:ntext',
            // 'price',
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
