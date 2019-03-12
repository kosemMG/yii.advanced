<?php

/**
 * @var \common\models\tables\Tasks $taskModel
 * @var \frontend\models\Upload $uploadModel
 * @var \common\models\tables\TaskComments $taskCommentForm
 * @var integer $userId
 * @var array $statuses
 * @var array $users
 * @var \common\models\tables\Chat[] $history
 * @var string $channel
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

    <!--Task section-->
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

    <!--Upload section-->
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

    <!--Comments section-->
    <div class="add-comments">
        <h3><?= Yii::t('app', 'comments') ?></h3>

        <div class="comments">
            <?php foreach ($taskModel->comments as $comment): ?>
                <p><strong><?= $comment->user->username ?>:</strong></p>
                <p><?= $comment->content ?></p>
            <?php endforeach; ?>
        </div>

        <?php $buttonName = Yii::t('app', 'add'); ?>

        <?php $form = ActiveForm::begin(['action' => Url::to(['task/add-comment'])]); ?>
        <?= $form->field($taskCommentForm, 'user_id')->hiddenInput(['value' => $userId])->label(false); ?>
        <?= $form->field($taskCommentForm, 'task_id')->hiddenInput(['value' => $taskModel->id])->label(false); ?>
        <?= $form->field($taskCommentForm, 'content')->textarea(); ?>
        <?= Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?>
        <?php ActiveForm::end(); ?>
    </div>
    <hr>

    <!--Chat section-->
    <div class="chat-section">
        <h3><?= Yii::t('app', 'chat') ?></h3>
        <?php $form = ActiveForm::begin([
            'action' => '#',
            'id' => 'chat_form',
            'options' => ['name' => 'chat_form']
        ]); ?>
        <?= Html::hiddenInput('channel', $channel); ?>
        <?= Html::hiddenInput('author_id', $userId); ?>
        <?= Html::textarea('message', '', [
            'class' => 'message-area',
            'placeholder' => Yii::t('app', 'message')
        ]); ?><br>

        <?php $buttonName = Yii::t('app', 'send'); ?>
        <?= Html::submitButton($buttonName, ['class' => 'btn btn-success']); ?>
        <?php ActiveForm::end(); ?>

        <hr>
        <div id="chat">
            <?php foreach ($history as $chatData): ?>
                <p><strong><?= $chatData->author->username ?>: </strong><?= $chatData->message ?></p>
            <?php endforeach; ?>
        </div>
    </div>

    <script>
        "use strict";

        if (!window.WebSocket) {
            alert("<?= Yii::t('app', 'ws-error') ?>");
        }

        let webSocket = new WebSocket("ws://front.advanced.yii:8080?channel=<?= $channel ?>");

        document.getElementById('chat_form')
            .addEventListener("submit", function (event) {
                let chatData = {
                    message: this.message.value,
                    channel: this.channel.value,
                    author_id: this.author_id.value
                };

                webSocket.send(JSON.stringify(chatData));
                event.preventDefault();
                return false;
            });

        webSocket.onmessage = function (event) {
            let data = event.data,
                messageContainer = document.createElement('div'),
                textNode = document.createTextNode(data);

            messageContainer.appendChild(textNode);
            document.getElementById('chat')
                .appendChild(messageContainer);
        }
    </script>

</div>
