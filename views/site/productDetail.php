<?php

use yii\helpers\Url;

?>
 

 
 <div class="single-sec">
	 <div class="container">
		 <ol class="breadcrumb">
			 <li><a href="/">Главная</a></li>
			 <li class="active">Товары</li>
		 </ol>
		 <!-- start content -->	
		 <div class="col-md-9 det">
				 <div class="single_left">
					 <div class="flexslider">
							<ul class="slides">
							    <?php foreach($product['photo_preview'] as $photo): ?>
								<li data-thumb="<?=$photo?>">
									<img src="<?=$photo?>" />
                                </li>
                                <?php endforeach; ?>
							</ul>
						</div>
				  </div>
				  <div class="single-right">
					 <h3><?=$product['title']?></h3>
					 <div class="id"><h4>Артикул: <?=$product['sku']?></h4></div>
					  <form action="" class="sky-form">
						     <fieldset>					
							   <section>
							     <div class="rating">
							     <?php for($i = 1; $i < $product['rating']+1; $i++): ?> 
								     <a href="<?=Url::toRoute(['site/rating', 'product_id' => $product['id'], 'count' => $i]) ?>"><i class="icon-star"></i></a>
								 <?php endfor; ?>
								 <?php for($i = $product['rating']+1; $i <= 5 ; $i++): ?> 
								     <a href="<?=Url::toRoute(['site/rating', 'product_id' => $product['id'], 'count' => $i]) ?>"><i class="icon-star" style="background: #000; mrgin-right: 5px;"></i></a>
								 <?php endfor; ?>
								 </div>
							  </section>
						    </fieldset>
					  </form>
					  <div class="cost">
						 <div class="prdt-cost">
							 <ul>
							     <?php if($product['pricedown']): ?>
                                     <li>Цена: <del>$ <?=$product['price']?></del></li>								 
                                     <li>Окончательная цена:</li>
                                     <li class="active">$ <?=$product['pricedown']?></li>
								 <?php else: ?>
                                     <li>Цена:</li>
                                     <li class="active">$ <?=$product['price']?></li>
								 <?php endif; ?>
								 <a href="#">Купить сейчас</a>
							 </ul>
						 </div>
						 <div class="check">
							 <p><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span>Введите пин-код, чтобы получить скидку</p>
							 <form class="navbar-form navbar-left" role="search">
								  <div class="form-group">
									<input type="text" class="form-control fix-width" placeholder="Введите пин-код">
								  </div>
								  <button type="submit" class="btn btn-default">Проверить</button>
							 </form>
						 </div>
						 <div class="clearfix"></div>
					  </div>
					  <div class="item-list">
						 <ul>
							 <li>Материал: <?=$product['base_material']?></li>
							 <li>Цвет: <?=$product['color']?></li>
							 <li>Тип: <?=$product['type']?></li>
							 <li>Бренд: <?=$product['brand']?></li>
							 <li><a href="#main">Подрбные параметры</a></li>
						 </ul>
					  </div>
					  <div class="single-bottom1">
						<h6>Описание</h6>
						<p class="prod-desc"><?=$product['description']?></p>
					 </div>					 
				  </div>
				  <div class="clearfix"></div>
					
		  <!---->
		  <div id="main" class="product-table">
				 <h3> <?=$product['title']?>. Параметры</h3>
				 <div class="item-sec">
					 <h4>Особенности</h4>
					 <table class="table table-bordered">
					 <tbody>
					     <?php if($product['pearl_type']): ?>
							<tr>
								<td><p>Тип жемчуга</p></td>
								<td><p><?=$product['pearl_type']?></p></td>
							</tr>
				         <?php endif; ?>
							<tr>
								<td><p>Цвет</p></td>
								<td><p><?=$product['color']?></p></td>
							</tr>														
						</tbody>
						</table>
				 </div>		
				 <div class="item-sec">
					 <h4>Основные</h4>
					 <table class="table table-bordered">
					 <tbody>
							<tr>
								<td><p>Основной материал</p></td>
								<td><p><?=$product['base_material']?></p></td>
							</tr>
							<tr>
								<td><p>Бренд</p></td>
								<td><p><?=$product['brand']?></p></td>
							</tr>
							<?php if($product['pearl_type']): ?>
							<tr>
								<td><p>Драгоценный/искусственный</p></td>
								<td><p><?=$product['precious_artif']?></p></td>
							</tr>
							<?php endif; ?>
							<tr>
								<td><p>Номер модели</p></td>
								<td><p>ID <?=$product['model_number']?></p></td>
							</tr>
							<tr>
								<td><p>Повод применения</p></td>
								<td><p><?=$product['occasion']?></p></td>
							</tr>
							<tr>
								<td><p>Тип</p></td>
								<td><p><?=$product['type']?></p></td>
							</tr>
							<tr>
								<td><p>Идеален для..</p></td>
								<td><p><?=$product['ideal_for']?></p></td>
							</tr>							
						</tbody>
						</table>
				 </div>	
			</div>
		 <div class="arrivals">	
		 <h3>Рекомендуемые товары</h3>
		 <div class="arrival-grids">			 
			 <ul id="flexiselDemo1">
			     <?php foreach($relatedProducts as $product): ?>
			     <li>
					 <a href="<?=Url::toRoute(['site/product-detail', 'id' => $product['id']]) ?>">
					     <img height="200" src="<?=$product['photo_preview'];?>" alt=""/>	
                         <div class="arrival-info">
                             <h4><?=$product['title']?></h4>
                             <?php if($product['discount']): ?>
                                 <p>$<?=$product['pricedown'];?></p>
                                 <span class="pric1"><del>$<?=$product['price'];?></del></span>
                                 <span class="disc">[<?=$product['discount']?>% Off]</span>
                             <?php else: ?>
                                 <p>$<?=$product['price'];?></p>
                             <?php endif; ?>
                         </div>
                         <div class="viw">
                            <a href="#"><span class="glyphicon glyphicon-eye-open" aria-hidden="true"></span>Посмотреть</a>
                         </div>
					 </a>
				 </li>
				 <?php endforeach; ?>
				</ul>
				<script type="text/javascript">
				 $(window).load(function() {			
				  $("#flexiselDemo1").flexisel({
					visibleItems: 4,
					animationSpeed: 1000,
					autoPlay: true,
					autoPlaySpeed: 3000,    		
					pauseOnHover:true,
					enableResponsiveBreakpoints: true,
					responsiveBreakpoints: { 
						portrait: { 
							changePoint:480,
							visibleItems: 1
						}, 
						landscape: { 
							changePoint:640,
							visibleItems: 2
						},
						tablet: { 
							changePoint:768,
							visibleItems: 3
						}
					}
				});
				});
				</script>
							<script type="text/javascript" src="js/jquery.flexisel.js"></script>	  
				 </div>
			</div>			
			<!---->
		    </div>
		    <?=$this->render('/partials/rsidebar.php', [
                'categoriesForSidebar' => $categoriesForSidebar,
                'brends' => $brends,
                'types' => $types,
            ]); ?>
		     <div class="clearfix"></div>
	  </div>	 
</div>