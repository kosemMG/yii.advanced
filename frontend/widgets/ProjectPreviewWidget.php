<?php

namespace frontend\widgets;


use common\models\tables\Projects;
use yii\base\Widget;

class ProjectPreviewWidget extends Widget
{
    public $model;

    private $view = 'project_preview';

    /**
     * Displays the widget.
     * @return string
     * @throws \Exception
     */
    public function run()
    {
        if (is_a($this->model, Projects::class)) {
            return $this->render($this->view, [
                'model' => $this->model,
                'tasks' => $this->getTasks($this->model)
            ]);
        }

        throw new \Exception('Wrong object.');
    }

    /**
     * @param Projects $model
     * @return string
     */
    private function getTasks(Projects $model) {
        $tasks = [];
        foreach ($model->tasks as $task) {
            $tasks[] = $task->title;
        }

        return implode(', ', $tasks);
    }
}