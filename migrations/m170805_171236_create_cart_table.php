<?php

use yii\db\Migration;

/**
 * Handles the creation of table `cart`.
 */
class m170805_171236_create_cart_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('cart', [
            'id' => $this->primaryKey(),
            'user_id'=> $this->string(),
            'product_id' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('cart');
    }
}
