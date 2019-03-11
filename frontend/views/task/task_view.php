<?php

/**
 * @var \common\models\tables\Tasks $taskModel
 * @var \frontend\models\Upload $uploadModel
 * @var \common\models\tables\TaskComments $taskCommentForm
 * @var integer $userId
 * @var array $statuses
 * @var array $users
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

?>

<?php
$this->title = 'Update Tasks: ' . $taskModel->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $taskModel->title;
$this->params['breadcrumbs'][] = Yii::t('app', 'update');

?>

<div class="task">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($taskModel, 'title')->textInput(['maxlength' => true]) ?>

    <div class="drop-lists">
        <?= $form->field($taskModel, 'creator_id')->dropDownList($users, ['prompt' => 'Select Creator']) ?>
        <?= $form->field($taskModel, 'executor_id')->dropDownList($users, ['prompt' => 'Select Executor']) ?>
        <?= $form->field($taskModel, 'status_id')->dropDownList($statuses, ['prompt' => 'Select Status']) ?>
    </div>

    <?= $form->field($taskModel, 'due_date')->textInput() ?>

    <?= $form->field($taskModel, 'description')->textarea(['maxlength' => true]) ?>

    <div class="form-group task-buttons">
        <?php $buttonName = Yii::t('app', 'update');
        echo Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?>
    </div>

    <?php ActiveForm::end(); ?>

    <hr>

    <?php $uploadForm = ActiveForm::begin([
        'action' => [
            'upload',
            'id' => $taskModel->id
        ],
    ]); ?>

    <?= $uploadForm->field($uploadModel, 'file')->fileInput(); ?>

    <div class="form-group task-buttons">
        <?php $buttonName = Yii::t('app', 'attach');
        echo Html::submitButton($buttonName, ['class' => 'btn btn-success']); ?>
    </div>

    <?php ActiveForm::end(); ?>

    <div class="task-files">
        <?php foreach ($taskModel->files as $file): ?>
            <a target="_blank" href="<?= $file->path; ?>"><img src="<?= $file->path_small; ?>" alt=""></a>
        <?php endforeach; ?>
    </div>

    <hr>

    <div class="add-comments">
        <h3><?= Yii::t('app', 'comments') ?></h3>

        <div class="comments">
            <?php foreach ($taskModel->comments as $comment): ?>
                <p><strong><?= $comment->user->username ?>:</strong></p>
                <p><?= $comment->content ?></p>
            <?php endforeach; ?>
        </div>

        <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]); ?>
        <?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>
        <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $taskModel->id])->label(false); ?>
        <?= $form->field($taskCommentForm, 'content')->textarea(); ?>
        <?= Html::submitButton(Yii::t('app', 'add'), ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>



</div>
