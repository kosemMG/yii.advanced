<?php

use yii\db\Migration;
use frontend\models\tables\Tasks;

/**
 * Handles the creation of table `task_statuses`.
 */
class m190119_211940_create_task_statuses_table extends Migration
{
    protected $table_name = 'task_statuses';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable($this->table_name, [
            'id' => $this->primaryKey(),
            'name' => $this->string(50)
        ]);

        $this->batchInsert($this->table_name, ['name'], [
            ['New'],
            ['In progress'],
            ['Done'],
            ['Testing'],
            ['Rework'],
            ['Finished'],
        ]);

        $tasks_table = Tasks::tableName();

        $this->addForeignKey('fk_task_statuses',$tasks_table, 'status_id', $this->table_name, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropTable($this->table_name);
    }
}
