<?php

namespace app\components;

use yii\helpers\Html;
use yii\base\Widget;
use app\models\Article;


class BottomMenu extends Widget {
    
    public function run() {
        
        
        
        $categories = Article::find()->where(['category' => 'О нас'])->all();
        
        foreach ($categories as $article) {
            
            $aboutMenu = $aboutMenu . "<li>".Html::a($article->title, ['site/article', 'id' => $article->id])."</li>";
        }
        
        $categories = Article::find()->where(['category' => 'Сервис'])->all();
        
        foreach ($categories as $service) {
            $serviceMenu = $serviceMenu . "<li>".Html::a($service->title, ['site/article', 'id' => $service->id])."</li>";
        }
        
        $menu = "<div class='col-md-3 ftr-grid'>
                    <h4>О нас</h4>
                    <ul>
                        $aboutMenu
                    </ul>
                </div>
                <div class='col-md-3 ftr-grid'>
                     <h4>Сервис</h4>
                     <ul>
                         $serviceMenu				 
                     </ul>
                 </div>
                ";

        return $menu;
        
    }
    
}




?> 