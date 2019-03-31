<?php

use yii\helpers\Html;

/**
 * @var $this yii\web\View
 * @var $model common\models\tables\Tasks
 * @var array $statuses
 * @var array $users
*/

$this->title = 'Create Tasks';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['project/index']];
$this->params['breadcrumbs'][] = ['label' => 'Tasks', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="tasks-create">

    <h1><?= Html::encode($this->title) ?></h1>

    <?= $this->render('_form', [
        'model' => $model,
        'users' => $users,
        'statuses' => $statuses
    ]) ?>

</div>
