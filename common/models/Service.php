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

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%services}}';
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
            [['price', 'old_price'], 'integer'],
            [['short_description', 'description'], 'string'],
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
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
        ]);
    }
}
