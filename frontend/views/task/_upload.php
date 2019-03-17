<?php

/**
 * @var int $id
 * @var \frontend\models\Upload $uploadModel
 * @var \common\models\tables\TaskFiles[] $files
 */

use yii\widgets\ActiveForm;
use yii\helpers\Html;

$uploadForm = ActiveForm::begin([
    'action' => [
        'upload',
        'id' => $id
    ],
]); ?>

<?= $uploadForm->field($uploadModel, 'file')->fileInput(); ?>

<div class="form-group task-buttons">
    <?php $buttonName = Yii::t('app', 'attach');
    echo Html::submitButton($buttonName, ['class' => 'btn btn-success']); ?>
</div>

<?php ActiveForm::end(); ?>

<div class="task-files">
    <?php foreach ($files as $file): ?>
        <a target="_blank" href="<?= $file->path; ?>"><img src="<?= $file->path_small; ?>" alt=""></a>
    <?php endforeach; ?>
</div>