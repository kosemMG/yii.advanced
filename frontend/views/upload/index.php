<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$form = ActiveForm::begin();

echo $form->field($model, 'title')->textInput();
echo $form->field($model, 'content')->textInput();
echo $form->field($model, 'file')->fileInput();

echo Html::submitButton('Send', ['class' => 'btn btn-primary']);

ActiveForm::end();