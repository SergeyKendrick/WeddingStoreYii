<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\components\Dropmenu;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
<title><?= Html::encode($this->title) ?></title>
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<?= Html::csrfMetaTags() ?>
<?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="top_bg">
	<div class="container">
		<div class="header_top-sec">
			<div class="top_right">
				<ul>
					<li><a href="#">Помощь</a></li>|
					<li><a href="<?=Url::toRoute(['site/contact'])?>">Контакты</a></li>|
					<li><a href="login.html">Отслеживание заказа</a></li>
				</ul>
			</div>
			<div class="top_left">
				<ul>
					<li class="top_link">Email:<a href="mailto:info@example.com">admin@weddingstore.com</a></li>|
					<li class="top_link"><a href="login.html">Мой аккаунт</a></li>					
				</ul>
			</div>
				<div class="clearfix"> </div>
		</div>
	</div>
</div>
<div class="header-top">
	 <div class="header-bottom">
		 <div class="container">			
            <div class="logo">
                <a href="/"><h1>Wedding Store</h1></a>
            </div>
            <div class="top-nav">
                <ul class="memenu skyblue">
                    <li class="active"><a href="<?=Url::toRoute(['site/index'])?>">Главная</a></li>
                    <li class="grid"><a href="<?=Url::toRoute(['site/wedding'])?>">Свадьба</a>
                        <?=Dropmenu::Widget();?>
                    </li>
                    <li class="grid"><a href="<?=Url::toRoute(['site/bride-style'])?>">Украшения</a>
                        <?=Dropmenu::Widget();?>
                    </li>
                    <li class="grid"><a href="<?=Url::toRoute(['site/brend'])?>">Бренды</a>
                        <?=Dropmenu::Widget();?>
                    </li>
                    <li class="grid"><a href="<?=Url::toRoute(['site/contact'])?>">Контакты</a></li>
            <div class="cart box_1">
                <a href="checkout.html">
                    <h3> <div class="total">
                    <span class="simpleCart_total"></span> (<span id="simpleCart_quantity" class="simpleCart_quantity"></span>)</div>
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></h3>
                </a>
                <p><a href="javascript:;" class="simpleCart_empty">Empty Cart</a></p>
                <div class="clearfix"> </div>
            </div>
            <div class="clearfix"> </div>
             <!---->			 
            </div>
            <div class="clearfix"> </div>
	  </div>
</div>
    <?=$content; ?>
<div class="shoping">
	 <div class="container">
		 <div class="shpng-grids">
			 <div class="col-md-4 shpng-grid">
				 <h3>Подарок</h3>
				 <p>на сумму заказа выше $999</p>
			 </div>
			 <div class="col-md-4 shpng-grid">
				 <h3>Возврат заказа</h3>
				 <p>Возврат заказа в течение 14 дней</p>
			 </div>
			 <div class="col-md-4 shpng-grid">
				 <h3>Скидки</h3>
				 <p>В магазине действуют постоянные скидки</p>
			 </div>
			 <div class="clearfix"></div>
		 </div>
	 </div>
</div>
<!---->
<div class="footer">
	 <div class="container">
		 <div class="ftr-grids">
			 <div class="col-md-3 ftr-grid">
				 <h4>О нас</h4>
				 <ul>
					 <li><a href="#">Кто мы</a></li>
					 <li><a href="contact.html">Обратная связь</a></li>
					 <li><a href="#">Наши сайты</a></li>
					 <li><a href="#">Новости</a></li>
					 <li><a href="#">Команда</a></li>
					 <li><a href="#">Вакансии</a></li>					 
				 </ul>
			 </div>
			 <div class="col-md-3 ftr-grid">
				 <h4>Сервис</h4>
				 <ul>
					 <li><a href="#">FAQ</a></li>
					 <li><a href="#">Покупки</a></li>
					 <li><a href="#">Cancellation</a></li>
					 <li><a href="#">Возврат</a></li>					 
				 </ul>
			 </div>
			 <div class="col-md-3 ftr-grid">
				 <h4>Ваш аккаунт</h4>
				 <ul>
					 <li><a href="account.html">Ваш аккаунт</a></li>
					 <li><a href="#">Персональная информация</a></li>
					 <li><a href="#">Адреса</a></li>
					 <li><a href="#">Дисконт</a></li>
					 <li><a href="#">Отследить заказ</a></li>					 					 
				 </ul>
			 </div>
			 <div class="col-md-3 ftr-grid">
				 <h4>Категории</h4>
				 <ul>
					 <li><a href="#">Свадьба</a></li>
					 <li><a href="#">Jewellerys</a></li>
					 <li><a href="#">Shoes</a></li>
					 <li><a href="#">Flowers</a></li>
					 <li><a href="#">Торты</a></li>
					 <li><a href="#">Больше...</a></li>					 
				 </ul>
			 </div>
			 <div class="clearfix"></div>
		 </div>		
	 </div>
</div>
<!---->
 <div class="copywrite">
	 <div class="container">
         <p>Copyright © 2015 Wedding Store. All Rights Reserved | Design by <a href="http://w3layouts.com">W3layouts</a></p>
     </div>
</div>            
            
            
            
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
            




<?php /*

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
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>

?>








<?php

/* @var $this \yii\web\View */
/* @var $content string */
/*
use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;

AppAsset::register($this);
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
        'brandLabel' => 'My Company',
        'brandUrl' => Yii::$app->homeUrl,
        'options' => [
            'class' => 'navbar-inverse navbar-fixed-top',
        ],
    ]);
    echo Nav::widget([
        'options' => ['class' => 'navbar-nav navbar-right'],
        'items' => [
            ['label' => 'Home', 'url' => ['/site/index']],
            ['label' => 'About', 'url' => ['/site/about']],
            ['label' => 'Contact', 'url' => ['/site/contact']],
        ],
    ]);
    NavBar::end();
    ?>

    <div class="container">
        <?= Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
        ]) ?>
        <?= $content ?>
    </div>
</div>

<footer class="footer">
    <div class="container">
        <p class="pull-left">&copy; My Company <?= date('Y') ?></p>

        <p class="pull-right"><?= Yii::powered() ?></p>
    </div>
</footer>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
*/
    ?>