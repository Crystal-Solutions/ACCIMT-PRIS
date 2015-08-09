<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\Project;

/**
 * ProjectSearch represents the model behind the search form about `backend\models\Project`.
 */
class ProjectSearch extends Project
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'parent_project_id', 'requested_user_id', 'approved_ddg_user_id', 'approved_dh_user_id', 'project_type_id'], 'integer'],
            [['name', 'code', 'client', 'state', 'description'], 'safe'],
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
        $query = Project::find();

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        $query->andFilterWhere([
            'id' => $this->id,
            'parent_project_id' => $this->parent_project_id,
            'requested_user_id' => $this->requested_user_id,
            'approved_ddg_user_id' => $this->approved_ddg_user_id,
            'approved_dh_user_id' => $this->approved_dh_user_id,
            'project_type_id' => $this->project_type_id,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
