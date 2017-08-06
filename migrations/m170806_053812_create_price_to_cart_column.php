<?php

use yii\db\Migration;

class m170806_053812_create_price_to_cart_column extends Migration
{
    
    public function up()
    {
        $this->addColumn('cart', 'price', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('product');

        return false;
    }
}
