<?php

namespace console\helpers;

use Yii;
use yii\base\Model;

/**
 * Class Mailer is a wrapper for mailer component.
 * @package app\models
 */
class Mailer extends Model
{
    const SEND_SUCCESS = "Notification(s) successfully sent.\n";
    const SEND_ERROR = "Error occurred!\n";
    const TASKS_NOT_FOUND = "There is no tasks that are going to expire.\n";

    /**
     * Sends a notification.
     * @param $email
     * @param $subject
     * @param $message
     * @return bool
     */
    public static function notify($email, $subject, $message)
    {
        return Yii::$app->mailer->compose()
            ->setTo($email)
            ->setSubject($subject)
            ->setTextBody($message)
            ->send();
    }
}