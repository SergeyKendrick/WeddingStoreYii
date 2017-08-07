<?php

use yii\db\Migration;

class m170806_071246_add_product_id_and_user_id_columns_to_discount extends Migration
{

    public function up()
    {
        $this->addColumn('discounts', 'product_id', $this->integer());
        $this->addColumn('discounts', 'user_id', $this->integer());
    }

    public function down()
    {
        echo "m170806_071246_add_product_id_and_user_id_columns_to_discount cannot be reverted.\n";

        return false;
    }
}
