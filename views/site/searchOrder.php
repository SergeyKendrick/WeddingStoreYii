<?php
use yii\helpers\Url;
use yii\widgets\Pjax;

?>


<div class="container" style="margin-bottom: 150px;">
   <?php Pjax::begin(); ?>
    <form id="createOrder" action="<?=Url::toRoute(['site/search-order'])?>" style="position: relative; width: 100%; height: 40px; max-width: 400px; margin: 40px auto;" method="get">
        <input type="text" class="text" style="position: absolute; left: 0; width: 100%; height: 100%; padding-right: 90px; line-height: 1.75; font-size: 18px; display: inline-block;" name="order" />
        <input type="submit"  style="position: absolute; right: 0; padding: 8px 20px; height: 100%; border-radius: none !important; background-color: #00A0DC; color: #fff; border: none; font-size: 15px; display: inline-block;" value="Найти" />
        
    </form>
    
    <?php if($order): ?>
    
    <?=$order; ?>
    
    <?php endif; ?>
    <?php Pjax::end(); ?>
    
    
</div>