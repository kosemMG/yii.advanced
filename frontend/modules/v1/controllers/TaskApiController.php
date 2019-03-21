<?php

namespace frontend\modules\v1\controllers;


use backend\models\filters\TaskSearch;
use common\models\tables\Tasks;
use common\models\User;
use yii\data\ActiveDataProvider;
use yii\filters\auth\HttpBasicAuth;
use yii\rest\ActiveController;
use Yii;

/**
 * Class TaskApiController
 * @package frontend\modules\v1\controllers
 */
class TaskApiController extends ActiveController
{
    public $modelClass = Tasks::class;

    /**
     * Adds basic authentication.
     * @return array
     */
    public function behaviors()
    {
        $behaviours = parent::behaviors();
        $behaviours['authenticator'] = [
            'class' => HttpBasicAuth::class,
            'auth' => function ($username, $password) {
                $user = User::findByUsername($username);

                if ($user && $user->validatePassword($password)) {
                    return $user;
                }
                return null;
            }
        ];
        return $behaviours;
    }

    /**
     * Unset default index action.
     * @return array
     */
    public function actions()
    {
        $actions = parent::actions();
        unset($actions['index']);
        return $actions;
    }

    /**
     * Searches by executor_id.
     * The request string should be http://front.advanced.yii/v1/task-api?search[executor_id]=(id)
     * @return ActiveDataProvider
     */
    public function actionIndex()
    {
        $search = Yii::$app->request->get('search');
        $query = Tasks::find();
        $filteredQuery = (new TaskSearch())->searchParam($search, $query);

        return new ActiveDataProvider([
            'query' => $filteredQuery
        ]);
    }
}