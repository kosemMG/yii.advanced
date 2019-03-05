<?php

namespace console\models;

use Yii;
use yii\db\ActiveRecord;

class ExpireTasksData extends ActiveRecord
{
    /**
     * Gets a prepared data array from DB.
     * @return array
     * @throws \yii\db\Exception
     */
    public function getTasks()
    {
        $sql = "SELECT tasks.id AS id, title, due_date, name, email FROM tasks
                LEFT JOIN users ON tasks.executor_id = users.id
                WHERE DATE(due_date) = CURDATE() + INTERVAL 1 DAY";

        return Yii::$app->db->createCommand($sql)->queryAll();
    }
}