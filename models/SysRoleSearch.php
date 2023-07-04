<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysRole;

/**
 * SysRoleSearch represents the model behind the search form of `app\models\SysRole`.
 */
class SysRoleSearch extends SysRole
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code_role', 'sm_id', 'active', 'default_menu'], 'integer'],
            [['created_by', 'created_date', 'modified_by', 'modified_date'], 'safe'],
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
        $query = SysRole::find();

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
            'code_role' => $this->code_role,
            'sm_id' => $this->sm_id,
            'active' => $this->active,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'default_menu' => $this->default_menu,
        ]);

        $query->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by]);

        return $dataProvider;
    }
}
