<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_brief".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $type_id
 * @property string|null $name
 * @property string|null $short_description
 * @property string|null $description
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Brief extends \common\models\BaseModel
{
    const TYPE_CONTACT_INFO          = 1;
    const TYPE_ABOUT                 = 2;
    const TYPE_SITE_INFO             = 3;
    const TYPE_SERVICE_INFO          = 4;
    const TYPE_TECH_INFO             = 5;

    const TAG_ID_INPUT               = 1;
    const TAG_ID_TEXTAREA            = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_brief';
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
        return Gallery::TYPE_BRIEF;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['type_id', 'tag_id'], 'integer'],
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
            'type_id' => 'Тип вопроса',
            'name' => 'Название вопроса',
            'short_description' => 'Короткое описание',
            'description' => 'Описание',
            'tag_id' => 'Тег',
            'tagName' => 'Тег',
        ]);
    }

    public function afterFind()
    {
        if(!$this->tag_id) $this->tag_id = self::TAG_ID_TEXTAREA;
        return parent::afterFind();
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_CONTACT_INFO => 'Контактная информация',
            self::TYPE_ABOUT => 'О компании',
            self::TYPE_SITE_INFO => 'Информация о сайте',
            self::TYPE_SERVICE_INFO => 'Требуется ли',
            self::TYPE_TECH_INFO => 'Техническая информация',
        ];
    }

    /**
     * @return bool|mixed
     */
    public function getTypeName()
    {
        $types = self::getTypes();
        if(array_key_exists($this->type_id, $types)) return $types[$this->type_id];
        return false;
    }

    /**
     * @return array
     */
    public static function getTags()
    {
        return [
            self::TAG_ID_INPUT    => 'input',
            self::TAG_ID_TEXTAREA => 'textarea',
        ];
    }

    /**
     * @return bool|mixed
     */
    public function getTagName()
    {
        $tags = self::getTags();
        if(array_key_exists($this->tag_id, $tags)) return $tags[$this->tag_id];
        return false;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getBriefOrders()
    {
        return $this->hasMany(BriefOrder::className(), ['order_id' => Yii::$app->params['order_id']]);
    }

    /**
     * получает модель ответа пользователя на вопрос брифа
     *
     * @return BriefOrder|null
     */
    public function getBriefOrder($order_id = null)
    {
        $orderId = $order_id ? $order_id : Yii::$app->params['order_id'];
        return BriefOrder::findOne(['brief_id' => $this->id, 'order_id' => Yii::$app->params['order_id']]);
    }

    /**
     * возвращает ответ пользователя на вопрос брифа
     *
     * @return mixed
     */
    public function getUserAnswer($order_id = null)
    {
        if($briefOrder = $this->getBriefOrder($order_id)) {
            return $briefOrder->value;
        }
    }

    /**
     * @return array|\yii\db\ActiveRecord[]
     */
    public static function getBriefsList()
    {
        return self::find()->orderBy(['position' => 'SORT ASC'])->all();
    }
}
