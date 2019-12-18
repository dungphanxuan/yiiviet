<?php

use common\models\User;
use yii\db\Migration;

class m140703_123002_ratting extends Migration
{
    /**
     * @return bool|void
     */
    public function safeUp()
    {
        $this->createTable('{{%rating}}', [
            'user_id' => $this->integer()->notNull(),
            'object_type' => $this->string(128)->notNull(),
            'object_id' => $this->integer()->notNull(),
            'rating' => $this->smallInteger()->notNull(),
            'created_at' => $this->dateTime()->notNull(),
            'PRIMARY KEY(user_id, object_type, object_id)'
        ]);
        $this->addForeignKey('fk-rating-user_id-user-id', '{{%rating}}', 'user_id', '{{%user}}', 'id', 'RESTRICT', 'CASCADE');

    }

    /**
     * @return bool|void
     */
    public function safeDown()
    {
        $this->dropTable('{{%rating}}');

    }
}
