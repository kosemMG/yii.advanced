<?php

namespace console\controllers;

use console\models\ExpireTasksData;
use Yii;
use console\helpers\Mailer;
use yii\console\Controller;
use yii\console\ExitCode;
use yii\helpers\Console;

/**
 * Class TaskController contains task utilities.
 * @package app\commands
 */
class TaskController extends Controller
{
    /**
     * Notifies a user when the task due date expires in less than one day.
     * @throws \yii\db\Exception
     */
    public function actionNotify()
    {
        if (!$tasks = (new ExpireTasksData())->getTasks()) {
            $this->stdout(Mailer::TASKS_NOT_FOUND, Console::FG_CYAN, Console::BOLD);
            return ExitCode::OK;
        }

        $subject = 'Hurry up!';

        foreach ($tasks as $task) {
            $taskReference = "http://yii.homework/tasks/{$task['id']}";
            $message = "Dear {$task['name']}, the task {$task['title']} due date expires in less than one day 
                on {$task['due_date']}. \nPlease, follow to {$taskReference} and finish it.\n";

            if (!Mailer::notify($task['email'], $subject, $message)) {
                $this->stdout(Mailer::SEND_ERROR, Console::FG_RED, Console::BOLD);
                return ExitCode::UNSPECIFIED_ERROR;
            }
        }

        $this->stdout(Mailer::SEND_SUCCESS, Console::FG_GREEN, Console::BOLD);
        return ExitCode::OK;
    }


}