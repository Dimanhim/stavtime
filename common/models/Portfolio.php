<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_portfolio".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $order_id
 * @property string|null $name
 * @property int|null $price
 * @property int|null $price_lead
 * @property float|null $conversion
 * @property string|null $link
 * @property string|null $description
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Portfolio extends \common\models\BaseModel
{
    public $portfolio_services = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_portfolio';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Портфолио';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_PORTFOLIO;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['order_id', 'price', 'price_lead'], 'integer'],
            [['conversion'], 'number'],
            [['description', 'comment'], 'string'],
            [['name', 'link'], 'string', 'max' => 255],
            [['created_date', 'portfolio_services'], 'safe'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'order_id' => 'Заказ',
            'name' => 'Название',
            'price' => 'Цена создания',
            'price_lead' => 'Цена заявки',
            'conversion' => 'Конверсия',
            'link' => 'Ссылка',
            'description' => 'Описание',
            'comment' => 'Информация',
            'created_date' => 'Дата создания работы',
            'portfolio_services' => 'Услуги',
        ]);
    }

    public function afterFind()
    {
        if($this->created_date) {
            $this->created_date = date('d.m.Y', $this->created_date);
        }
        $this->setPortfolioServices();
        return parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if($this->created_date) {
            $this->created_date = strtotime($this->created_date);
        }
        $this->handlePortfolioServices();
        return parent::beforeSave($insert);
    }

    public function setPortfolioServices()
    {
        if($this->services) {
            foreach($this->services as $service) {
                $this->portfolio_services[] = $service->id;
            }
        }
    }

    public function handlePortfolioServices()
    {
        if($this->portfolio_services) {
            PortfolioService::deleteAll(['portfolio_id' => $this->id]);
            foreach ($this->portfolio_services as $serviceId) {
                $portfolio_service = new PortfolioService();
                $portfolio_service->portfolio_id = $this->id;
                $portfolio_service->service_id = $serviceId;
                $portfolio_service->save();
            }
        }
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    public function getServices()
    {
        return $this->hasMany(Service::className(), ['id' => 'service_id'])
            ->viaTable(Yii::$app->db->tablePrefix.'portfolio_services', ['portfolio_id' => 'id'])
            ->orderBy([Yii::$app->db->tablePrefix.'services.position' => SORT_ASC]);
    }
}
