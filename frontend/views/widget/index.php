<?php
/**
 * @var \frontend\models\tables\Tasks $model
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();
echo $form->field($model, 'title')->textInput();
echo $form->field($model, 'description')->textInput();
echo $form->field($model, 'creator_id')->textInput();
echo $form->field($model, 'executor_id')->textInput();
echo $form->field($model, 'due_date')->textInput();
echo $form->field($model, 'status_id')->textInput();
echo Html::submitButton('Submit', ['class' => 'btn btn-success']);
ActiveForm::end();