<?php

namespace frontend\modules\profile\controllers;

use common\models\Brief;
use frontend\modules\profile\controllers\ProfileController;
use frontend\modules\profile\models\BriefForm;
use yii\filters\VerbFilter;
use common\models\BriefOrder;

class BriefController extends ProfileController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'className' => BriefOrder::className(),
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        //'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }
    public function actionIndex()
    {
        $briefs = Brief::find()->orderBy(['position' => 'SORT ASC'])->all();
        return $this->render('index', [
            'briefs' => $briefs,
        ]);
    }

    public function actionUpdate()
    {
        $model = new BriefForm();
        $briefs = Brief::find()->orderBy(['position' => 'SORT ASC'])->all();
        if($model->load(\Yii::$app->request->post()) and $model->validate()) {
            if(($values = $model->value) and ($orderId = \Yii::$app->params['order_id'])) {
                foreach($values as $briefId => $briefValue) {
                    if(!$briefOrder = BriefOrder::findOne(['order_id' => $orderId, 'brief_id' => $briefId])) {
                        $briefOrder = new BriefOrder();
                        $briefOrder->order_id = $orderId;
                        $briefOrder->brief_id = $briefId;
                    }
                    $briefOrder->value = $briefValue;
                    $briefOrder->save();
                }
                \Yii::$app->session->setFlash('success', 'Бриф успешно сохранен');
                return $this->redirect('index');
            }
        }
        return $this->render('update', [
            'briefs' => $briefs,
            'model' => $model,
        ]);
    }
}
