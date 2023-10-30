<?php

namespace common\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "stv_documents".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $type_id
 * @property int|null $client_id
 * @property int|null $order_id
 * @property string|null $name
 * @property string|null $short_description
 * @property string|null $description
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Document extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_documents';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Документы';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_DOCUMENT;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['type_id', 'client_id', 'order_id'], 'integer'],
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
            'type_id' => 'Тип',
            'client_id' => 'Клиент',
            'order_id' => 'Заявка',
            'name' => 'Название',
            'short_description' => 'Краткое описание',
            'description' => 'Описание',
        ]);
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
     * @return array
     */
    public function getTypes()
    {
        return [];
    }

    public static function getListOrder($order_id = null)
    {
        $data = [];
        if($order_id) {
            $documents = self::findModels()->andWhere(['not', ['name' => null]])->andWhere(['order_id' => $order_id])->all();
        }
        else {
            $documents = self::findModels()->andWhere(['not', ['name' => null]])->all();
        }
        if($documents) {
            foreach($documents as $document) {
                $data[$document->id] = $document->name.', '.($document->order ? $document->order->order_name : '');
            }
        }
        return $data;
    }
}
