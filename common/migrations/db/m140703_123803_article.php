<?php

use yii\db\Migration;

class m140703_123803_article extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%article_category}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'body' => $this->text(),
            'parent_id' => $this->integer(),
            'thumbnail_base_url' => $this->string(1024),
            'thumbnail_path' => $this->string(1024),
            'order' => $this->smallInteger()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('{{%article}}', [
            'id' => $this->primaryKey(),
            'slug' => $this->string(1024)->notNull(),
            'title' => $this->string(512)->notNull(),
            'body' => $this->text()->notNull(),
            'excerpt' => $this->text(),
            'view' => $this->string(),
            'category_id' => $this->integer(),
            'thumbnail_base_url' => $this->string(1024),
            'thumbnail_path' => $this->string(1024),

            'relate_id' => $this->integer(),
            'order' => $this->smallInteger()->defaultValue(0),
            'status' => $this->smallInteger()->notNull()->defaultValue(0),
            'total_votes' => $this->integer()->defaultValue(0),
            'up_votes' => $this->integer()->defaultValue(0),
            'rating' => $this->double()->defaultValue(0),
            'featured' => $this->boolean()->defaultValue(0),

            'comment_count' => $this->integer()->defaultValue(0),
            'view_count' => $this->integer()->defaultValue(0),
            'mine_type' => $this->integer()->defaultValue(0),

            'created_by' => $this->integer(),
            'updated_by' => $this->integer(),
            'published_at' => $this->integer(),
            'created_at' => $this->integer(),
            'updated_at' => $this->integer(),
        ]);

        $this->createTable('{{%article_attachment}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'path' => $this->string()->notNull(),
            'base_url' => $this->string(),
            'type' => $this->string(),
            'size' => $this->integer(),
            'name' => $this->string(),
            'order' => $this->integer(),
            'created_at' => $this->integer()
        ]);

        $this->createTable('{{%article_pickup}}', [
            'id' => $this->primaryKey(),
            'article_id' => $this->integer()->notNull(),
            'sort_number' => $this->smallInteger()->defaultValue(1),
        ]);

        $this->addForeignKey('fk_article_attachment_article', '{{%article_attachment}}', 'article_id', '{{%article}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_article_author', '{{%article}}', 'created_by', '{{%user}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_article_updater', '{{%article}}', 'updated_by', '{{%user}}', 'id', 'set null', 'cascade');
        $this->addForeignKey('fk_article_category', '{{%article}}', 'category_id', '{{%article_category}}', 'id', 'cascade', 'cascade');
        $this->addForeignKey('fk_article_category_section', '{{%article_category}}', 'parent_id', '{{%article_category}}', 'id', 'cascade', 'cascade');

        $this->createTable('{{%article_revision}}', [
            'article_id' => $this->integer()->notNull(),
            'revision' => $this->integer()->notNull(),

            'title' => $this->string(255)->notNull(),
            'content' => $this->text()->notNull(),

            'tagNames' => $this->string(255),

            'category_id' => $this->integer()->notNull(),
            'yii_version' => $this->string(5),

            // note about what has changed
            'memo' => $this->string(255),

            'updater_id' => $this->integer(),
            'updated_at' => $this->dateTime(),

            'PRIMARY KEY (`article_id`,`revision`)',

        ]);
        $this->addForeignKey('fk-article_revision-article_id-article-id', '{{%article_revision}}', 'article_id', '{{%article}}', 'id', 'CASCADE', 'CASCADE');
        $this->addForeignKey('fk-article_revision-updater_id-user-id', '{{%article_revision}}', 'updater_id', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropForeignKey('fk_article_attachment_article', '{{%article_attachment}}');
        $this->dropForeignKey('fk_article_author', '{{%article}}');
        $this->dropForeignKey('fk_article_updater', '{{%article}}');
        $this->dropForeignKey('fk_article_category', '{{%article}}');
        $this->dropForeignKey('fk_article_category_section', '{{%article_category}}');

        $this->dropTable('{{%article_revision}}');
        $this->dropTable('{{%article_attachment}}');
        $this->dropTable('{{%article}}');
        $this->dropTable('{{%article_category}}');
    }
}
