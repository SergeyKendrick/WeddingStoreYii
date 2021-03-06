<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use app\assets\AppAsset;
use yii\helpers\Url;
use app\models\Cart;
use app\components\Dropmenu;
use app\components\BottomCategory;
use app\components\BottomMenu;
use yii\widgets\Pjax;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html>
<head>
<title><?= Html::encode($this->title) ?></title>
<link href="https://fonts.googleapis.com/css?family=Kurale&amp;subset=cyrillic,cyrillic-ext" rel="stylesheet">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<script src="front/js/jquery.min.js"></script>
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
					<li><a href="<?=Url::toRoute(['site/search-order'])?>">Отслеживание заказа</a></li>
				</ul>
			</div>
			<div class="top_left">
				<ul>
					<li class="top_link">Email:<a href="mailto:info@example.com">admin@weddingstore.com</a></li>|
					<li class="top_link">
                    <?php if(Yii::$app->user->isGuest): ?>
					    <a href="<?=Url::toRoute(['site/login'])?>">Мой аккаунт</a>
				    <?php else: ?>
				        <a href="<?=Url::toRoute(['site/office'])?>">Мой кабинет</a>
                    </li>|
                       
                        <?=Html::beginForm(['/site/logout'], 'post', ['class' => 'form-logout']).Html::submitButton(
                            'Выйти ('.Yii::$app->user->identity->first_name.')',
                            ['class' => 'btn btn-link logout',]
                        ).Html::endForm()?>
				    <?php endif; ?>
				    					
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
                    <li class="grid"><a href="<?=Url::toRoute(['site/catalog', 'title' => 'Одежда'])?>">Свадьба</a>
                        <?=Dropmenu::Widget();?>
                    </li>
                    <li class="grid"><a href="<?=Url::toRoute(['site/catalog', 'title' => 'Украшения'])?>">Украшения</a>
                        <?=Dropmenu::Widget();?>
                    </li>
                    <li class="grid"><a href="<?=Url::toRoute(['site/brend'])?>">Бренды</a>
                        <?=Dropmenu::Widget();?>
                    </li>
                    <li class="grid"><a href="<?=Url::toRoute(['site/contact'])?>">Контакты</a></li>
            <div class="cart box_1">
                <a href="<?=Url::toRoute(['site/cart'])?>">
                    <h3> <div class="total">
                    <span class="cart_total"><?=Cart::getTotal();?></span> (<span id="cart_count"><?=Cart::getCountOrders();?></span>)</div>
                    <span class="glyphicon glyphicon-shopping-cart" aria-hidden="true"></span></h3>
                </a>
                <p><a href="javascript:;" class="simpleCart_empty">Корзина пуста</a></p>
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
		     <?=BottomMenu::Widget();?>
			 <div class="col-md-3 ftr-grid">
				 <h4>Ваш аккаунт</h4>
				 <ul>
					 <li><a href="<?=Url::toRoute(['site/office'])?>">Ваш аккаунт</a></li>
					 <li><a href="<?=Url::toRoute(['site/office'])?>">Персональная информация</a></li>
					 <li><a href="<?=Url::toRoute(['site/office'])?>">Адреса</a></li>
					 <li><a href="<?=Url::toRoute(['site/office'])?>">Дисконт</a></li>
					 <li><a href="<?=Url::toRoute(['site/office'])?>">Отследить заказ</a></li>					 					 
				 </ul>
			 </div>
			 <div class="col-md-3 ftr-grid">
				 <h4>Категории</h4>
				 <ul>
				     <?=BottomCategory::Widget(); ?>				 
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