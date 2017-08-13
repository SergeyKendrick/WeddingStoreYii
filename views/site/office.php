<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
    
    <table class="table" style="margin-bottom: 50px; width: 40%;">
            <tr>
                <td>
                    Имя
                </td>
                <td>
                    <?=$userInfo->first_name;?>
                </td>
            </tr>
            <tr>
                <td>
                    Фамилия
                </td>
                <td>
                    <?=$userInfo->last_name;?>
                </td>
            </tr>
            <tr>
                <td>
                    Телефон
                </td>
                <td>
                    <?=$userInfo->mobile;?>
                </td>
            </tr>
            <tr>
                <td>
                    Пол
                </td>
                <td>
                    <?=($userInfo->first_name) ? 'Мужской' : 'Женский';?>
                </td>
            </tr>
    </table>
    
    <div style="width: 60%;">
    <?php foreach($historyOrders as $historyOrder): ?> 
        <ul class="header-order" style="text-align: center;">
            <li><span><?=$historyOrder['order_number'] ?></span></li>
            <li><span><?=$historyOrder['date'] ?></span></li>		
            <li><span><?=$historyOrder['status'] ?></span></li>
            <div class="clearfix"> </div>
        </ul>
        <div class="in-order-history" >
            <ul class="unit" style="text-align: center;">
                <li><span>Товар</span></li>
                <li><span>Наименование</span></li>		
                <li><span>Цена</span></li>
                <li><span>Количество</span></li>
                <li><span>Итог</span></li>
                <div class="clearfix"> </div>
            </ul>
        <?php foreach($historyOrder['products'] as $product): ?> 
            <ul class="cart-header">
                <a data-pjax="1" class="close1" href=""> </a>
                <li class="ring-in"><a href="" ><img src="<?=$product['photo_preview'] ?>" class="img-responsive" alt=""></a>
                </li>
                <li><span><a href=""><?=$product['title'] ?></a></span></li>
                <li><span>$ <?=$product['price'] ?></span></li>
                <li><span><?=$product['count']?></span></li>
                <div class="clearfix"> </div>
            </ul>
        <?php endforeach; ?> 
         </div>
    <?php endforeach; ?> 
    </div>
    
    
    
</div>
