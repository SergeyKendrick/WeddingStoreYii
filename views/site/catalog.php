
<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;
use yii\widgets\Pjax;
?>

 
<div class="product-model">	 
	 <div class="container">
			<ol class="breadcrumb">
		  <li><a href="index.html">Главная</a></li>
		  <li class="active">Товары</li>
		 </ol>
			<h2>Наши товары</h2>	
		 <div class="col-md-9 product-model-sec">
                <?php if(!$products) echo "<h3>В данном разделе товаров нет</h3>"; ?>
       
                <?php foreach($products as $product): ?>
				    <a href="<?=Url::toRoute(['site/product-detail', 'id' => $product['id']]) ?>">
                        <div class="product-grid love-grid">
                            <div class="more-product"><span> </span></div>						
                                <div class="product-img b-link-stripe b-animate-go  thickbox">
                                    <img src="<?=$product['photo_preview'];?>" height="250px" alt=""/>
                                    <div class="b-wrapper">
                                        <h4 class="b-animate b-from-left  b-delay03">							
                                            <button class="btns"><span class="glyphicon glyphicon-zoom-in" aria-hidden="true"></span>Посмотреть</button>
                                        </h4>
                                    </div>
                                </div>
				    </a>						
                    <div class="product-info simpleCart_shelfItem">
                        <div class="product-info-cust prt_name">
                            <h4><?=$product['title']?></h4>
                            <p>ID: <?=$product['sku']?></p>
                            <?php if($product['pricedown']): ?>
                                <p><del>$<?=$product['price']?></del></p>
                                <span class="item_price">$<?=$product['pricedown']?></span>
                            <?php else: ?>
                                <span class="item_price">$<?=$product['price']?></span>
                            <?php endif; ?>
                            <form data-pjax="1" action="<?=Url::toRoute(['site/add-cart']) ?>">
                                <input type="text" name="item_quantity" class="item_quantity" value="1" />
                                <input type="hidden" name="product_id" class="item_quantity" value="<?=$product['id']?>" />
                                <input type="hidden" name="price" class="item_quantity" value="<?=$product['pricedown']?>" />
                                <input type="submit" class="item_add items" value="Добавить">
                            </form>
                        </div>													
                        <div class="clearfix"> </div>
                    </div>
                </div>	
                <?php endforeach; ?>
            <?php
                echo "<div style='text-align: center'> ".LinkPager::widget(['pagination' => $pagination,])."</div> ";
            ?>
			</div>

			<?=$this->render('/partials/rsidebar.php', [
                'categoriesForSidebar' => $sidebar['category'],
                'discounts' => $sidebar['discount'],
                'brends' => $sidebar['brand'],
                'types' => $sidebar['type'],
            ]); ?>		 
        </div>
    </div>
</div>