<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Report;

/**
 * ReportSearch represents the model behind the search form about `backend\models\Report`.
 */
class ReportSearch extends Report
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id',  'division_id', 'requested_user_id', 'approved_user_id'], 'integer'],
            [['title','project_id', 'content', 'submit_date'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
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
        $query = Report::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->joinWith('project');

        $query->andFilterWhere([
            'id' => $this->id,
            'submit_date' => $this->submit_date,
            //'project_id' => $this->project_id,
            'division_id' => $this->division_id,
            'requested_user_id' => $this->requested_user_id,
            'approved_user_id' => $this->approved_user_id,
        ]);

        $query->andFilterWhere(['like', 'title', $this->title])
            ->andFilterWhere(['like', 'content', $this->content])
            ->andFilterWhere(['like', 'project.name', $this->project_id]);

        return $dataProvider;
    }
}
