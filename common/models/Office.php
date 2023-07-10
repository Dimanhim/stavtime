<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_office".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $name
 * @property int|null $number
 * @property int|null $document_id
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Office extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_office';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Делопроизводство';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_OFFICE;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['name'], 'string', 'max' => 255],
            [['number', 'document_id'], 'integer'],
            [['office_date'], 'safe'],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Название',
            'number' => 'Номер',
            'document_id' => 'Документ',
            'office_date' => 'Дата',
        ]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocument()
    {
        return $this->hasOne(Document::className(), ['id' => 'document_id']);
    }

    /**
     *
     */
    public function afterFind()
    {
        if($this->office_date) {
            $this->office_date = date('d.m.Y', $this->office_date);
        }
        return parent::afterFind();
    }

    /**
     * @param bool $insert
     * @return bool
     */
    public function beforeSave($insert)
    {
        if($this->office_date) {
            $this->office_date = strtotime($this->office_date);
        }
        return parent::beforeSave($insert);
    }
}
