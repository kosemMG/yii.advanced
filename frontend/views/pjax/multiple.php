<?php
/**
 * @var string $time
 * @var string $hash
 * @var \yii\web\View $this
 */

use yii\helpers\Html;
use yii\widgets\Pjax;

?>

    <h1>Time block</h1>

<?php
Pjax::begin();
echo Html::a('Update time', ['pjax/multiple'], ['id' => 'btn-refresh-time', 'class' => 'btn btn-success']);
?>

    <h3>Current time: <?= $time ?></h3>

<?php Pjax::end(); ?>

    <hr>
    <h1>Hash block</h1>

<?php
Pjax::begin();
echo Html::a('Update hash', ['pjax/multiple'], ['id' => 'btn-refresh-hash', 'class' => 'btn btn-warning']);
?>

    <h3>Current hash: <?= $hash ?></h3>

<?php Pjax::end(); ?>