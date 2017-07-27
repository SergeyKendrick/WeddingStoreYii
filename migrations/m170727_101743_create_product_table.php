<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product`.
 */
class m170727_101743_create_product_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product', [
            'id' => $this->primaryKey(),
            'sku' => $this->string(),
            'title' => $this->string(),
            'category_id' => $this->integer(),
            'description' => $this->text(),
            'price' => $this->integer(),
            'brand' => $this->string(),
            'pearl_type' => $this->string()->defaultValue(NULL),
            'color' => $this->string()->defaultValue(NULL),
            'base_material'=> $this->string()->defaultValue(NULL),
            'precious_artif' => $this->string()->defaultValue(NULL),
            'model_number' => $this->string()->defaultValue(NULL),
            'occasion' => $this->string()->defaultValue(NULL),
            'type' => $this->string()->defaultValue(NULL),
            'ideal_for' => $this->string()->defaultValue(NULL),
            'discount' => $this->integer()->defaultValue(NULL),
            'rating' => $this->integer()->defaultValue(0),
            
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product');
    }
}
