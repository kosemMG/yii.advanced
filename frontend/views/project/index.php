<?php

/**
 * @var \yii\data\ActiveDataProvider $dataProvider;
 * @var \backend\models\filters\ProjectSearch $searchModel;
 */

use yii\widgets\ListView;
use frontend\widgets\ProjectPreviewWidget;
use yii\helpers\Html;

$this->title = 'Projects';

$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = 'Find a Project';

echo $this->render('_search', ['model' => $searchModel]);

echo ListView::widget([
    'dataProvider' => $dataProvider,
    'itemView' => function ($model) {
        return ProjectPreviewWidget::widget(['model' => $model]);
    },
    'summary' => false,
    'options' => [
        'class' => 'preview-container'
    ]
]);

$buttonName = 'Create a new Project';
echo Html::a($buttonName,
    ['project/create'],
    ['class' => 'btn btn-success']);