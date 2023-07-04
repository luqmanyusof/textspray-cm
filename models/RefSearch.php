<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\Ref;

/**
 * RefSearch represents the model behind the search form of `app\models\Ref`.
 */
class RefSearch extends Ref
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'parentid', 'sort', 'active', 'code_state', 'old_id'], 'integer'],
            [['code_name', 'code', 'sr_name', 'created_by', 'created_date', 'modified_by', 'modified_date', 'addr1', 'addr2', 'addr3', 'addr_postcode'], 'safe'],
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
        $query = Ref::find();

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
            'parentid' => $this->parentid,
            'sort' => $this->sort,
            'active' => $this->active,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'code_state' => $this->code_state,
            'old_id' => $this->old_id,
        ]);

        $query->andFilterWhere(['like', 'code_name', $this->code_name])
            ->andFilterWhere(['like', 'code', $this->code])
            ->andFilterWhere(['like', 'sr_name', $this->sr_name])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'addr1', $this->addr1])
            ->andFilterWhere(['like', 'addr2', $this->addr2])
            ->andFilterWhere(['like', 'addr3', $this->addr3])
            ->andFilterWhere(['like', 'addr_postcode', $this->addr_postcode]);

        return $dataProvider;
    }
}
