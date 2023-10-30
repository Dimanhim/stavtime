<?php

namespace backend\controllers;

use common\models\Client;
use common\models\LanOrders;
use common\models\LoginForm;
use common\models\Order;
use common\models\Service;
use common\models\User;
use Yii;
use yii\filters\VerbFilter;
use yii\filters\AccessControl;
use yii\web\Controller;
use yii\web\Response;

/**
 * Site controller
 */
class SiteController extends BaseController
{
    /**
     * {@inheritdoc}
     */
    public function behaviors()
    {
        return [
            'access' => [
                'class' => AccessControl::class,
                'rules' => [
                    [
                        'actions' => ['login', 'error'],
                        'allow' => true,
                    ],
                    [
                        'actions' => ['logout', 'index', 'import-orders', 'set-services'],
                        'allow' => true,
                        'roles' => ['@'],
                    ],
                ],
            ],
            'verbs' => [
                'class' => VerbFilter::class,
                'actions' => [
                    'logout' => ['post'],
                ],
            ],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function actions()
    {
        return [
            'error' => [
                'class' => \yii\web\ErrorAction::class,
            ],
        ];
    }

    /**
     * Displays homepage.
     *
     * @return string
     */
    public function actionIndex()
    {
        Yii::info('success 22');
        return $this->render('index');
    }

    /**
     * Login action.
     *
     * @return string|Response
     */
    public function actionLogin()
    {
        if (!Yii::$app->user->isGuest) {
            return $this->goHome();
        }
        $this->layout = 'blank';
        $model = new LoginForm();
        if ($model->load(Yii::$app->request->post()) && $model->login()) {
            return $this->goHome();
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

        return $this->goHome();
    }

    // импорт заявок из старой таблицы
    public function actionImportOrders()
    {
        return true;
        $lanOrders = LanOrders::find()->all();
        $count = 0;
        foreach($lanOrders as $lanOrder) {
            $model = new Order();
            $model->name = $lanOrder->name;
            $model->order_name = $lanOrder->ordername;
            $model->status_id = $lanOrder->status;
            $model->price = (integer) $lanOrder->price;
            $model->phone = $lanOrder->phone;
            $model->email = $lanOrder->email;
            $model->split_template = $lanOrder->split;
            $model->pressed_btn = $lanOrder->btn;
            $model->utm_source = $lanOrder->utm_source;
            $model->utm_campaign = $lanOrder->utm_campaign;
            $model->utm_medium = $lanOrder->utm_medium;
            $model->utm_content = $lanOrder->utm_content;
            $model->utm_term = $lanOrder->utm_term;
            $model->comment = $lanOrder->comment;
            $model->send_brief = $lanOrder->brief;
            $model->created_at = $lanOrder->date_order;
            $model->updated_at = $lanOrder->date_order;
            if($model->save()) {
                $count++;
            }
            else {
                echo "<pre>";
                print_r($model->errors);
                echo "</pre>";
                exit;
            }
        }
        return 'Добавлено '.$count.' заявок';
    }

    /**
     * Пакет Премиум - 3
     * Премиум - 3
     * Пакет Старт - 4
     * Старт - 4
     * Пакет VIP - 1
     */
    public function actionSetServices()
    {
        // добавить beforeSave в order для привязки уже существующего клиента к заказу
        return true;
        $lanOrders = LanOrders::find()->all();
        $count = 0;
        foreach($lanOrders as $lanOrder) {
            $model = new Order();
            $model->name = $lanOrder->name;
            $model->order_name = $lanOrder->ordername;
            $model->status_id = $lanOrder->status;
            $model->price = (integer) $lanOrder->price;
            $model->phone = $lanOrder->phone;
            $model->email = $lanOrder->email;
            $model->split_template = $lanOrder->split;
            $model->pressed_btn = $lanOrder->btn;
            $model->utm_source = $lanOrder->utm_source;
            $model->utm_campaign = $lanOrder->utm_campaign;
            $model->utm_medium = $lanOrder->utm_medium;
            $model->utm_content = $lanOrder->utm_content;
            $model->utm_term = $lanOrder->utm_term;
            $model->comment = $lanOrder->comment;
            $model->send_brief = $lanOrder->brief;
            $model->created_at = $lanOrder->date_order;
            $model->updated_at = $lanOrder->date_order;
            if($lanOrder->plan == 'Пакет Премиум' or $lanOrder->plan == 'Премиум') {
                $model->service_id = Service::PACKET_PREMIUM;
            }
            elseif($lanOrder->plan == 'Пакет Старт' or $lanOrder->plan == 'Старт') {
                $model->service_id = Service::PACKET_START;
            }
            elseif($lanOrder->plan == 'Пакет VIP' or $lanOrder->plan == 'VIP') {
                $model->service_id = Service::PACKET_VIP;
            }
            if($model->save()) {
                $count++;
            }
            else {
                echo "<pre>";
                print_r($model->errors);
                echo "</pre>";
                exit;
            }
        }
        return 'Добавлено '.$count.' заявок';
    }
}
