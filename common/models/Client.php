<?php

namespace common\models;

use backend\components\Helpers;
use Yii;
use yii\base\NotSupportedException;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "stv_clients".
 *
 * Клиенты
 *
 */
class Client extends \common\models\BaseModel implements IdentityInterface
{
    const STATUS_ONE_TIME = 1;
    const STATUS_REGULAR  = 2;

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'stv_clients';
    }

    /**
     * @return string
     */
    public static function modelName()
    {
        return 'Клиенты';
    }

    /**
     * @return int
     */
    public static function typeId()
    {
        return Gallery::TYPE_CLIENT;
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return array_merge(parent::rules(), [
            [['type', 'status_id'], 'integer'],
            [['name', 'phone', 'email', 'comment', 'user_id'], 'string', 'max' => 255],
        ]);
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return array_merge(parent::attributeLabels(), [
            'name' => 'ФИО',
            'phone' => 'Номер телефона',
            'email' => 'E-mail',
            'comment' => 'Комментарий',
            'type' => 'Тип',                    // Пока непонятно для чего
            'status_id' => 'Статус',
        ]);
    }

    public function beforeSave($insert)
    {
        if($this->phone) {
            $this->phone = Helpers::setPhoneFormat($this->phone);
        }
        return parent::beforeSave($insert);
    }

    public function afterSave($insert, $changetAttributes)
    {
        if($insert) {
            $notificationData = self::notificationData(
                Notification::MODEL_TYPE_CLIENT,
                Notification::TYPE_CREATE,
                $this->id
            );
            Notification::add($notificationData);
        }
        return parent::afterSave($insert, $changetAttributes);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getInfo()
    {
        return $this->hasOne(ClientInfo::className(), ['client_id' => 'id']);
    }

    /**
     * @return ClientInfo|\yii\db\ActiveQuery
     */
    public function getInfoInstance()
    {
        if($info = $this->info) return $info;
        return new ClientInfo();
    }

    /**
     * @return array
     */
    public function getStatuses()
    {
        return [
            self::STATUS_ONE_TIME => 'Однократный',
            self::STATUS_REGULAR  => 'Постоянный',
        ];
    }






    public static function findByUsername($email)
    {
        return static::findOne(['email' => $email]);
    }
    /**
     * Validates password
     *
     * @param string $password password to validate
     * @return bool if password provided is valid for current user
     */
    public function validatePassword($password)
    {
        return $password == $this->user_id;
    }


    /**
     * {@inheritdoc}
     */
    public static function findIdentity($id)
    {
        return static::findOne(['id' => $id]);
    }

    /**
     * {@inheritdoc}
     */
    public static function findIdentityByAccessToken($token, $type = null)
    {
        throw new NotSupportedException('"findIdentityByAccessToken" is not implemented.');
    }

    /**
     * Finds user by login
     *
     * @param string $login
     * @return static|null
     */
    public static function findByLogin($phone)
    {
        return static::findOne(['phone' => $phone]);
    }

    /**
     * {@inheritdoc}
     */
    public function getId()
    {
        return $this->getPrimaryKey();
    }

    /**
     * {@inheritdoc}
     */
    public function getAuthKey()
    {
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function validateAuthKey($authKey)
    {
        return $this->getAuthKey() === $authKey;
    }

    /**
     * Generates password hash from password and sets it to the model
     *
     * @param string $password
     */
    public function setPassword($password)
    {
        $this->password_hash = Yii::$app->security->generatePasswordHash($password);
    }

    /**
     * Generates "remember me" authentication key
     */
    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
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
        return Notification::find()->where(['model_type' => Notification::MODEL_TYPE_CLIENT, 'type_id' => Notification::TYPE_CREATE, 'model_id' => $this->id, 'manager_seen' => null])->one();
    }

    public function createLk()
    {
        if($this->user_id) return $this->user_id;
        $user_id = Yii::$app->security->generateRandomString(12);
        if(!file_exists(Yii::getAlias('users'))) {
            mkdir(Yii::getAlias('users'));
        }
        $dirName = Yii::getAlias('users').'/'.$user_id;
        if(!file_exists($dirName)) {
            mkdir($dirName, 0777);
        }

        $this->user_id = $user_id;
        if($this->save()) {
            return $this->user_id;
        }
        return false;
    }
}
