<?php
/**
 * @var string $time
 * @var \yii\web\View $this
 */

$script = <<<JS
setInterval(function() {
  $('#btn-refresh').click();
}, 1000)
JS;

$this->registerJs($script);

use yii\helpers\Html;
use yii\widgets\Pjax;

Pjax::begin();

echo Html::a('Update', ['pjax/time'], ['id' => 'btn-refresh', 'class' => 'btn btn-success']);

?>

<h2>Current time: <?= $time ?></h2>

<?php Pjax::end(); ?>