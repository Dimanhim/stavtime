<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_portfolio_services".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $portfolio_id
 * @property int|null $service_id
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class PortfolioService extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%portfolio_services}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Услуги';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_ANY;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['service_id', 'portfolio_id'], 'integer'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'portfolio_id' => 'Portfolio ID',
            'service_id' => 'Service ID',
        ]);
    }

    public function getPortfolio()
    {
        return $this->hasOne(Portfolio::className(), ['id' => 'portfolio_id']);
    }

    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }
}
