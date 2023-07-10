<?php

namespace frontend\modules\profile\controllers;

use backend\controllers\BaseController;
use common\models\Client;
use frontend\modules\profile\Profile;

class ProfileController extends BaseController
{
    public $client;

    public function beforeAction($action)
    {
        $this->client = Client::findOne(\Yii::$app->user->id);
        if($action->id != 'login' and !$this->client) return $this->redirect([Profile::ROUTE.'/login']);
        return parent::beforeAction($action);
    }
}
