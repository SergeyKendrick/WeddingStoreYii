<?php

use yii\db\Migration;

class m170811_144719_add_pricedown_column_to_product extends Migration
{
    public function up()
    {
        $this->addColumn('product', 'pricedown', $this->integer());
    }

    public function down()
    {
        echo "m170806_071246_add_product_id_and_user_id_columns_to_discount cannot be reverted.\n";

        return false;
    }
}
