<?php

use yii\db\Migration;

/**
 * Handles the creation of table `global_category`.
 */
class m170801_043801_create_global_category_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('global_category', [
            'id' => $this->primaryKey(),
            'title' => $this->string(),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('global_category');
    }
}
