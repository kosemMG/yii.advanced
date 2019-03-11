<?php

use yii\helpers\Url;


/** @var $model \common\models\tables\Tasks */
?>

<div class="task-container">
    <a class="task-preview-link" href="<?= Url::to(['task/one', 'id' => $model->id]) ?>">
        <div class="task-preview">
            <div class="task-preview-header">Title: <?= $model->title ?></div>
            <div class="task-preview-content">Description: <?= $model->description ?></div>
            <div class="task-preview-user">Responsible: <?= $model->executor->username ?></div>
            <div class="task-preview-user">Due date: <?= $model->due_date ?></div>
        </div>
    </a>
</div>