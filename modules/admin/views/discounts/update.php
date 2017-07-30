<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model app\models\Discounts */

$this->title = 'Обноление купона: ' . $model->code;
$this->params['breadcrumbs'][] = ['label' => 'Скидочные купоны', 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->code, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Обновление';
?>
<div class="discounts-update">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
