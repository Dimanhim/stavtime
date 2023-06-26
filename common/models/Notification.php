<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_notifications".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property int|null $model_type
 * @property int|null $type_id
 * @property int|null $model_id
 * @property int|null $user_seen
 * @property int|null $manager_seen
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Notification extends \common\models\BaseModel
{
    const MODEL_TYPE_ORDER         = 1;
    const MODEL_TYPE_CLIENT        = 2;

    const TYPE_CREATE = 1;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_notifications';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Уведомления';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_NOTIFICATION;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['model_type', 'type_id', 'model_id', 'user_seen', 'manager_seen', 'client_id', 'user_id'], 'integer'],
            [['name'], 'string', 'max' => 255],
            [['message'], 'string'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Name',
            'model_type' => 'Model Type',
            'type_id' => 'Type ID',
            'model_id' => 'Model ID',
            'message' => 'Message',
            'user_seen' => 'User Seen',
            'manager_seen' => 'Manager Seen',
            'client_id' => 'Клиент',
            'user_id' => 'Пользователь',
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function modelData()
    {
        return [
            self::MODEL_TYPE_ORDER => [
                'name' => 'заявка',
                'class' => 'common\models\Order',
            ],
            self::MODEL_TYPE_CLIENT => [
                'name' => 'клиент',
                'class' => 'common\models\Client',
            ],
        ];
    }

    public function typeData()
    {
        return [
            self::TYPE_CREATE => 'создан',
        ];
    }

    public function getNotificationName()
    {
        return '';
    }
    public static function add($data = [])
    {
        if($data) {
            $model = new Notification();
            foreach($data as $attributeName => $attributeValue) {
                if(array_key_exists($attributeName, $model->attributeLabels())) {
                    $model->$attributeName = $attributeValue;
                }
            }
            if($model->validate() and $model->save()) return $model;
        }
        return false;
    }
}
