<?php

namespace backend\components;

use Yii;
use yii\base\Component;

class MailSender extends Component
{
    const SUBJECT_ADMIN_ORDER          = 1;
    const SUBJECT_ADMIN_PROFILE        = 2;
    const SUBJECT_USER_ORDER           = 3;

    private $_subjects = [
        1 => [
            'title' => 'Новая заявка с сайта',
            'view' => 'admin_order',
        ],
        2 => [
            'title' => 'Отправлен бриф пользователю',
            'view' => 'user_brief',
        ],
        3 => [
            'title' => 'Заявка на разработку лендинга',
            'view' => 'user_brief',
        ],
    ];

    public function toAdmin($subject_id, $model = null)
    {
        $subject = array_key_exists($subject_id, $this->_subjects) ? $this->_subjects[$subject_id] : '';
        return Yii::$app->mailer->compose($subject['view'], ['model' => $model])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo(Yii::$app->params['adminEmail'])
            ->setSubject($subject['title'].' '.\Yii::$app->name)
            ->setTextBody(' ')
            ->send();
    }

    public function toUser($email, $subject_id, $model = null)
    {
        $subject = array_key_exists($subject_id, $this->_subjects) ? $this->_subjects[$subject_id] : '';
        return Yii::$app->mailer->compose($subject['view'], ['model' => $model])
            ->setFrom([Yii::$app->params['senderEmail'] => Yii::$app->params['senderName']])
            ->setTo($email)
            ->setSubject($subject['title'].' '.\Yii::$app->name)
            ->setTextBody(' ')
            ->send();
    }
}
