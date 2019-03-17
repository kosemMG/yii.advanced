<?php

use yii\widgets\Pjax;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;

/**
 * @var \common\models\tables\Tasks $taskModel
 * @var \common\models\tables\TaskComments $taskCommentForm
 * @var int $userId
 */

?>

    <h3><?= Yii::t('app', 'comments') ?></h3>

<?php Pjax::begin([
    'id' => 'pjax-comments-container',
    'enablePushState' => false
]); ?>

    <div class="comments">
        <?php foreach ($taskModel->comments as $comment): ?>
            <p>
                <strong><?= $comment->user->username ?>: </strong>
                <?= $comment->content ?>
            </p>
        <?php endforeach; ?>
    </div>

<?php $buttonName = Yii::t('app', 'add'); ?>

<?php $form = ActiveForm::begin([
    'action' => Url::to(['task/add-comment', 'id' => $taskModel->id]),
    'options' => ['data-pjax' => true]
]); ?>
<?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>
<?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $taskModel->id])->label(false); ?>
<?= $form->field($taskCommentForm, 'content')->textarea(); ?>
<?= Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?>
<?php ActiveForm::end(); ?>

<?php Pjax::end(); ?>