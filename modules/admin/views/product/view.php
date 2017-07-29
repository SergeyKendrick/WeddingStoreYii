<?php

use yii\helpers\Html;
use yii\widgets\DetailView;
use yii\bootstrap\Tabs;
use app\models\Product;

/* @var $this yii\web\View */
/* @var $model app\models\Product */

$this->title = $model->title;
$this->params['breadcrumbs'][] = ['label' => 'Товары', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<style>
    .imgProductBox {
        position: relative; display: inline-block; margin-right: 10px;
    }
    a.delete-link {
        display: inline-block; position: absolute; right: 0; padding: 8px 5px; transition: .5s; opacity: 0; border-radius: 4px; text-decoration: none;  background: rgba(210,210,210, .5); 
    }
    .imgProductBox:hover a.delete-link {
        opacity: 1;
        cursor: pointer;
    }
    
    div.popup-box {
        display: none;
        position: fixed;
        width: 100%;
        height: 100%;
        z-index: 100;
        background: rgba(0,0,0, 0.7);
        text-align: center;
    }
    
    div.popup-box > div.popup {
        margin-top: 3%;
        width: 50%;
        height: 90%;
        display: inline-block;
        background: #fff;
    }
    div.popup-box > div.popup img {
        width: 100%;
        height: 100%;
    }
</style>
<div class="product-view">

    <h1><?= Html::encode($this->title) ?></h1>

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Сменить категорию', ['set-category', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Добавить изображения', ['set-images', 'id' => $model->id], ['class' => 'btn btn-info']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы действительно уверены в удалении продукта?',
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
    
    if($img) {
        foreach($img as $photo) {
            $blocks = $blocks.
                "<div class='imgProductBox'>".
                    Html::a('Удалить', ['delete-image', 'id' => $model->id, 'filename' => $photo], [
                        'class' => 'delete-link',
                        'data' => [
                            'confirm' => 'Вы действительно уверены в удалении изображения?',
                            'method' => 'post',
                        ],
                    ]).
                    "<img width='200px' src='$path"."$photo'></div>";
        }
    } else {
        $blocks = "Изображения для этого товара отсутствуют.";
    }
        
    $tab3 = $blocks;
        
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
            [
                'label' => 'Изображения',
                'content' => $tab3,
            ],
                      
        ],
    ]);?>

</div>
