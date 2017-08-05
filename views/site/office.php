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
    
    
    
    
    
    
</div>
