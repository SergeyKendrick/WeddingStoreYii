<?php

use yii\db\Migration;

class m170801_044220_add_global_id_to_category extends Migration
{
    public function up()
    {
        $this->addColumn('category', 'global_category_id', $this->integer());
    }

    public function down()
    {
        $this->dropColumn('global_category_id');

        return false;
    }
}
