<?php

namespace backend\controllers;

use backend\components\MailSender;
use Yii;
use backend\components\Helpers;
use common\models\Order;
use backend\models\OrderSearch;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * ClientController implements the CRUD actions for Client model.
 */
class OrderController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'className' => Order::className(),
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * Lists all Client models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new OrderSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Client model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        $model = $this->findModel($id);
        $model->managerSeen();
        return $this->render('view', [
            'model' => $model,
        ]);
    }

    /**
     * Creates a new Client model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate()
    {
        $model = new Client();

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $this->redirect(['index']);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Client model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['index']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionSendBrief($id)
    {
        $model = $this->findModel($id);
        if($model->createUser()) {
            if(
                Yii::$app->mailSender->toAdmin(MailSender::SUBJECT_ADMIN_PROFILE, $model)
                and
                Yii::$app->mailSender->toUser($model->email, MailSender::SUBJECT_USER_ORDER, $model)
            ) {
                $model->send_brief = 1;
                if($model->save()) {
                    Yii::$app->session->setFlash('success', 'Ссылка на ЛК успешно отправлена');
                    return $this->redirect(['order/view', 'id' => $id]);
                }
            }
        }
        Yii::$app->session->setFlash('error', 'Произошла ошибка отправки брифа');
        return $this->redirect(['order/view', 'id' => $id]);
    }

    public function actionInfo($id)
    {
        $model = $this->findModel($id);
        return $this->render('info', [
            'model' => $model,
        ]);
    }
}
