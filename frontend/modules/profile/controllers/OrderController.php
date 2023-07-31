<?php

namespace frontend\modules\profile\controllers;

use frontend\modules\profile\models\OrderSearch;
use Yii;
use backend\components\Helpers;
use common\models\Order;
use yii\debug\models\timeline\DataProvider;
use yii\web\NotFoundHttpException;
use yii\filters\VerbFilter;
use backend\controllers\BaseController;

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
        $dataProvider = $searchModel->search();

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
        //$model->managerSeen();
        return $this->render('view', [
            'model' => $model,
        ]);
    }
}
