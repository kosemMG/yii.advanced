<?php

/**
 * @var \common\models\tables\Projects $projectModel
 * @var \common\models\tables\Tasks[] $tasks
 * @var $this yii\web\View
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Create Projects';
$this->params['breadcrumbs'][] = ['label' => 'Projects', 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;

$form = ActiveForm::begin(); ?>

<?= $form->field($projectModel, 'title')->textInput(['maxlength' => true]) ?>

<?= $form->field($projectModel, 'due_date')->textInput() ?>

<?= $form->field($projectModel, 'description')->textarea(['maxlength' => true]) ?>

<div class="form-group task-buttons">
    <?php $buttonName = Yii::t('app', 'update');
    echo Html::submitButton($buttonName, ['class' => 'btn btn-success']) ?>
</div>

<?php ActiveForm::end(); ?>

<h3>Project tasks:</h3>

<?php foreach ($tasks as $task) {
    echo '<p>' . Html::a($task->title, ['task/one', 'id' => $task->id]) . '</p>';
}

$buttonName = 'Create a new Task';
echo Html::a($buttonName,
    ['task/create', 'id' => $projectModel->id],
    ['class' => 'btn btn-success']);
?>


