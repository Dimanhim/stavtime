<?php

namespace backend\controllers;

use common\models\Step;
use backend\models\StepSearch;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * StepController implements the CRUD actions for Step model.
 */
class StepController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'className' => Step::className(),
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
     * Lists all Step models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new StepSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Step model.
     * @param int $id ID
     * @return string
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionView($id)
    {
        return $this->render('view', [
            'model' => $this->findModel($id),
        ]);
    }

    /**
     * Creates a new Step model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($order_id = null)
    {
        $model = new Step();
        $referrer = null;

        if($order_id) {
            $model->order_id = $order_id;
            $referrer = ['order/view', 'id' => $order_id, '#' => 'step-tab'];
        }

        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $referrer ? $this->redirect($referrer) : $this->redirect(['view', 'id' => $model->id]);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Step model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['order/view', 'id' => $model->order->id, '#' => 'step-tab']);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionDone($id)
    {
        $model = $this->findModel($id);
        $model->done = 1;
        $model->save();
        return $this->redirect(['order/view', 'id' => $model->order->id, '#' => 'step-tab']);
    }
}
