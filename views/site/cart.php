<?php

use yii\helpers\Url;
use yii\widgets\Pjax;
?>



<div class="checkout">	 
	 <div class="container">	
		 <ol class="breadcrumb">
		  <li><a href="/">Главная</a></li>
		  <li class="active">Корзина</li>
		 </ol>
		 <div class="col-md-9 product-price1">
			 <div class="check-out">	
				 <div class=" cart-items">
				 <?php Pjax::begin(); ?>	
					 <h3>Моя корзина (<?=$total_count?>)</h3>
					 <div class="in-check" >
						  <ul class="unit" style="text-align: center;">
							<li><span>Товар</span></li>
							<li><span>Наименование</span></li>		
							<li><span>Цена</span></li>
							<li><span>Количество</span></li>
							<li><span>Итог</span></li>
							<div class="clearfix"> </div>
						  </ul>
						  <?php if($orders): ?>
						  <?php foreach($orders as $order): ?>
						  <ul class="cart-header">
                                <a data-pjax="1" class="close1" href="<?=Url::toRoute(['site/delete-order', 'id' => $order['id']])?>"> </a>
                                <li class="ring-in"><a href="single.html" ><img src="<?=$order['photo_preview']?>" class="img-responsive" alt=""></a>
                                </li>
                                <li><span><a href="<?=Url::toRoute(['site/product-detail', 'id' => $order['id']])?>"><?=$order['title']?></a></span></li>
                                <li><span>$ <?=$order['price'];?></span></li>
                                <li><span><?=$order['count']?></span></li>
                                <li><span>$ <?=$order['total_price'];?></span></li>
                                <div class="clearfix"> </div>
				          </ul>
				          <?php endforeach; ?>
				          <?php else: ?>
				          <p>Корзина пуста</p>
				          <?php endif; ?>
					 </div>
					 <?php Pjax::end(); ?>	
				  </div>				  
			 </div>
		 </div>
		 <div class="col-md-3 cart-total">
			 <a class="continue" href="<?=Url::toRoute(['site/catalog'])?>">Продолжить покупки</a>
			 <div class="price-details">
				 <h3>Детали цены</h3>
				 <span>Сумма товаров</span>
				 <span class="total">$<?=$total_price_orders?></span>
				 <span>Скидка</span>
				 <span class="total">---</span>
				 <span>Стоимость доставки</span>
				 <span class="total">$100.00</span>
				 <div class="clearfix"></div>				 
			 </div>	
			 <h4 class="last-price">Итоговая цена</h4>
			 <span class="total final">$<?=$total_price?></span>
			 <div class="clearfix"></div>
			 <a class="order" href="#">Оформить заказ</a>
			 <div class="total-item">
				 <h3>Опции</h3>
				 <h4>Купоны</h4>
				 <a class="cpns" href="#">Использовать купон</a>
				 <p><a href="#">Войдите</a>, если купоны подключены к Вашему аккаунту</p>
			 </div>
			</div>
	 </div>
</div>