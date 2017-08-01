<?php

use yii\helpers\Html;
use yii\grid\GridView;
use yii\bootstrap\Tabs;

/* @var $this yii\web\View */
/* @var $searchModel app\models\CategorySearch */
/* @var $dataProvider yii\data\ActiveDataProvider */

$this->title = 'Категории';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="category-index">

    <h1><?= Html::encode($this->title) ?></h1>
    <?php // echo $this->render('_search', ['model' => $searchModel]); ?>

    <p class="category">
        <?= Html::a('Создать категорию', ['create'], ['class' => 'btn btn-success']) ?>
    </p>
    <p class="global-category">
        <?= Html::a('Создать глобальную категорию', ['global-create'], ['class' => 'btn btn-success']) ?>
    </p>
    <?php
        $tab1 = GridView::widget([
            'dataProvider' => $dataProvider,
            'filterModel' => $searchModel,
            'columns' => [
                ['class' => 'yii\grid\SerialColumn'],
                'title',
                [
                    'label' => 'Глобальная категория',
                    'value' => function($data){
                        if($data->globalCategory->title) {
                            return $data->globalCategory->title;
                        } else {
                            return "Не указано";
                        }
                        
                    },
                ],

                ['class' => 'yii\grid\ActionColumn'],
            ],
        ]);
        
        $tab2 = "<table class='table table-striped table-bordered'>
                    <thead>
                        <tr><th>#</th><th>Наименование</th><th class='action-column'>Действия</th></tr>
                    </thead>
                    <tbody>";
        $i = 0;
        foreach($globalCategories as $category) {
            $i++;
            $tab2 = $tab2.
                "<tr>
                    <td>$i</td>
                    <td>".$category['title']."</td>
                    <td>
                        <a href='' title='Удалить' aria-label='Удалить' data-pjax='0' data-confirm='Вы уверены, что хотите удалить это?' data-method='post'><span class='glyphicon glyphicon-trash'></span></a>
                    </td>
                 </tr>";
            
        }
        
        $tab2 = $tab2."</tbody></table>";
        
    ?>
    
    <?=Tabs::widget([
        'items' => 
        [
            [
                'label' => 'Категории',
                'content' => $tab1,
                'active' => true
            ],
            [
                'label' => 'Глобальные категории',
                'content' => $tab2,
            ],        
        ],
    ]);?>
</div>
