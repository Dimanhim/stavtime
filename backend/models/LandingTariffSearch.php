<?php

namespace backend\models;

use common\models\LandingTariff;
use yii\base\Model;
use yii\data\ActiveDataProvider;

/**
 * ServiceSearch represents the model behind the search form of `common\models\Service`.
 */
class LandingTariffSearch extends LandingTariff
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['id', 'price', 'old_price', 'term', 'is_active', 'deleted', 'position', 'created_at', 'updated_at'], 'integer'],
            [['unique_id', 'name', 'description'], 'safe'],
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
        $query = LandingTariff::findModels();

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
            'price' => $this->price,
            'old_price' => $this->old_price,
            'term' => $this->term,
            'is_active' => $this->is_active,
            'deleted' => $this->deleted,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        $query->andFilterWhere(['like', 'unique_id', $this->unique_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
