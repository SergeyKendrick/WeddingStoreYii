<?php

use yii\db\Migration;

class m170804_084006_add_voted_users_to_products extends Migration
{
    
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {
        $this->addColumn('product', 'voted_users', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('voted_users');

        return false;
    }
}
