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
 * @var \yii\web\View $this
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\Pjax;

?>

<?php
$this->title = 'Update Tasks: ' . $taskModel->title;
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'tasks'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $taskModel->title;
$this->params['breadcrumbs'][] = Yii::t('app', 'update');

?>

<div class="task">

    <!--Task section-->
    <?= $this->render('_task', [
        'taskModel' => $taskModel,
        'users' => $users,
        'statuses' => $statuses
    ]); ?>

    <hr>

    <!--Upload section-->
    <?= $this->render('_upload', [
        'id' => $taskModel->id,
        'uploadModel' => $uploadModel,
        'files' => $taskModel->files
    ]); ?>

    <hr>

    <!--Comments section-->
    <div class="add-comments">
        <?= $this->render('_comments', [
            'taskModel' => $taskModel,
            'taskCommentForm' => $taskCommentForm,
            'userId' => $userId
        ]); ?>
    </div>

    <hr>

    <!--Chat section-->
    <div class="chat-section">
        <?= $this->render('_chat', [
            'channel' => $channel,
            'userId' => $userId,
            'history' => $history
        ]); ?>
    </div>

</div>

<script>
    let errorMessage = "<?= Yii::t('app', 'ws-error') ?>",
        channelName = "<?= $channel ?>";
</script>
