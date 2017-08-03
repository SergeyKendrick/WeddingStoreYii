<?php 

use yii\helpers\Url;

?>

<div class="rsidebar span_1_of_left">
     <section  class="sky-form">
         <div class="product_right">
             <h4 class="m_2"><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Категории</h4>
             <?php foreach($categoriesForSidebar as $globalCategory): ?>
                 <div class="tab">
                     <ul class="place">								
                         <li class="sort"><?=$globalCategory['title']?></li>
                         <li class="by"><img src="/front/images/do.png" alt=""></li>
                            <div class="clearfix"> </div>
                      </ul>
                     <div class="single-bottom">
                        <?php foreach($globalCategory['sub_categories'] as $category): ?>						
                            <a href="<?=Url::toRoute(['site/catalog', 'id' => $category['id']]) ?>"><p><?=$category['title']?></p></a>
                        <?php endforeach; ?>
                     </div>
                  </div>
              <?php endforeach; ?>						  


              <!--script-->
            <script>
                
            </script>
            <!-- script -->					 
     </section>
     <section  class="sky-form">
         <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Скидки</h4>
         <div class="row row1 scroll-pane">
             <div class="col col-4">
                    <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Upto - 10% (20)</label>
             </div>
             <div class="col col-4">
                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>40% - 50% (5)</label>
                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>30% - 20% (7)</label>
                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>10% - 5% (2)</label>
                    <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Other(50)</label>
             </div>
         </div>
     </section> 				 				 
       <section  class="sky-form">
            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Price</h4>
                <ul class="dropdown-menu1">
                     <li><a href="">								               
                    <div id="slider-range"></div>							
                    <input type="text" id="amount" style="border: 0; font-weight: NORMAL;   font-family: 'Arimo', sans-serif;" />
                 </a></li>			
              </ul>
       </section>
       <!---->
         <script type="text/javascript" src="js/jquery-ui.min.js"></script>
         <link rel="stylesheet" type="text/css" href="css/jquery-ui.css">
        <script type='text/javascript'>//<![CDATA[ 
        $(window).load(function(){
         $( "#slider-range" ).slider({
                    range: true,
                    min: 0,
                    max: 400000,
                    values: [ 8500, 350000 ],
                    slide: function( event, ui ) {  $( "#amount" ).val( "$" + ui.values[ 0 ] + " - $" + ui.values[ 1 ] );
                    }
         });
        $( "#amount" ).val( "$" + $( "#slider-range" ).slider( "values", 0 ) + " - $" + $( "#slider-range" ).slider( "values", 1 ) );

        });//]]> 
        </script>
         <!---->
         <section  class="sky-form">
            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Type</h4>
                <div class="row row1 scroll-pane">
                    <div class="col col-4">
                        <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>1 Gram Gold (30)</label>
                    </div>
                    <div class="col col-4">
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Gold Plated   (30)</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Platinum      (30)</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Silver        (30)</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Jewellery Sets  (30)</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Stone Items   (30)</label>
                    </div>
                </div>
       </section>
            <section  class="sky-form">
            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Brand</h4>
                <div class="row row1 scroll-pane">
                    <div class="col col-4">
                        <label class="checkbox"><input type="checkbox" name="checkbox" checked=""><i></i>Akasana Collectio</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Colori</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Crafts Hub</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Jisha</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Karatcart</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox" ><i></i>Titan</label>
                        <label class="checkbox"><input type="checkbox" name="checkbox"><i></i>Amuktaa</label>
                    </div>
                </div>
       </section>			
    </div>				 