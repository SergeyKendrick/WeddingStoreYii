<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AdminAsset;

AdminAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div class="wrap">
    <?php
    NavBar::begin([
        'brandLabel' => 'Wedding store',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [ 
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Главная', 'url' => ['/admin/default/index']],
            ['label' => 'Товары', 'url' => ['/admin/product']],
            ['label' => 'Категории', 'url' => ['/admin/category']],
            ['label' => 'Статьи', 'url' => ['/admin/article']],
            ['label' => 'Пользователи', 'url' => ['/admin/user']],
            ['label' => 'Заказы', 'url' => ['/admin/orders']],
            ['label' => 'Купоны', 'url' => ['/admin/discounts']],
        ],
    ]);
    NavBar::end();
    ?>
    
    <div class="popup-box">
        <div class="popup"><img src="" alt=""></div>
    </div>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : ['homeLink' => Yii::$app->adminUrl],
            
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; Wedding store <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
