<?php

namespace backend\models\filters;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\tables\Tasks;

/**
 * TaskSearch represents the model behind the search form of `frontend\models\tables\Tasks`.
 */
class TaskSearch extends Tasks
{
    public $created_at_month;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'creator_id', 'executor_id', 'status_id'], 'integer'],
            [['title', 'description', 'due_date', 'created_at', 'updated_at', 'created_at_month'], 'safe'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function scenarios()
    {
        // bypass scenarios() implementation in the parent class
        return Model::scenarios();
    }

    /**
     * Creates data provider instance with search query applied
     *
     * @param array $params
     *
     * @return ActiveDataProvider
     */
    public function search($params)
    {
        $query = Tasks::find();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'creator_id' => $this->creator_id,
            'executor_id' => $this->executor_id,
            'due_date' => $this->due_date,
            'status_id' => $this->status_id,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(["MONTH(`created_at`)" => $this->created_at_month]);

        return $dataProvider;
    }
}
