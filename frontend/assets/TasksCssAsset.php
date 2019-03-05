<?php

namespace frontend\assets;


use yii\web\AssetBundle;

/**
 * Class TasksCssAsset - tasks css asset bundle
 * @package app\assets
 */
class TasksCssAsset extends AssetBundle
{
    public $basePath = '@webroot';
    public $baseUrl = '@web';

    public $css = [
        'css/task.css',
    ];
}