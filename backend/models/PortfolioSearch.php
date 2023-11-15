<?php

namespace backend\models;

use Yii;
use yii\base\Model;
use yii\data\ActiveDataProvider;
use common\models\Portfolio;

/**
 * PortfolioSearch represents the model behind the search form of `common\models\Portfolio`.
 */
class PortfolioSearch extends Portfolio
{
    public $admin = false;
    public $type = null;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [
                [
                    'order_id', 'price', 'price_lead', 'is_active', 'deleted', 'position', 'created_at', 'updated_at',
                    'unique_id', 'name', 'link', 'description',
                    'conversion',
                    'portfolio_services', 'portfolio_tags'
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
    public function search($params = [])
    {
        \Yii::$app->infoLog->add('type', $this->type);
        if($this->type == Portfolio::PRIVATE_PARAM or $this->admin) {
            $query = Portfolio::findModels($this->admin);
        }
        else {
            $query = Portfolio::findModels($this->admin)->andWhere(['is_private' => 0]);
        }

        // add conditions that should always apply here

        $dataProvider = new ActiveDataProvider([
            'query' => $query,
            'pagination' => ['pageSize' => 1000],
        ]);

        $this->load($params);

        if (!$this->validate()) {
            // uncomment the following line if you do not want to return any records when validation fails
            // $query->where('0=1');
            return $dataProvider;
        }

        // тут косяк с запросами. Почему-то если выбрать 2 услуги он ищет все результаты по принципу или одна или вторая услуга
        /**
        SELECT `stv_portfolio`.* FROM `stv_portfolio`
        LEFT JOIN `stv_portfolio_services` ON `stv_portfolio`.`id` = `stv_portfolio_services`.`portfolio_id`
        LEFT JOIN `stv_services` ON `stv_portfolio_services`.`service_id` = `stv_services`.`id`
        WHERE (`stv_portfolio`.`deleted` IS NULL)
        AND (`stv_services`.`id` IN ('1', '5'))
        ORDER BY `stv_portfolio`.`position`, `stv_services`.`position`
         */

        if($this->portfolio_services) {
            $query->joinWith(['services']);
            $query->andWhere(['in', Yii::$app->db->tablePrefix.'services.id', $this->portfolio_services]);
        }

        if($this->portfolio_tags) {
            $query->joinWith(['tags']);
            $query->andWhere(['in', Yii::$app->db->tablePrefix.'tags.id', $this->portfolio_tags]);
        }

        // grid filtering conditions
        $query->andFilterWhere([
            'id' => $this->id,
            'order_id' => $this->order_id,
            'price' => $this->price,
            'price_lead' => $this->price_lead,
            'conversion' => $this->conversion,
            'is_active' => $this->is_active,
            'deleted' => $this->deleted,
            'position' => $this->position,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ]);

        /*echo "<pre>";
        print_r($query->createCommand()->getRawSql());
        echo "</pre>";
        exit;*/

        $query->andFilterWhere(['like', 'unique_id', $this->unique_id])
            ->andFilterWhere(['like', 'name', $this->name])
            ->andFilterWhere(['like', 'link', $this->link])
            ->andFilterWhere(['like', 'description', $this->description]);

        return $dataProvider;
    }
}
