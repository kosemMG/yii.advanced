<?php

namespace frontend\controllers;


use backend\models\filters\ProjectSearch;
use common\models\tables\Tasks;
use Yii;
use yii\web\Controller;
use common\models\tables\Projects;
use yii\web\NotFoundHttpException;

class ProjectController extends Controller
{
    /**
     * Displays task previews.
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new ProjectSearch();
        $dataProvider = $searchModel->search(Yii::$app->request->queryParams);

//        $dataProvider = new ActiveDataProvider([
//            'query' => Tasks::find()
//        ]);

        return $this->render('index', [
            'dataProvider' => $dataProvider,
            'searchModel' => $searchModel
        ]);
    }

    /**
     * Displays a single Tasks model.
     * @param int $id
     * @return mixed
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionOne(int $id)
    {
        $model = $this->findModel($id);

        if ($model->load(Yii::$app->request->post()) && $model->save()) {
            Yii::$app->session->setFlash('success', Yii::t('app', 'project-update-success'));
            return $this->redirect(['one', 'id' => $model->id]);
        } else {
//            Yii::$app->session->setFlash('error', Yii::t('app', 'task-update-error'));
        }

        return $this->render('project_view', [
            'projectModel' => $model,
            'tasks' => $this->getTasks($model)
        ]);
    }

    /**
     * Creates a new Projects model.
     * @return mixed
     */
    public function actionCreate()
    {
        $model = new Projects();
        $params = Yii::$app->request->post();

        if ($model->load($params) && $model->save()) {
            return $this->redirect(['index', 'id' => $model->id]);
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Finds the Tasks model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id
     * @return Projects|null
     * @throws NotFoundHttpException
     */
    protected function findModel(int $id)
    {
        if (($model = Projects::findOne($id)) !== null) {
            return $model;
        }

        throw new NotFoundHttpException('The requested page does not exist.');
    }

    /**
     * @param Projects $model
     * @return Tasks array
     */
    private function getTasks(Projects $model) {
        /**
         * @var Tasks $tasks
         */
        $tasks = [];
        foreach ($model->tasks as $task) {
            $tasks[] = $task;
        }

        return $tasks;
    }
}