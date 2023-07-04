<?php

namespace common\models;

use backend\components\Helpers;
use Yii;
use yii\helpers\ArrayHelper;

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

    const BRIEF_SENT       = 1;
    const BRIEF_RESENT     = 2;
    const BRIEF_NO_MESSAGE = 'Бриф не отправлен';

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
        return array_merge(parent::rules(), [
            [['status_id', 'service_id', 'price', 'client_id', 'send_brief'], 'integer'],
            [['utm_source', 'utm_campaign', 'utm_medium', 'utm_content', 'utm_term', 'comment'], 'string'],
            [['name', 'order_name', 'phone', 'email', 'split_template', 'pressed_btn'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'Имя',
            'order_name' => 'Название',
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
            'send_brief' => 'Бриф',
        ]);
    }

    public function beforeSave($insert)
    {
        $this->phone = Helpers::setPhoneFormat($this->phone);
        if(!$this->client_id or !Client::find()->where(['phone' => $this->phone])->exists()) {
            $this->createClient();
        }
        return parent::beforeSave($insert);
    }

    /**
     * @param bool $insert
     * @param array $changetAttributes
     */
    public function afterSave($insert, $changetAttributes)
    {
        if($insert) {
            $notificationData = self::notificationData(
                Notification::MODEL_TYPE_ORDER,
                Notification::TYPE_CREATE,
                $this->id
            );
            file_put_contents('info-log.txt', date('d.m.Y H:i:s').' $notificationData - '.print_r($notificationData, true)."\n", FILE_APPEND);
            Notification::add($notificationData);
        }
        return parent::afterSave($insert, $changetAttributes);
    }

    public function createClient()
    {
        $client = new Client();
        $client->name = $this->name;
        $client->phone = $this->phone;
        $client->email = $this->email;
        $client->status_id = Client::STATUS_ONE_TIME;
        $client->created_at = $this->created_at;
        $client->updated_at = $this->updated_at;
        $client->save();
        $this->client_id = $client->id;
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getClient()
    {
        return $this->hasOne(Client::className(), ['id' => 'client_id'])->andWhere(['is_active' => 1])->andWhere(['is', 'deleted', null])->orderBy(['position' => SORT_ASC]);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getService()
    {
        return $this->hasOne(Service::className(), ['id' => 'service_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getDocuments()
    {
        return $this->hasMany(Document::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPayments()
    {
        return $this->hasMany(Payment::className(), ['order_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSteps()
    {
        return $this->hasMany(Step::className(), ['order_id' => 'id']);
    }

    /**
     * @return array
     */
    public static function getStatuses()
    {
        return [
            self::STATUS_ARCHIVE => 'Архив',
            self::STATUS_DONE    => 'Выполнена',
            self::STATUS_WORK    => 'В работе',
            self::STATUS_ADMIN   => 'Администрирование',
        ];
    }

    /**
     * @return array
     */
    public static function getBriefs()
    {
        return [
            self::BRIEF_SENT   => 'Бриф отправлен',
            self::BRIEF_RESENT => 'Бриф отправлен повторно',
        ];
    }

    /**
     * @return mixed|string
     */
    public function getBriefName()
    {
        $briefs = self::getBriefs();
        if($this->send_brief and array_key_exists($this->send_brief, $briefs)) return $briefs[$this->send_brief];
        return self::BRIEF_NO_MESSAGE;
    }

    /**
     * @return bool|mixed
     */
    public function getStatusName()
    {
        $statuses = self::getStatuses();
        if($this->status_id and array_key_exists($this->status_id, $statuses)) return $statuses[$this->status_id];
        return false;
    }

    /**
     * @return array
     */
    public static function getUtmArray($attribute)
    {
        return ArrayHelper::map(Order::find()->groupBy($attribute)->asArray()->all(), $attribute, $attribute);
    }

    public function createUser()
    {
        // Генерируем пароль
        if($client = $this->client) {
            if($client->user_id) return $client->user_id;
            $user_id = Yii::$app->security->generateRandomString(12);
            if(!file_exists(Yii::getAlias('users'))) {
                mkdir(Yii::getAlias('users'));
            }
            $dirName = Yii::getAlias('users').'/'.$user_id;
            if(!file_exists($dirName)) {
                mkdir($dirName, 0777);
            }

            $client->user_id = $user_id;
            if($client->save()) {
                return $client->user_id;
            }
        }
        return false;
    }

    public function setUtmLabels($form)
    {
        if($form->utm and ($utms = explode(',', $form->utm))) {
            foreach($utms as $utm) {
                if($utmValues = explode('=', $utm)) {
                    $utmLabel = null;
                    $utmValue = null;
                    if(isset($utmValues[0])) $utmLabel = $utmValues[0];
                    if(isset($utmValues[1])) $utmValue = $utmValues[1];
                    if($utmLabel and $utmValue and array_key_exists($utmLabel, $this->attributeLabels())) {
                        $this->$utmLabel = $utmValue;
                    }
                }
            }
        }
    }
    public function seenClass()
    {
        $class = 'pale-red';
        if($notification = $this->adminNotifications()) {
            return $class;
        }
        return false;
    }
    public function managerSeen()
    {
        if($notification = $this->adminNotifications()) {
            $notification->manager_seen = 1;
            return $notification->save();
        }
        return false;
    }

    public function adminNotifications()
    {
        return Notification::find()->where(['model_type' => Notification::MODEL_TYPE_ORDER, 'type_id' => Notification::TYPE_CREATE, 'model_id' => $this->id, 'manager_seen' => null])->one();
    }
}
