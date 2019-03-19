<?php

namespace frontend\controllers;


use SonkoDmitry\Yii\TelegramBot\Component;
use yii\web\Controller;
use Yii;

class TelegramController extends Controller
{
    /**
     * @return string
     * @throws \TelegramBot\Api\Exception
     * @throws \TelegramBot\Api\InvalidArgumentException
     */
    public function actionIndex()
    {
        /**
         * @var Component $bot
         */
        $bot = Yii::$app->bot;
        $bot->setCurlOption(CURLOPT_TIMEOUT, 20);
        $bot->setCurlOption(CURLOPT_CONNECTTIMEOUT, 10);
        $bot->setCurlOption(CURLOPT_HTTPHEADER, ['Expect:']);

        $updates = $bot->getUpdates();
        $messages = [];

        foreach ($updates as $update) {
            $message = $update->getMessage();
            $from = $message->getFrom();
            $username = $from->getFirstName() . ' ' . $from->getLastName();

            $messages = [
                'text' => $message->getText(),
                'username' => $username
            ];
        }

        return $this->render('receive', ['messages' => $messages]);
    }

    /*private function getFullName($from)
    {
        return $from->getFirstName() . ' ' . $from->getLastName();
    }*/
}