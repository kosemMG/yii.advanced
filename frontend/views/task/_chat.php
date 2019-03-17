<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

/**
 * @var string $channel
 * @var int $userId
 * @var \common\models\tables\Chat[] $history
 */

?>

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