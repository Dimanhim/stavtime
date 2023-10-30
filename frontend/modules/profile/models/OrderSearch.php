<?php

namespace frontend\modules\profile\models;

use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Order;
use yii\data\Pagination;

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
    public function search()
    {
        $query = Order::findSearch()->where(['client_id' => \Yii::$app->user->identity->id])->orderBy(['id' => 'SORT_DESC']);

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'sort' => ['defaultOrder' => ['id' => SORT_DESC]],
            'pagination' => [
                'pageSize' => 10,

            ],
        ]);

        if (!$this->validate()) {
            return $dataProvider;
        }

        return $dataProvider;
    }
}
