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
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }
}
