<?php

namespace backend\controllers;

use backend\models\GeneratorForm;
use common\models\Document;
use backend\models\DocumentSearch;
use common\models\Order;
use kartik\mpdf\Pdf;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;

/**
 * DocumentController implements the CRUD actions for Document model.
 */
class DocumentController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'className' => Document::className(),
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
     * Lists all Document models.
     *
     * @return string
     */
    public function actionIndex()
    {
        $searchModel = new DocumentSearch();
        $dataProvider = $searchModel->search($this->request->queryParams);

        return $this->render('index', [
            'searchModel' => $searchModel,
            'dataProvider' => $dataProvider,
        ]);
    }

    /**
     * Displays a single Document model.
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
     * Creates a new Document model.
     * If creation is successful, the browser will be redirected to the 'view' page.
     * @return string|\yii\web\Response
     */
    public function actionCreate($order_id = null)
    {
        $model = new Document();
        if($order_id) {
            if($order = Order::findOne($order_id)) {
                $model->order_id = $order->id;
                if($order->client) {
                    $model->client_id = $order->client->id;
                }
            }
        }
        if ($this->request->isPost) {
            if ($model->load($this->request->post()) && $model->save()) {
                return $model->order ? $this->redirect(['/order/view', 'id' => $model->order->id]) : $this->redirect(\Yii::$app->request->referrer);
            }
        } else {
            $model->loadDefaultValues();
        }

        return $this->render('create', [
            'model' => $model,
        ]);
    }

    /**
     * Updates an existing Document model.
     * If update is successful, the browser will be redirected to the 'view' page.
     * @param int $id ID
     * @return string|\yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionUpdate($id)
    {
        $model = $this->findModel($id);

        if ($this->request->isPost && $model->load($this->request->post()) && $model->save()) {
            return $this->redirect(['view', 'id' => $model->id]);
        }

        return $this->render('update', [
            'model' => $model,
        ]);
    }

    public function actionGenerate($order_id = null)
    {
        $model = new GeneratorForm();
        if($order_id) {
            $model ->order_id = $order_id;
        }
        if($model->load(\Yii::$app->request->post())) {
            if($order = Order::findOne($model->order_id)) {
                if($content = $model->getContent()) {
                    /*echo "<pre>";
                    print_r($content);
                    echo "</pre>";
                    exit;*/





                    $cssInline = $model->cssInline();
                    $pdf = \Yii::$app->pdf;
                    $pdf->content = $content;
                    $pdf->cssInline = $cssInline;
                    $pdf->destination = Pdf::DEST_DOWNLOAD;
                    return $pdf->render();
                }

            }
        }

        return $this->render('generate_form', [
            'model' => $model,
        ]);
    }
}
