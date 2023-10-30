<?php

namespace frontend\modules\profile\controllers;

use frontend\models\ResetPasswordForm;
use frontend\modules\profile\controllers\ProfileController;
use frontend\modules\profile\models\ChangeOrderForm;
use frontend\modules\profile\models\ProfileLoginForm;
use frontend\modules\profile\Profile;
use Yii;
use common\models\Client;
use common\models\LoginForm;
use common\models\SessionOrder;
use yii\base\InvalidArgumentException;
use yii\filters\AccessControl;
use yii\filters\VerbFilter;
use yii\web\BadRequestHttpException;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\web\Response;

/**
 * Default controller for the `profile` module
 */
class DefaultController extends ProfileController
{
    /**
     * Renders the index view for the module
     * @return string
     */
    public function actionIndex()
    {
        return $this->render('index');
    }

    public function actionLogin($user_id = null, $action_id = null)
    {
        $model = new ProfileLoginForm();
        if($user_id and ($client = Client::findOne(['user_id' => $user_id]))) {
            $model->username = $client->email;
            $model->password = $client->user_id;
            if($model->login()) {
                return $action_id ? $this->redirect(["/profile/{$action_id}/update"]) : $this->redirect([Profile::ROUTE]);
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

    public function actionChangeOrder()
    {
        $model = new ChangeOrderForm();
        if($model->load(Yii::$app->request->post())) {
            if($model->order_id) {
                SessionOrder::setSessionOrder($model->order_id);
            }
        }
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionEdit()
    {
        $model = Client::findOne(Yii::$app->user->identity->id);
        if(!$model) {
            throw new NotFoundHttpException('Пользователь личного кабинета не найден');
        }
        return $this->render('edit', [
            'model' => $model,
        ]);
    }
}
