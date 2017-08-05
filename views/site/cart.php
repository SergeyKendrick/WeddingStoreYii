<?php

use yii\helpers\Url;

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
					 <h3>Моя корзина (2)</h3>
						<script>$(document).ready(function(c) {
							$('.close1').on('click', function(c){
								$('.cart-header').fadeOut('slow', function(c){
									$('.cart-header').remove();
								});
								});	  
							});
					   </script>
					<script>$(document).ready(function(c) {
							$('.close2').on('click', function(c){
								$('.cart-header1').fadeOut('slow', function(c){
									$('.cart-header1').remove();
								});
								});	  
							});
					   </script>
						
					 <div class="in-check" >
						  <ul class="unit" style="text-align: center;">
							<li><span>Товар</span></li>
							<li><span>Наименование</span></li>		
							<li><span>Цена</span></li>
							<div class="clearfix"> </div>
						  </ul>
						  <ul class="cart-header">
						   <div class="close1"> </div>
							<li class="ring-in"><a href="single.html" ><img src="images/f1.jpg" class="img-responsive" alt=""></a>
							</li>
							<li><span>Woo Dress</span></li>
							<li><span>$ 60.00</span></li>
							<div class="clearfix"> </div>
							</ul>
							<ul class=" cart-header1">
						   <div class="close2"> </div>
							<li class="ring-in"><a href="single.html" ><img src="images/f2.jpg" class="img-responsive" alt=""></a>
							</li>
							<li><span>Woo Dress</span></li>
							<li><span>$ 60.00</span></li>
							<div class="clearfix"> </div>
							</ul>
					 </div>
				  </div>					  
			 </div>
		 </div>
		 <div class="col-md-3 cart-total">
			 <a class="continue" href="<?=Url::toRoute(['site/catalog'])?>">Продолжить покупки</a>
			 <div class="price-details">
				 <h3>Детали цены</h3>
				 <span>Сумма товаров</span>
				 <span class="total">350.00</span>
				 <span>Скидка</span>
				 <span class="total">---</span>
				 <span>Стоимость доставки</span>
				 <span class="total">100.00</span>
				 <div class="clearfix"></div>				 
			 </div>	
			 <h4 class="last-price">Итоговая цена</h4>
			 <span class="total final">450.00</span>
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