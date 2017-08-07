<?php

use yii\db\Migration;

class m170807_072344_add_category_to_article_collumn extends Migration
{
    public function safeUp()
    {
        $this->addColumn('article', 'category', $this->string());
    }

    public function safeDown()
    {
        echo "m170807_072344_add_category_to_article_collumn cannot be reverted.\n";

        return false;
    }

    /*
    // Use up()/down() to run migration code without a transaction.
    public function up()
    {

    }

    public function down()
    {
        echo "m170807_072344_add_category_to_article_collumn cannot be reverted.\n";

        return false;
    }
    */
}
