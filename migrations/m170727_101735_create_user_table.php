<?php

use yii\db\Migration;

/**
 * Handles the creation of table `user`.
 */
class m170727_101735_create_user_table extends Migration
{
    /**
     * @inheritdoc
     */
    public function up()
    {
        $this->createTable('user', [
            'id' => $this->primaryKey(),
            'first_name' => $this->string(),
            'last_name' => $this->string(),
            'email' => $this->string(),
            'mobile' => $this->string()->defaultValue(NULL),
            'sex' => $this->integer(),
            'password' => $this->string(),
            'isAdmin' => $this->integer()->defaultValue(0),
        ]);
    }

    /**
     * @inheritdoc
     */
    public function down()
    {
        $this->dropTable('user');
    }
}
