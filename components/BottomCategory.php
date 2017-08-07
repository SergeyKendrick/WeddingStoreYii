<?php

namespace app\components;

use yii\helpers\Html;
use yii\base\Widget;
use app\models\Category;


class BottomCategory extends Widget {
    
    public function run() {
        
        $categories = Category::getBottomCategories();
    
        foreach($categories as $category) {     
            $menu = $menu . "<li>".Html::a($category->title, ['site/catalog', 'id' => $category->id])."</li>";
        }

        return $menu;
        
    }
    
}




?> 