<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;

/**
 * ClientSearch represents the model behind the search form of `common\models\Client`.
 */
class OrderSearch extends Order
{
    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status_id', 'service_id', 'price', 'client_id'], 'integer'],
            [['utm_source', 'utm_campaign', 'utm_medium', 'utm_content', 'utm_term', 'comment'], 'string'],
            [['name', 'phone', 'email', 'split_template', 'pressed_btn'], 'string', 'max' => 255],
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
        $query = Order::findSearch();

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
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
            'status_id' => $this->status_id,
            'client_id' => $this->client_id,
            'service_id' => $this->service_id,
            'price' => $this->price,
            'phone' => $this->phone,
            'email' => $this->email,
            'split_template' => $this->split_template,
            'pressed_btn' => $this->pressed_btn,
            'utm_source' => $this->utm_source,
            'utm_campaign' => $this->utm_campaign,
            'utm_medium' => $this->utm_medium,
            'utm_content' => $this->utm_content,
            'utm_term' => $this->utm_term,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name]);

        return $dataProvider;
    }
}
