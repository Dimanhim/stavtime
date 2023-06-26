<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_services".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property int|null $price
 * @property int|null $old_price
 * @property int|null $term
 * @property string|null $description
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Service extends \common\models\BaseModel
{
    const PACKET_VIP      = 1;
    const PACKET_BUSINESS = 2;
    const PACKET_PREMIUM  = 3;
    const PACKET_START    = 4;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_services';
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
        return Gallery::TYPE_SERVICE;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['price', 'old_price', 'term'], 'integer'],
            [['description'], 'string'],
            [['name'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Название',
            'price' => 'Цена',
            'old_price' => 'Старая цена',
            'term' => 'Средний срок',
            'description' => 'Описание',
        ]);
    }
}
