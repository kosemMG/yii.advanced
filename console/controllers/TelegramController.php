<?php

namespace console\controllers;


use common\models\tables\TelegramOffset;
use common\models\TelegramBot;
use SonkoDmitry\Yii\TelegramBot\Component;
use yii\console\Controller;
use Yii;

class TelegramController extends Controller
{
    /**
     * Gets new messages number.
     * @throws \TelegramBot\Api\Exception
     * @throws \TelegramBot\Api\InvalidArgumentException
     */
    public function actionIndex()
    {
        $botModel = new TelegramBot();
        $botOffset = new TelegramOffset();

        $updates = $botModel->getBot()->getUpdates($botOffset->getOffset() + 1);
        $updateCount = count($updates);

        if ($updateCount > 0) {
            echo "New messages: {$updateCount}" . PHP_EOL;

            foreach ($updates as $update) {
                $message = $update->getMessage();
                if ($botModel->processCommand(
                    $message->getText(),
                    $message->getFrom()->getId())
                ) {
                    $botOffset->updateOffset($update->getUpdateId());
                }
            }
        } else {
            echo 'No new messages' . PHP_EOL;
        }
    }
}