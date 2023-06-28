<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Organization;

/**
 * OrganizationSearch represents the model behind the search form of `common\models\Organization`.
 */
class OrganizationSearch extends Organization
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'is_active', 'deleted', 'position', 'created_at', 'updated_at','unique_id', 'name', 'organization_name', 'position_name', 'action_basis', 'person_name', 'short_person_name', 'phone', 'email', 'legal_address', 'actual_address', 'inn', 'kpp', 'okpo', 'ogrn', 'rs', 'kors', 'bik', 'bank_name'], 'safe'],
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
        $query = Organization::findModels();

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
            'is_active' => $this->is_active,
            'deleted' => $this->deleted,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'organization_name', $this->organization_name])
            ->andFilterWhere(['like', 'position_name', $this->position_name])
            ->andFilterWhere(['like', 'action_basis', $this->action_basis])
            ->andFilterWhere(['like', 'person_name', $this->person_name])
            ->andFilterWhere(['like', 'short_person_name', $this->short_person_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email])
            ->andFilterWhere(['like', 'legal_address', $this->legal_address])
            ->andFilterWhere(['like', 'actual_address', $this->actual_address])
            ->andFilterWhere(['like', 'inn', $this->inn])
            ->andFilterWhere(['like', 'kpp', $this->kpp])
            ->andFilterWhere(['like', 'okpo', $this->okpo])
            ->andFilterWhere(['like', 'ogrn', $this->ogrn])
            ->andFilterWhere(['like', 'rs', $this->rs])
            ->andFilterWhere(['like', 'kors', $this->kors])
            ->andFilterWhere(['like', 'bik', $this->bik])
            ->andFilterWhere(['like', 'bank_name', $this->bank_name]);

        return $dataProvider;
    }
}
