<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_brief_orders".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $order_id
 * @property int|null $brief_id
 * @property string|null $value
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class BriefOrder extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_brief_orders';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Бриф';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_BRIEF_CLIENT;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['order_id', 'brief_id'], 'integer'],
            [['value'], 'string'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'order_id' => 'Заявка',
            'brief_id' => 'Вопрос брифа',
            'value' => 'Заполнение',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getOrder()
    {
        return $this->hasOne(Order::className(), ['id' => 'order_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBrief()
    {
        return $this->hasOne(Brief::className(), ['id' => 'brief_id']);
    }
}
