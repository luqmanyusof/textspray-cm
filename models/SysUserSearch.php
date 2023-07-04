<?php

namespace app\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use app\models\SysUser;

/**
 * SysUserSearch represents the model behind the search form of `app\models\SysUser`.
 */
class SysUserSearch extends SysUser
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'code_role', 'su_active', 'su_locked', 'su_login_attempt'], 'integer'],
            [['username', 'password', 'su_name', 'su_email', 'su_login_date', 'su_last_login', 'created_by', 'created_date', 'modified_by', 'modified_date', 'su_phone_no'], 'safe'],
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
        $query = SysUser::find();

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
            'su_active' => $this->su_active,
            'su_locked' => $this->su_locked,
            'su_login_attempt' => $this->su_login_attempt,
            'su_login_date' => $this->su_login_date,
            'su_last_login' => $this->su_last_login,
            'created_date' => $this->created_date,
            'modified_date' => $this->modified_date,
        ]);

        $query->andFilterWhere(['like', 'username', $this->username])
            ->andFilterWhere(['like', 'password', $this->password])
            ->andFilterWhere(['like', 'su_name', $this->su_name])
            ->andFilterWhere(['like', 'su_email', $this->su_email])
            ->andFilterWhere(['like', 'created_by', $this->created_by])
            ->andFilterWhere(['like', 'modified_by', $this->modified_by])
            ->andFilterWhere(['like', 'su_phone_no', $this->su_phone_no]);

        return $dataProvider;
    }
}
