<?php

use yii\db\Migration;

/**
 * Handles the creation of table `discounts`.
 */
class m170727_101819_create_discounts_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('discounts', [
            'id' => $this->primaryKey(),
            'code'=> $this->string(),
            'discount' => $this->integer(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('discounts');
    }
}
