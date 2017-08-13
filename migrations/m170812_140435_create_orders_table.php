<?php

use yii\db\Migration;

/**
 * Handles the creation of table `orders`.
 */
class m170812_140435_create_orders_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('orders', [
            'id' => $this->primaryKey(),
            'order_number' => $this->string(),
            'products' => $this->string(),
            'user_id' => $this->integer(),
            'status' => $this->string(),
            'date' => $this->date(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('orders');
    }
}
