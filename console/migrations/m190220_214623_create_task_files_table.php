<?php

use yii\db\Migration;
use frontend\models\tables\Tasks;

/**
 * Handles the creation of table `{{%task_files}}`.
 */
class m190220_214623_create_task_files_table extends Migration
{
    private $tableName = 'task_files';
    private $taskFilesFk = 'fk_tasks_files_tasks';
    private $taskIdIndex = 'idx_task_files_task_id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->tableName, [
            'id' => $this->primaryKey(),
            'task_id' => $this->integer()->notNull(),
            'path' => $this->string()->notNull(),
            'path_small' => $this->string()->notNull(),
        ]);

        $tasksTable = Tasks::tableName();
        $this->addForeignKey($this->taskFilesFk, $this->tableName, 'task_id', $tasksTable, 'id');

        $this->createIndex($this->taskIdIndex, $this->tableName, 'task_id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->tableName);
    }
}
