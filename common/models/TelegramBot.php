<?php

namespace common\models;


use common\models\tables\TelegramSubscriptions;
use SonkoDmitry\Yii\TelegramBot\Component;
use yii\base\Model;
use Yii;

class TelegramBot extends Model
{
    /**
     * @var Component
     */
    private $bot;

    /**
     * Bot initialization.
     */
    public function init()
    {
        parent::init();
        $this->bot = Yii::$app->bot;
    }

    /**
     * @param string $message
     * @param int $fromId
     * @return bool
     * @throws \TelegramBot\Api\Exception
     * @throws \TelegramBot\Api\InvalidArgumentException
     */
    public function processCommand(string $message, int $fromId)
    {
        $response = 'Unknown command';

        $params = explode(' ', $message);
        $command = $params[0];
        unset($params[0]);

        switch ($command) {
            case '/help':
                $response = "Available commands:\n";
                $response .= "/help - the list of commands;\n";
                $response .= "/project_create ##project_name## - create a new project;\n";
                $response .= "/task_create ##task_name## ##responsible## ##project## - create a new task;\n";
                $response .= "/sp_create  - project creation subscription.\n";
                break;
            case "/sp_create":
                if (!(new TelegramSubscriptions())->subscriberExists($fromId)) {
                    (new TelegramSubscriptions([
                        'telegram_user_id' => $fromId,
                        'channel' => TelegramSubscriptions::PROJECT_CREATION
                    ]))->save();
                    $response = 'You are subscribed to project creation.';
                } else {
                    $response = 'You are already subscribed.';
                }
                break;
        }

        $this->bot->sendMessage($fromId, $response);

        return true;
    }

    /**
     * Gets a telegram bot.
     * @return Component
     */
    public function getBot()
    {
        return $this->bot;
    }
}