<?php

namespace common\models;

use Yii;
use frontend\components\PortfolioFilter;

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
    const PRIVATE_PARAM = 'private';

    public $portfolio_services = null;
    public $portfolio_tags = null;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%portfolio}}';
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
            [['is_private', 'is_private', 'order_id', 'price', 'price_lead'], 'integer'],
            [['conversion'], 'number'],
            [['description', 'comment'], 'string'],
            [['name', 'link'], 'string', 'max' => 255],
            [['created_date', 'portfolio_services', 'portfolio_tags'], 'safe'],
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
            'is_private' => 'Приватная',
            'portfolio_services' => 'Услуги',
            'portfolio_tags' => 'Теги',
        ]);
    }

    public function afterFind()
    {
        if($this->created_date) {
            $this->created_date = date('d.m.Y', $this->created_date);
        }
        $this->setPortfolioServices();
        $this->setPortfolioTags();
        return parent::afterFind();
    }

    public function beforeSave($insert)
    {
        if($this->created_date) {
            $this->created_date = strtotime($this->created_date);
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changedAttributes)
    {
        $this->handlePortfolioServices();
        $this->handlePortfolioTags();
        return parent::afterSave($insert, $changedAttributes);
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

    public function setPortfolioTags()
    {
        if($this->tags) {
            foreach($this->tags as $tag) {
                $this->portfolio_tags[] = $tag->id;
            }
        }
    }

    public function handlePortfolioTags()
    {
        if($this->portfolio_tags) {
            PortfolioTag::deleteAll(['portfolio_id' => $this->id]);
            foreach ($this->portfolio_tags as $tagId) {
                $portfolio_tag = new PortfolioTag();
                $portfolio_tag->portfolio_id = $this->id;
                $portfolio_tag->tag_id = $tagId;
                $portfolio_tag->save();
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

    public function getTags()
    {
        return $this->hasMany(Tag::className(), ['id' => 'tag_id'])
            ->viaTable(Yii::$app->db->tablePrefix.'portfolio_tags', ['portfolio_id' => 'id'])
            ->orderBy([Yii::$app->db->tablePrefix.'tags.position' => SORT_ASC]);
    }

    public function getFirstService()
    {
        return $this->services ? $this->services[0] : null;
    }

    public function getFirstServiceName()
    {
        if($this->firstService) {
            return $this->firstService->name;
        }
        return false;
    }

    public static function preparePortfolio($models)
    {
        $data = [];

        if($models) {
            foreach($models as $model) {
                if($model->firstServiceName) {
                    $data[$model->firstServiceName][] = $model;
                }

            }
        }
        return $data;
    }

    /**
     * @return mixed
     */
    public static function findModels($admin = false)
    {
        return $admin
            ?
            self::className()::find()->where(['is', Yii::$app->db->tablePrefix.'portfolio.deleted', null])->orderBy([Yii::$app->db->tablePrefix.'portfolio.position' => 'SORT ASC'])
            :
            self::className()::find()->where(['is', Yii::$app->db->tablePrefix.'portfolio.deleted', null])->andWhere([Yii::$app->db->tablePrefix.'portfolio.is_active' => 1])->orderBy([Yii::$app->db->tablePrefix.'portfolio.position' => 'SORT ASC']);
    }

    public function getFullPath()
    {
        return '/portfolio/'.$this->unique_id;
    }

    /**
     * передаются параметры в виде ['filter_teacher' => [1,3], 'filter_general' => [2]]
     */
    public function filterItems($params = null)
    {
        $filterItems = new PortfolioFilter(['searchModel' => $this, 'params' => $params]);
        return $filterItems;
    }
}
