<?php 

use yii\helpers\Url;
use yii\helpers\Html;

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
			 
     </section>
     <?=Html::beginForm(['/site/submit'], 'post')?>
     <section  class="sky-form">
         <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Скидки</h4>
         <div class="row row1 scroll-pane">
             <div class="col col-4">
                <?php foreach($discounts as $discount): ?>
                    <label class="checkbox"><input type="checkbox" name="discount[]" value="<?=$discount['discount']?>"><i></i><?=$discount['discount']?> (<?=$discount['count']?>)</label>
                <?php endforeach; ?>
             </div>
         </div>
     </section> 				 				 
       <section  class="sky-form">
            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Price</h4>
                <ul class="dropdown-menu1">
                     <li>								               
                    <div id="slider-range"></div>			
                    <input type="text" id="amount" name="price" style="border: 0; font-weight: NORMAL;   font-family: 'Arimo', sans-serif;" />
                </li>			
              </ul>
       </section>
       <!---->
         <!---->
         <section  class="sky-form">
            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Тип</h4>
                <div class="row row1 scroll-pane">
                    <div class="col col-4">
                        <?php foreach($types as $type): ?>
                            <?php if($type['type']): ?>
                                <label class="checkbox"><input type="checkbox" name="type[]" value="<?=$type['type']?>"><i></i><?=$type['type']?> (<?=$type['count']?>)</label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
       </section>
            <section  class="sky-form">
            <h4><span class="glyphicon glyphicon-minus" aria-hidden="true"></span>Бренд</h4>
                <div class="row row1 scroll-pane">
                    <div class="col col-4">
                        <?php foreach($brends as $brend): ?>
                            <?php if($brend['brand']): ?>
                            <label class="checkbox"><input type="checkbox" name="brand[]" value="<?=$brend['brand']?>"><i> </i><?=$brend['brand']?> (<?=$brend['count']?>)</label>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </div>
                </div>
       </section>		
       <input type="submit">
                    <?=Html::endForm()?>
    </div>				 