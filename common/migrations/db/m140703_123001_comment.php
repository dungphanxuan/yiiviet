<?php

use common\models\User;
use yii\db\Migration;

class m140703_123001_comment extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%comment}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer()->notNull(),
            'object_type' => $this->string(255)->notNull(),
            'object_id' => $this->string(255)->notNull(),
            'text' => $this->text()->notNull(),
            'status' => $this->smallInteger()->notNull()->defaultValue(10),
            'total_votes' => $this->integer()->defaultValue(0),
            'up_votes' => $this->integer()->defaultValue(0),
            'rating' => $this->double()->defaultValue(0),
            'created_at' => $this->dateTime()->notNull(),
            'updated_at' => $this->dateTime(),
        ]);

        $this->addForeignKey('fk-comment-user_id-user-id', '{{%comment}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');
        $this->createIndex('idx-comment-object_type-object_id', '{{%comment}}', ['object_type', 'object_id']);

    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable('{{%comment}}');
    }
}
