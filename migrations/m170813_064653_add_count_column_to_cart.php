<?php

use yii\db\Migration;

class m170813_064653_add_count_column_to_cart extends Migration
{
    public function Up()
    {
        $this->addColumn('cart', 'count', $this->integer());
        
        return false;
    }

    public function safeDown()
    {
        echo "m170813_064653_add_count_column_to_cart cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170813_064653_add_count_column_to_cart cannot be reverted.\n";

        return false;
    }
    */
}
