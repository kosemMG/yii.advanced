<?php

namespace frontend\widgets;


use frontend\models\tables\Tasks;
use yii\base\Widget;

class TaskPreviewWidget extends Widget
{
    public $model;

    private $view = 'task_preview';

    /**
     * Displays the widget.
     * @return string
     * @throws \Exception
     */
    public function run()
    {
        if (is_a($this->model, Tasks::class)) {
            return $this->render($this->view, ['model' => $this->model]);
        }

        throw new \Exception('Wrong object.');
    }

}