
<?php

use yii\helpers\Url;
use yii\widgets\LinkPager;

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
                            <span class="item_price">$<?=$product['price']?></span>								
                            <input type="text" class="item_quantity" value="1" />
                            <input type="button" class="item_add items" value="Добавить">
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
                'categoriesForSidebar' => $categoriesForSidebar,
            ]); ?>		 
        </div>
    </div>
</div>