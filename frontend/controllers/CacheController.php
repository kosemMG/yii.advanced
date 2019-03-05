<?php

namespace frontend\controllers;


use yii\web\Controller;
use Yii;

class CacheController extends Controller
{
    public function actionIndex()
    {
        $cache = Yii::$app->cache;
        $key = 'number';

        if ($cache->exists($key)) {
            $number = $cache->get($key);
        } else {
            $number = rand();
            $cache->set($key, $number, 10);
        }

        var_dump($number);
    }
}