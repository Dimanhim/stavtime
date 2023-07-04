<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_steps".
 *
 * @property int $id
 * @property string $unique_id
 * @property int|null $order_id
 * @property string|null $name
 * @property string|null $short_description
 * @property string|null $description
 * @property int|null $done
 * @property int|null $deadline
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Step extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_steps';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Этапы работы';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_STEP;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['order_id', 'done'], 'integer'],
            [['short_description', 'description'], 'string'],
            [['name'], 'string', 'max' => 255],
            [['deadline'], 'safe'],
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
            'short_description' => 'Короткое описание',
            'description' => 'Описание',
            'done' => 'Выполнена',
            'deadline' => 'Срок, до',
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
     *
     */
    public function afterFind()
    {
        if($this->deadline) {
            $this->deadline = date('d.m.Y', $this->deadline);
        }
        return parent::afterFind();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if($this->deadline) {
            $this->deadline = strtotime($this->deadline);
        }
        return parent::beforeSave($insert);
    }

    public static function getDones()
    {
        return [
            0 => 'Нет',
            1 => 'Да',
        ];
    }

    public function getDoneName()
    {
        $dones = self::getDones();
        if(array_key_exists($this->done, $dones)) return $dones[$this->done];
        return false;
    }
}
