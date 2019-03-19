<?php

namespace common\components;


use common\models\tables\Projects;
use common\models\tables\TelegramSubscriptions;
use yii\base\Component;
use SonkoDmitry\Yii\TelegramBot\Component as TelegramComponent;
use Yii;
use yii\base\Event;

class ProjectMessengerComponent extends Component
{
    public function init()
    {
        parent::init();

        Event::on(Projects::class, Projects::EVENT_AFTER_INSERT, function (Event $event) {
            $model = $event->sender;
            $title = $model->title;
            $message = "New project '{$title}' has been created.";

            $subscriberIds = TelegramSubscriptions::find()
                ->where(['channel' => TelegramSubscriptions::PROJECT_CREATION])
                ->column('telegram_user_id');

            foreach ($subscriberIds as $subscriberId) {
                /**
                 * @var TelegramComponent $bot
                 */
                $bot = Yii::$app->bot;
                $bot->sendMessage((int)$subscriberId, $message);
            }
        });
    }

}