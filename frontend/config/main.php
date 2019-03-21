<?php
$params = array_merge(
    require __DIR__ . '/../../common/config/params.php',
    require __DIR__ . '/../../common/config/params-local.php',
    require __DIR__ . '/params.php',
    require __DIR__ . '/params-local.php'
);

return [
    'id' => 'app-frontend',
    'basePath' => dirname(__DIR__),
    'bootstrap' => ['log', 'language', 'taskMessenger'],
    'controllerNamespace' => 'frontend\controllers',
    'modules' => [
        'v1' => [
            'class' => 'frontend\modules\v1\Module',
        ],
    ],
    'components' => [
        'user' => [
            'identityClass' => 'common\models\User',
            'enableSession' => null
        ],
        'request' => [
            'csrfParam' => '_csrf',
            'parsers' => [
                'application/json' => \yii\web\JsonParser::class
            ]
        ],
        'log' => [
            'traceLevel' => YII_DEBUG ? 3 : 0,
            'targets' => [
                [
                    'class' => 'yii\log\FileTarget',
                    'levels' => ['error', 'warning'],
                ],
            ],
        ],
        'errorHandler' => [
            'errorAction' => 'site/error',
        ],
        'urlManager' => [
            'enablePrettyUrl' => true,
            'showScriptName' => false,
            'rules' => [
                'tasks' => 'task/index',
                'task/<id:\d+>' => 'task/one',
                [
                    'class' => \yii\rest\UrlRule::class,
                    'controller' => ['v1/task-api']
                ]
            ],
        ],
        'taskMessenger' => [
            'class' => \frontend\models\components\TaskMessengerComponent::class
        ],
        'language' => [
            'class' => \frontend\models\components\LanguageComponent::class
        ],
        'i18n' => [
            'translations' => [
                'app' => [
                    'class' => \yii\i18n\PhpMessageSource::class,
                    'basePath' => '@app/messages'
                ]
            ]
        ],
    ],
    'params' => $params,
];
