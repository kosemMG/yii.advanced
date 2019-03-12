<?php

use yii\db\Migration;
use common\models\tables\Users;

/**
 * Handles the creation of table `{{%chat}}`.
 */
class m190311_204514_create_chat_table extends Migration
{
    private $tableName = 'chat';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'message' => $this->string()->notNull(),
            'author_id' => $this->integer()->notNull(),
            'channel' => $this->string()->notNull(),
            'created_at' => $this->dateTime()
        ]);

        $refTable = Users::tableName();

        $this->addForeignKey('fk_users_author', $this->tableName, 'author_id', $refTable, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%chat}}');
    }
}
