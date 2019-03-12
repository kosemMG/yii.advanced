<?php

namespace frontend\assets;


use yii\web\AssetBundle;

class TaskJsAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $js = [
        'js/task.js'
    ];
}