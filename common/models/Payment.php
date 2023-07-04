<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_payments".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $type_id
 * @property int|null $client_id
 * @property int|null $order_id
 * @property int|null $document_id
 * @property string|null $name
 * @property string|null $short_description
 * @property string|null $description
 * @property int|null $price
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Payment extends \common\models\BaseModel
{
    const TYPE_CARD     = 1;
    const TYPE_CASHLESS = 2;
    const TYPE_CASH     = 3;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_payments';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Оплаты';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_PAYMENT;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['type_id', 'client_id', 'order_id', 'document_id', 'price'], 'integer'],
            [['short_description', 'description'], 'string'],
            [['name', 'bank'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'type_id' => 'Тип',
            'client_id' => 'Клиент',
            'order_id' => 'Заказ',
            'document_id' => 'Документ',
            'bank' => 'Банк',
            'name' => 'Название',
            'short_description' => 'Короткое описание',
            'description' => 'Описание',
            'price' => 'Сумма',
        ]);
    }

    public function afterSave($insert, $changedAttributes)
    {
        if($this->document_id) {
            if(!$this->client_id and $this->document and $this->document->client) {
                $this->client_id = $this->document->client->id;
                $this->save();
            }
            if(!$this->order_id and $this->document and $this->document->order) {
                $this->order_id = $this->document->order->id;
                $this->save();
            }
        }
        return parent::afterSave($insert, $changedAttributes);
    }
    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id']);
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
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }

    /**
     * @return array
     */
    public static function getTypes()
    {
        return [
            self::TYPE_CARD       => 'Переводом на карту',
            self::TYPE_CASHLESS   => 'Безнал',
            self::TYPE_CASH       => 'Наличные',
        ];
    }

    /**
     * @return bool|mixed
     */
    public function getTypeName()
    {
        $types = self::getTypes();
        if(array_key_exists($this->type_id, $types)) return $types[$this->type_id];
    }
}
