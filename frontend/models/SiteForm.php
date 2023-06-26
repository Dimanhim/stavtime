<?php

namespace frontend\models;

use Yii;
use backend\components\Helpers;
use backend\components\MailSender;
use common\models\Client;
use common\models\Order;
use yii\base\Model;

class SiteForm extends Model
{
    public $name;
    public $phone;
    public $email;
    public $pressed_btn;
    public $service_id;
    public $order;
    public $utm;

    public function rules()
    {
        return [
            ['name', 'required', 'message' => 'Поле "Имя" должно быть заполнено'],
            ['name', 'string', 'min' => 2, 'tooShort' => 'Слишком короткое поле "Имя"'],
            ['name', 'string', 'max' => 255, 'tooLong' => 'Слишком длинное поле "Имя"'],
            ['phone', 'required', 'message' => 'Поле "Телефон" должно быть заполнено'],
            ['email', 'required', 'message' => 'Поле "E-mail" должно быть заполнено'],
            ['email', 'email', 'message' => 'Введите корректный E-mail адрес'],
            ['email', 'uniqueEmail', 'message' => 'Такой E-mail уже зарегистрирован в системе'],
            [['service_id'], 'integer'],
            [['phone', 'email', 'pressed_btn'], 'string', 'message' => 'Недопустимое значение поля'],
            ['utm', 'safe'],
        ];
    }

    public function saveData()
    {
        $model = new Order();
        $model->attributes = $this->attributes;
        $model->setUtmLabels($this);
        file_put_contents('info-log.txt', date('d.m.Y H:i:s').' model - '.print_r($model, true)."\n", FILE_APPEND);
        if($model->save()) {
            $this->order = $model;
            return true;
        }
        return false;
    }

    public function uniqueEmail($attribute, $params)
    {
        if (!$this->hasErrors()) {
            if (Client::find()->where(['email' => $this->$attribute])->exists()) {
                $this->addError($attribute, 'Такой E-mail уже зарегистрирован в системе');
            }
        }
    }



    public function firstError()
    {
        if($this->errors) {
            return $this->errors[array_key_first($this->errors)];
            return false;
        }
    }

    public function sendAdminEmail()
    {
        return $this->order ? Yii::$app->mailSender->toAdmin(MailSender::SUBJECT_ADMIN_ORDER, $this->order) : false;
    }

    public function getUtms()
    {
        $str = '';
        if($params = \Yii::$app->request->get()) {
            foreach($params as $utmLabel => $utmValue) {
                $str .= $utmLabel.'='.$utmValue.',';
            }
            $str = substr($str, 0, -1);
        }
        return $str;
    }

}
