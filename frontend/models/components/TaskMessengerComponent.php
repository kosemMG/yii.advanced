<?php

namespace frontend\models\components;


use frontend\models\tables\Tasks;
use frontend\models\tables\Users;
use yii\base\Component;
use yii\base\Event;
use Yii;
use yii\helpers\Url;

class TaskMessengerComponent extends Component
{
    private $subject = 'New task';

    public function init()
    {
        parent::init();

        Event::on(Tasks::class, Tasks::EVENT_AFTER_INSERT, function (Event $event) {
            $model = $event->sender;

            $executor = Users::findOne($model->executor_id);
            $creator = Users::findOne($model->creator_id);
            $taskReference = $_SERVER['HTTP_ORIGIN'] . Url::to(['task/one', 'id' => $model->id]);

            $body = "Dear {$executor->name}, you have received a new task {$model->title}.\n
                Please, follow to {$taskReference} \n
                You should finish it until {$model->due_date}. Good luck!";

            Yii::$app->mailer->compose()
                ->setTo($executor->email)
                ->setFrom([$creator->email => $creator->name])
                ->setSubject($this->subject)
                ->setTextBody($body)
                ->send();
        });
    }

}