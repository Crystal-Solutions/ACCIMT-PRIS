<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use backend\models\DivisionHasUser;

/**
 * DivisionHasUserSearch represents the model behind the search form about `backend\models\DivisionHasUser`.
 */
class DivisionHasUserSearch extends DivisionHasUser
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['division_id', 'user_id'], 'integer'],
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
        $query = DivisionHasUser::find();

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
            'division_id' => $this->division_id,
            'user_id' => $this->user_id,
        ]);

        return $dataProvider;
    }
}
