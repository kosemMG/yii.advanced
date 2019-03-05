<?php

namespace frontend\models\components;

use Yii;
use yii\base\Component;

class LanguageComponent extends Component
{
    public function init()
    {
        if ($lang = Yii::$app->session->get('lang')) {
            Yii::$app->language = $lang;
        }
    }
}