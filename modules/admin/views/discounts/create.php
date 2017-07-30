<?php

use yii\helpers\Html;


/* @var $this yii\web\View */
/* @var $model app\models\Discounts */

$this->title = 'Создание купона';
$this->params['breadcrumbs'][] = ['label' => 'Discounts', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="discounts-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
