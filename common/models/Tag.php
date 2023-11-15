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
class Tag extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%tags}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Теги работ';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_TAG;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['description', 'short_description'], 'string'],
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
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
        ]);
    }

    public function filterChecked($requestParams)
    {
        if(!$requestParams) return false;
        $checkedTemplate = ' checked="checked"';
        if(array_key_exists('portfolio_tags', $requestParams) and in_array($this->id, $requestParams['portfolio_tags'])) {
            return $checkedTemplate;
        }
        return false;
    }
}
