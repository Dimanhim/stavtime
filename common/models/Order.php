<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_orders".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property int|null $status_id
 * @property int|null $service_id
 * @property int|null $price
 * @property string|null $phone
 * @property string|null $email
 * @property string|null $split_template
 * @property string|null $pressed_btn
 * @property string|null $utm_source
 * @property string|null $utm_campaign
 * @property string|null $utm_medium
 * @property string|null $utm_content
 * @property string|null $utm_term
 * @property string|null $comment
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Order extends \common\models\BaseModel
{
    const STATUS_ARCHIVE     = 1;
    const STATUS_DONE        = 2;
    const STATUS_WORK        = 3;
    const STATUS_ADMIN       = 5;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_orders';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Заявки';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_ORDER;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return parent::rules() + [
            [['status_id', 'service_id', 'price', 'client_id'], 'integer'],
            [['utm_source', 'utm_campaign', 'utm_medium', 'utm_content', 'utm_term', 'comment'], 'string'],
            [['name', 'phone', 'email', 'split_template', 'pressed_btn'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return parent::attributeLabels() + [
            'name' => 'Имя',
            'status_id' => 'Статус',
            'client_id' => 'Клиент',
            'service_id' => 'Услуга',
            'price' => 'Цена',
            'phone' => 'Телефон',
            'email' => 'E-mail',
            'split_template' => 'Сплит шаблон',
            'pressed_btn' => 'Нажатая кнопка',
            'utm_source' => 'Utm Source',
            'utm_campaign' => 'Utm Campaign',
            'utm_medium' => 'Utm Medium',
            'utm_content' => 'Utm Content',
            'utm_term' => 'Utm Term',
            'comment' => 'Комментарий',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id'])->andWhere(['is_active' => 1])->andWhere(['is', 'deleted', null])->orderBy(['position' => SORT_ASC]);
    }
}
