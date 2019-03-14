<?php
/**
 * @var string $time
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\widgets\Pjax;

Pjax::begin(/*['enablePushState' => false]*/);

echo Html::a('Hour', ['pjax/hour'], ['class' => 'btn btn-success', 'style' => 'margin-right: 15px']);
echo Html::a('Minutes', ['pjax/minutes'], ['class' => 'btn btn-warning']);

?>

<h2>Current time: <?= $time ?></h2>

<?php Pjax::end(); ?>