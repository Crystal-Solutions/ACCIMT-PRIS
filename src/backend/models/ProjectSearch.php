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
            [['id',   'approved_ddg_user_id', 'approved_dh_user_id'], 'integer'],
            [['name','division_id','requested_user_id','parent_project_id', 'code', 'client', 'state', 'description', 'project_type_id', 'starting_date', 'end_date'], 'safe'],
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

        $query->joinWith('division');
        $query->joinWith('requestedUser');


        $query->andFilterWhere([
            'id' => $this->id,
            //'parent_project_id' => $this->parent_project_id,
            //'requested_user_id' => $this->requested_user_id,
            'approved_ddg_user_id' => $this->approved_ddg_user_id,
            'approved_dh_user_id' => $this->approved_dh_user_id,
            //'project_type_id' => $this->project_type_id,
        ]);

// janaka's  code for search by parent project
        if($this->parent_project_id!=null)
        {
                $q = Project::find();
                $q->andFilterWhere(['like', 'name',$this->parent_project_id ]);

                $parents = $q->all();

                foreach ($parents as $value) {
                    $query->orFilterWhere(['like', 'parent_project_id', $value->id]);
                }
        }

        //code for search by project type
        if($this->project_type_id!=null)
        {
            $q =ProjectType::find();
            $q->andFilterWhere(['like', 'name',$this->project_type_id ]);

            $types = $q->all();

            foreach ($types as $value) {
                $query->orFilterWhere(['like', 'project_type_id', $value->id]);
            }
        }



        //code for serch by name
   /*     if($this->name!=null)
        {
                $q = Project::find();
                $q->andFilterWhere(['like', 'name',$this->name ]);

                $names = $q->all();

                foreach ($names as $value) {
                    $query->orFilterWhere(['like', 'name', $value->name]);
                }
        }*/

        $query
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'client', $this->client])
            ->andFilterWhere(['like', 'state', $this->state])
            ->andFilterWhere(['like', 'description', $this->description])
            ->andFilterWhere(['like', 'user.name', $this->requested_user_id])
            ->andFilterWhere(['like', 'division.name', $this->division_id])
            ->andFilterWhere(['like', 'starting_date', $this->starting_date])
            ->andFilterWhere(['like', 'end_date', $this->end_date]);





        return $dataProvider;
    }
}
