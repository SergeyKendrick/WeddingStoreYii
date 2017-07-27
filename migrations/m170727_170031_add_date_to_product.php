<?php

use yii\db\Migration;

class m170727_170031_add_date_to_product extends Migration
{

    public function up()
    {
        $this->addColumn('product', 'date', $this->date());
    }

    public function down()
    {
        $this->dropColumn('product');

        return false;
    }
}
