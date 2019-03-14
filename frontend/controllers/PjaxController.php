<?php

namespace frontend\controllers;


use yii\web\Controller;

/**
 * Class PjaxController
 * @package frontend\controllers
 */
class PjaxController extends Controller
{
    /**
     * @return string
     */
    public function actionTime()
    {
        $time = date('H:i:s');

        return $this->render('time', ['time' => $time]);
    }

    /**
     * @return string
     */
    public function actionHour()
    {
        $time = date('H');

        return $this->render('date', ['time' => $time]);
    }

    /**
     * @return string
     */
    public function actionMinutes()
    {
        $time = date('H:i');

        return $this->render('date', ['time' => $time]);
    }

    /**
     * @return string
     */
    public function actionMultiple()
    {
        $time = date('H:i:s');
        $hash = md5($time);

        return $this->render('multiple', ['time' => $time, 'hash' => $hash]);
    }
}