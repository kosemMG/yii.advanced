<?php

/**
 * @var \yii\data\ActiveDataProvider $dataProvider;
 * @var \backend\models\filters\TaskSearch $searchModel;
 */

use yii\widgets\ListView;
use frontend\widgets\TaskPreviewWidget;

$this->title = 'Tasks';

$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Find a Task';

echo $this->render('_search', ['model' => $searchModel]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function ($model) {
        return TaskPreviewWidget::widget(['model' => $model]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
]);