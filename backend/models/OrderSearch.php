<?php

namespace backend\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;
use yii\data\Pagination;

/**
 * ClientSearch represents the model behind the search form of `common\models\Client`.
 */
class OrderSearch extends Order
{
    public $_created_from;
    public $_created_to;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'status_id', 'service_id', 'price', 'client_id',
                    'utm_source', 'utm_campaign', 'utm_medium', 'utm_content', 'utm_term', 'comment',
                    'name', 'order_name', 'phone', 'email', 'split_template', 'pressed_btn',
                    'utm_source','utm_campaign','utm_medium','utm_content','utm_term',
                    '_created_from', '_created_to'
                ], 'safe'],
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
        $query = Order::findSearch()->orderBy(['id' => 'SORT_DESC']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 10,

            ],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }
        if ($this->_created_from and $this->_created_to) {
            $query->andWhere(['between', 'created_at', strtotime($this->_created_from), strtotime($this->_created_to) + (60 * 60 * 24) - 1]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'status_id' => $this->status_id,
            'client_id' => $this->client_id,
            'service_id' => $this->service_id,
            'price' => $this->price,
            'split_template' => $this->split_template,
            'pressed_btn' => $this->pressed_btn,
            'utm_source' => $this->utm_source,
            'utm_campaign' => $this->utm_campaign,
            'utm_medium' => $this->utm_medium,
            'utm_content' => $this->utm_content,
            'utm_term' => $this->utm_term,
            'is_active' => $this->is_active,
        ]);

        $query->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'order_name', $this->order_name])
            ->andFilterWhere(['like', 'phone', $this->phone])
            ->andFilterWhere(['like', 'email', $this->email]);

        return $dataProvider;
    }
}
