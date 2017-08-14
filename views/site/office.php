<?php

use yii\helpers\Html;
use yii\bootstrap\ActiveForm;
use yii\helpers\Url;
use yii\bootstrap\Tabs;

$this->title = 'Личный кабинет';
$this->params['breadcrumbs'][] = $this->title;

?>

<div class="container">
   <div class="tabbable tabs-right">
    <ul class="nav nav-tabs" style="margin-bottom: 40px;">
        <li class="active"><a href="#tab1" data-toggle="tab">Информация о пользователе</a></li>
        <li><a href="#tab2" data-toggle="tab">История заказов</a></li>
    </ul>
    <div class="tab-content">
        <div id="tab1" class="tab-pane active">
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
        </div>
        <div id="tab2" class="tab-pane">
            <div class="orders-box" style="width: 60%;">
            
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
                <?php $historyOrder['products'] = unserialize($historyOrder['products']); ?>
                <?php foreach($historyOrder['products'] as $product): ?> 
                    <ul class="cart-header">
                        <li class="ring-in"><a href="" ><img src="<?=$product['photo_preview'] ?>" class="img-responsive" alt=""></a>
                        </li>
                        <li><span><a href=""><?=$product['title'] ?></a></span></li>
                        <li><span>$ <?=$product['price'] ?></span></li>
                        <li><span><?=$product['count']?></span></li>
                        <li><span>$ <?=$product['totalPrice'] ?></span></li>
                        <div class="clearfix"> </div>
                    </ul>
                <?php endforeach; ?> 
                 </div>
            <?php endforeach; ?> 
            </div>
        </div>
    </div>
</div>
    
    
    
    
    
</div>
