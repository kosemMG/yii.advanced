<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model frontend\models\tables\TaskStatuses */

$this->title = 'Create Task Statuses';
$this->params['breadcrumbs'][] = ['label' => 'Task Statuses', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="task-statuses-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
