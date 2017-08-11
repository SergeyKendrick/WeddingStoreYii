<?php

namespace app\models;

use Yii;
use yii\data\Pagination;

/**
 * This is the model class for table "global_category".
 *
 * @property integer $id
 * @property string $title
 */
class Sidebar
{
    public static function getItems() {
        $category_obj = new Category;
        $sidebar = [];
        
        $sidebar['category'] = $category_obj->getAllCategories();
        $sidebar['discount'] = Sidebar::getDiscountForSidebar();
        $sidebar['brand'] = Sidebar::getItemsForSidebar('brand');
        $sidebar['type'] = Sidebar::getItemsForSidebar('type');
        
        return $sidebar;
    }
    
        public function getDiscountForSidebar() {
        $items = [
            1 => [
                'discount' => '5% - 10%',
            ],
            2 => [
                'discount' => '10% - 20%',
            ],
            3 => [
                'discount' => '30% - 40%',
            ],
            4 => [
                'discount' => '40% - 50%',
            ],
            5 => [
                'discount' => 'Другие',
            ],
        ];
        
        foreach($items as &$item) {
            if($item['discount'] != 'Другие') {
                $discounts = str_replace('%', '', $item['discount']);
                $discounts = explode(' - ', $discounts);

                $item['count'] = Product::find()->where('discount >= '.(int)$discounts[0].' AND discount <='.(int)$discounts[1])->count();
            } else {
                $item['count'] = Product::find()->where('discount >= 50')->count();
            }
            
        }
        
        return $items;
    }
    
    public static function getItemsForSidebar($checkType) {
        $items = Product::find()->asArray()->select("DISTINCT `$checkType`")->all();
        
        foreach($items as &$item) {
            $item['count'] = Product::find()->where([$checkType => $item[$checkType]])->count();
        }
        
        return $items;
    }
    
    public function getProducts($data) {
        $discount = $data['discount'];
        $price = explode(' - ', str_replace('$', '', $data['price']));
        $type = $data['type'];
        $brand = $data['brand'];
        
        $discount = $this->sqlDiscount($discount);
        $price = $this->sqlPrice($price);
        $type = $this->sqlType($type);
        $brand = $this->sqlBrand($brand);
        
        $sql = $discount . $price . $type . $brand;
        
        $query = Product::find()->where($sql);
        $count = $query->count();
        $pagination = new Pagination(['totalCount' => $count, 'pageSize' => 12]);
        // limit the query using the pagination and retrieve the articles
        $products = $query->asArray()->offset($pagination->offset)
            ->limit($pagination->limit)
            ->where($sql)
            ->all();
        
        foreach($products as &$product) {
            $product['photo_preview'] = Product::getPreviewPhoto($product['id']);
            if($product['discount']) {
                $product['price'] = $product['price'] - $product['price'] / 100 * $product['discount'];
            }
        }
        
        $data['products'] = $products;
        $data['pagination'] = $pagination;
        
        return $data;
    }
    
    public function sqlDiscount($discount) {
        if(!$discount) {
            return '';
        }
        foreach ($discount as $item) {
            if($item != 'Другие') {
            $params = explode(' - ', str_replace('%', '', $item));
            $sql = $sql . "(`discount` >= $params[0] AND `discount` <= $params[1]) ";
            } else {
                $sql = $sql . "(`discount` >= 50)";
            }
            if(next($discount)) {
                $sql = $sql . "OR ";
            }
        }
        
        $sql = $sql . ' AND ';
        
        return $sql;
    }
    
    public function sqlPrice($price) {
        $sql = "(`price` >= $price[0] AND `price` <= $price[1]) ";
        
        return $sql;
    }
    
    public function sqlType($type) {
        if(!$type) {
            return '';
        }
        
        $sql = " AND (";
        
        foreach($type as $item) {
            $sql = $sql . "`type` = '$item'";
            
            if(next($type)) {
                $sql = $sql . " OR ";
            }
        }
        
        $sql = $sql . ")";
        
        return $sql;
    }
    
    public function sqlBrand($brand) {
        if(!$brand) {
            return '';
        }
        
        $sql = " AND (";
        
        foreach($brand as $item) {
            $sql = $sql . "`brand` = '$item'";
            
            if(next($brand)) {
                $sql = $sql . " OR ";
            }
        }
        
        $sql = $sql . ")";
        
        return $sql;
    }
}
