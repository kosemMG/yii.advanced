<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%telegram_subscriptions}}`.
 */
class m190319_120448_create_telegram_subscriptions_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%telegram_subscriptions}}', [
            'id' => $this->primaryKey(),
            'telegram_user_id' => $this->integer(),
            'channel' => $this->string()
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable('{{%telegram_subscriptions}}');
    }
}
