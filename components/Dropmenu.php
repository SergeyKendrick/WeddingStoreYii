<?php

namespace app\components;

use yii\helpers\Html;
use yii\base\Widget;
use app\models\Category;
use app\models\Product;


class Dropmenu extends Widget {
    
    public function run() {
        
        $template = "<div class='mepanel'><div class='row'> " 
                    . $this->clothCategories() 
                    . $this->ukrashCategories()
                    . $this->brends()
                    . "</div></div>";
        
        return $template;
        
    }
    
    private function clothCategories() {
        $category = new Category;
        $categoriesCloth = $category->getCategoriesForMenu('Одежда');
        
        $result = "<div class='col1 me-one'>
                    <h4>Одежда</h4>
                        <ul>";
        foreach($categoriesCloth as $category) {
            
            $result = $result . '<li>' . Html::a($category['title'], ['site/catalog', 'id' => $category['id']]) . '</li>';
        }
        
        $result = $result . '</ul>' . '</div>';
        
        return $result;
    }
    
    private function ukrashCategories() {
        $category = new Category;
        $categories = $category->getCategoriesForMenu('Украшения');
        
        $result = "<div class='col1 me-one'>
                    <h4>Украшения</h4>
                        <ul>";
        foreach($categories as $category) {
            
            $result = $result . '<li>' . Html::a($category['title'], ['site/catalog', 'id' => $category['id']]) . '</li>';
        }
        
        $result = $result . '</ul>' . '</div>';
        
        return $result;
    }
    
    private function brends() {
        $brends = Product::getBrends();
        
        $result = "<div class='col1 me-one'>
                    <h4>Популярные бренды</h4>
                        <ul>";
        foreach($brends as $brend) {
            
            $result = $result . '<li>' . Html::a($brend['brand'], ['site/brend', 'title' => $brend['brand']]) . '</li>';
        }
        
        $result = $result . '</ul>' . '</div>';
        
        return $result;
    }
    
    
    
}




?> 