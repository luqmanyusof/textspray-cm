<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysMenu;

/**
 * SysMenuSearch represents the model behind the search form of `app\models\SysMenu`.
 */
class SysMenuSearch extends SysMenu
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'sm_parent_id', 'active', 'sort'], 'integer'],
            [['sm_menu', 'sm_url', 'created_by', 'created_date', 'modified_by', 'modified_date', 'sm_icon'], 'safe'],
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
        $query = SysMenu::find();

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
            'sm_parent_id' => $this->sm_parent_id,
            'active' => $this->active,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
            'sort' => $this->sort,
        ]);

        $query->andFilterWhere(['like', 'sm_menu', $this->sm_menu])
            ->andFilterWhere(['like', 'sm_url', $this->sm_url])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'sm_icon', $this->sm_icon]);

        return $dataProvider;
    }
}
