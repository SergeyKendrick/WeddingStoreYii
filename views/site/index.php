<?php 
use yii\helpers\Url;
$this->title = 'Wedding store';

?>

<div class="banner">
	 <div class="container">
	 </div>
</div>
<!---->
<div class="welcome">
	 <div class="container">
		 <div class="col-md-3 welcome-left">
			 <h2>Welcome to our site</h2>
		 </div>
		 <div class="col-md-9 welcome-right">
			 <h3>Proin ornare massa eu enim pretium efficitur.</h3>
			 <p>Etiam fermentum consectetur nulla, sit amet dapibus orci sollicitudin vel. 
			 Nulla consequat turpis in molestie fermentum. In ornare, tellus non interdum ultricies, elit 
			 ex lobortis ex, aliquet accumsan arcu tortor in leo. Nullam molestie elit enim. Donec ac 
			 aliquam quam, ac iaculis diam. Donec finibus scelerisque erat, non convallis felis commodo ac.</p>
		 </div>
	 </div>
</div>
<!---->
<div class="bride-grids">
	 <div class="container">
		 <div class="col-md-4 bride-grid">
			 <div class="content-grid l-grids">
				 <figure class="effect-bubba">
						<img src="/front/images/b1.jpg" alt=""/>
						<figcaption>
							<h4>Nullam molestie </h4>
							<p>In sit amet sapien eros Integer in tincidunt labore et dolore magna aliqua</p>																
						</figcaption>			
				 </figure>
				 <div class="clearfix"></div>
				 <h3>Wedding Dresses</h3>
			 </div>
			 <div class="content-grid l-grids">
				 <figure class="effect-bubba">
						<img src="/front/images/b2.jpg" alt=""/>
						<figcaption>
							<h4>Nullam molestie </h4>
							<p>In sit amet sapien eros Integer in tincidunt labore et dolore magna aliqua</p>																
						</figcaption>			
				 </figure>	
				 <div class="clearfix"></div>
				 <h3>BridalParty & Dresses</h3>
			 </div>
		 </div>
		 <div class="col-md-4 bride-grid">
				<div class="content-grid l-grids">
						<img src="/front/images/brid.jpg" style="width: 98%; margin: 0 auto; display: block;" alt=""/>
						
				 <h3>Bridesmaid Dresses</h3>
			 </div>
		 </div>
		 <div class="col-md-4 bride-grid">
			 <div class="content-grid l-grids">
				 <figure class="effect-bubba">
						<img src="/front/images/b3.jpg" alt=""/>
						<figcaption>
							<h4>Nullam molestie </h4>
							<p>In sit amet sapien eros Integer in tincidunt labore et dolore magna aliqua</p>																
						</figcaption>			
				 </figure>	
				 <div class="clearfix"></div>
				 <h3>Wedding</h3>
			 </div>
			 <div class="content-grid l-grids">
				 <figure class="effect-bubba">
						<img src="/front/images/b4.jpg" alt=""/>
						<figcaption>
							<h4>Nullam molestie </h4>
							<p>In sit amet sapien eros Integer in tincidunt labore et dolore magna aliqua</p>																
						</figcaption>			
				 </figure>
					<div class="clearfix"></div>
				 <h3>Most Beautiful</h3>
			 </div>
		 </div>
		 <div class="clearfix"></div>
	 </div>
</div>
<!---->
<div class="featured">
	 <div class="container">
		 <h3>Рекомендумые товары</h3>
		 <div class="feature-grids">
             <?php $i=0; ?>
             <?php foreach($recomendProducts as $product): ?>
             <?php if($i == 4): ?>
                      <div class="clearfix"></div>
                 </div>
                <div class="feature-grids">
             <?php endif; ?>     
             <?php $i++; ?>       
				 <div class="col-md-3 feature-grid">
					 <a href="<?=Url::toRoute(['site/product-detail', 'id' => $product['id']]) ?>">
					     <img height="230" src="<?=$product['photo_preview'];?>" alt=""/>	
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
				 </div>
                 <?php endforeach; ?>
                </div>
	 </div>
</div>
<!---->
<div class="arrivals">
	 <div class="container">	
		 <h3>Новые поступления</h3>
		 <div class="arrival-grids">	
		     <?php if($newProducts): ?>		 
			 <ul id="flexiselDemo1">
			     <?php foreach($newProducts as $product): ?>
				 <li>
					 <a href="<?=Url::toRoute(['site/product-detail', 'id' => $product['id']]) ?>">
					     <img height="230" src="<?=$product['photo_preview'];?>" alt=""/>	
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
             <?php endif; ?>		 
		  </div>
	 </div>
</div>

<?php

/* @var $this yii\web\View */

/*

$this->title = 'My Yii Application';
?>
<div class="site-index">

    <div class="jumbotron">
        <h1>Congratulations!</h1>

        <p class="lead">You have successfully created your Yii-powered application.</p>

        <p><a class="btn btn-lg btn-success" href="http://www.yiiframework.com">Get started with Yii</a></p>
    </div>

    <div class="body-content">

        <div class="row">
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/doc/">Yii Documentation &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/forum/">Yii Forum &raquo;</a></p>
            </div>
            <div class="col-lg-4">
                <h2>Heading</h2>

                <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et
                    dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip
                    ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu
                    fugiat nulla pariatur.</p>

                <p><a class="btn btn-default" href="http://www.yiiframework.com/extensions/">Yii Extensions &raquo;</a></p>
            </div>
        </div>

    </div>
</div>
 */