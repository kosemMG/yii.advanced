<?php

use yii\db\Migration;
use common\models\tables\Projects;

/**
 * Class m190331_074505_table_tasks_add_column_project_id
 */
class m190331_074505_table_tasks_add_column_project_id extends Migration
{
    private $tasksTable = 'tasks';
    private $projectIdColumn = 'project_id';

    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tasksTable, $this->projectIdColumn, $this->integer());

        $projectsTable = Projects::tableName();
        $this->addForeignKey('fk_projects', $this->tasksTable, $this->projectIdColumn, $projectsTable, 'id');
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tasksTable, $this->projectIdColumn);
    }
}
