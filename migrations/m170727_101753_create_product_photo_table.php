<?php

use yii\db\Migration;

/**
 * Handles the creation of table `product_photo`.
 */
class m170727_101753_create_product_photo_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('product_photo', [
            'id' => $this->primaryKey(),
            'product_id' => $this->integer(),
            'file_path' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('product_photo');
    }
}
