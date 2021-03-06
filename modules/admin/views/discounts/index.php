<?php

use yii\helpers\Html;
use yii\grid\GridView;

/* @var $this yii\web\View */
/* @var $searchModel app\models\DiscountsSearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Скидочные купоны';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discounts-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p>
        <?= Html::a('Создать купон', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            'code',
            'discount',
            'product_id' => 
            [
                'header' => 'Товар',
                'value' => function ($data) {
                    return ($data->product->title) ? $data->product->title : 'Общая скидка';
                }
            ],
            ['class' => 'yii\grid\ActionColumn'],
        ],
    ]); ?>
</div>
