<?php

/**
 * @var \common\models\tables\Tasks $taskModel
 * @var array $statuses
 * @var array $users
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin(); ?>

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
