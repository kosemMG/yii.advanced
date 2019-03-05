<?php

use yii\db\Migration;
use frontend\models\tables\Tasks;
use frontend\models\tables\Users;

/**
 * Handles the creation of table `{{%task_comments}}`.
 */
class m190223_222636_create_task_comments_table extends Migration
{
    private $tableName = 'task_comments';

    private $fkCommentsTasks = 'fk_comments_tasks';
    private $fkCommentsUsers = 'fk_comments_users';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'content' => $this->string(),
            'task_id' => $this->integer(),
            'user_id' => $this->integer(),
        ]);

        $tasksTable = Tasks::tableName();
        $usersTable = Users::tableName();

        $this->addForeignKey($this->fkCommentsTasks, $this->tableName, 'task_id', $tasksTable, 'id');
        $this->addForeignKey($this->fkCommentsUsers, $this->tableName, 'user_id', $usersTable, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
