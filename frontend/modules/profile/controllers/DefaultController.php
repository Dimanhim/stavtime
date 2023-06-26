<?php

namespace frontend\modules\profile\controllers;

use frontend\modules\profile\models\ProfileLoginForm;
use frontend\modules\profile\Profile;
use Yii;
use common\models\Client;
use common\models\LoginForm;
use common\models\Order;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\Response;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends Controller
{
    public $client;

    public function beforeAction($action)
    {
        $this->client = Client::findOne(\Yii::$app->user->id);
        if($action->id != 'login' and !$this->client) return $this->redirect([Profile::ROUTE.'/login']);
        return parent::beforeAction($action);
    }
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin($user_id = null)
    {
        $model = new ProfileLoginForm();
        if($user_id and ($client = Client::findOne(['user_id' => $user_id]))) {
            $model->username = $client->email;
            $model->password = $client->user_id;
            if($model->login()) {
                return $this->redirect([Profile::ROUTE]);
            }

        }
        if (!Yii::$app->user->isGuest) {
            return $this->redirect([Profile::ROUTE.'/index']);
        }
        $this->layout = 'blank';
        // сделать ProfileLoginForm

        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->redirect([Profile::ROUTE]);
        }
        $model->password = '';
        return $this->render('login', [
            'model' => $model,
        ]);
    }

    /**
     * Logout action.
     *
     * @return Response
     */
    public function actionLogout()
    {
        Yii::$app->user->logout();

        return $this->redirect([Profile::ROUTE.'/login']);
    }
}
