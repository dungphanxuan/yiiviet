<?php

use yii\db\Migration;

class m140703_123804_article_tags extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%article_tags}}', [
            'id' => $this->primaryKey(),
            'frequency' => $this->integer()->defaultValue(0),
            'name' => $this->string(128),
            'slug' => $this->string(128),
        ]);

        $this->createTable('{{%article2article_tags}}', [
            'article_id' => $this->integer(),
            'article_tag_id' => $this->integer(),
        ]);

        $this->addForeignKey('article2article_tags_article', '{{%article2article_tags}}', 'article_id', '{{%article}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('article2article_tags_article_tags', '{{%article2article_tags}}', 'article_tag_id', '{{%article_tags}}', 'id', 'CASCADE', 'CASCADE');
    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable('{{%article2article_tags}}');
        $this->dropTable('{{%article_tags}}');
    }
}
