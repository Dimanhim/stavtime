<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "stv_visitors".
 *
 * @property int $id
 * @property string $unique_id
 * @property string|null $user_agent
 * @property string|null $remote_addr
 * @property string|null $http_referer
 * @property string|null $utm_source
 * @property string|null $utm_medium
 * @property string|null $utm_campaign
 * @property string|null $utm_content
 * @property string|null $utm_term
 * @property int|null $is_active
 * @property int|null $deleted
 * @property int|null $position
 * @property int|null $created_at
 * @property int|null $updated_at
 */
class Visitor extends \common\models\BaseModel
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%visitors}}';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Посетители';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_ANY;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['http_referer', 'get_params'], 'string'],
            [['user_agent', 'remote_addr'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'user_agent' => 'Браузер',
            'remote_addr' => 'IP',
            'http_referer' => 'Referer',
            'get_params' => 'GET параметры',
        ]);
    }

    public function afterFind()
    {
        if($this->get_params) {
            $this->get_params = json_decode($this->get_params, true);
        }
        return parent::afterFind();
    }

    public static function create()
    {
        $model = new self();
        if(isset($_SERVER['HTTP_USER_AGENT'])) $model->user_agent = $_SERVER['HTTP_USER_AGENT'];
        if(isset($_SERVER['REMOTE_ADDR'])) $model->remote_addr = $_SERVER['REMOTE_ADDR'];
        if(isset($_SERVER['HTTP_REFERER'])) $model->http_referer = $_SERVER['HTTP_REFERER'];
        $model->get_params = json_encode($_GET);
        $model->save();
    }
}
