<?php

namespace backend\controllers;

use common\models\Client;
use common\models\Image;
use common\models\Order;
use himiklab\thumbnail\EasyThumbnail;
use himiklab\thumbnail\EasyThumbnailImage;
use Yii;
use common\models\ClinicType;
use yii\filters\VerbFilter;
use yii\web\Controller;
use yii\web\NotFoundHttpException;
use himiklab\sortablegrid\SortableGridAction;

/**
 1. переписываем behavours
 2. удаляем actionDelete
 3. удаляем findModel
*/
class BaseController extends Controller
{
    /**
     * @param $action
     * @return bool
     * @throws \yii\web\BadRequestHttpException
     */
    public function beforeAction($action)
    {

        $this->initSettings();
        $this->initOrder();
        if(($model = $this->getModel()) && ($modelName = $model::modelName())) {
            $this->view->title = $modelName;
        }

        return parent::beforeAction($action);
    }
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'verbs' => [
                    'class' => VerbFilter::className(),
                    'actions' => [
                        //'delete' => ['POST'],
                    ],
                ],
            ]
        );
    }

    /**
     * @return array
     */
    public function actions()
    {
        return [
            'sort' => [
                'class' => SortableGridAction::className(),
                'modelName' => $this->behaviors()['className'],
            ],
        ];
    }

    public function initSettings()
    {
        Yii::$app->params['avatarPath'] = Image::DEFAULT_AVATAR_PATH;
        Yii::$app->params['isAdmin'] = true;
        $profileClass = 'Client';
        $userClass = 'User';
        if($className = Yii::$app->user->identity->className()) {
            $class = end(explode('\\', $className));
            if($class == $profileClass) {
                Yii::$app->params['isAdmin'] = false;
                if($client = Client::findOne(Yii::$app->user->identity->id)) {
                    if($client->mainImage) {
                        Yii::$app->params['avatarPath'] = EasyThumbnailImage:: thumbnailFileUrl(Yii::getAlias('@upload').$client->mainImage->path, 160, 160, EasyThumbnailImage::THUMBNAIL_OUTBOUND);
                    }
                }
            }
        }
    }

    public function initOrder()
    {
        if($order = Order::getSessionOrder()) {
            foreach($order->attributes as $order_attribute_name => $order_attribute_value) {
                Yii::$app->params['order'][$order_attribute_name] = $order_attribute_value;
            }
        }
    }

    /**
     * Deletes an existing ClinicType model.
     * If deletion is successful, the browser will be redirected to the 'index' page.
     * @param int $id ID
     * @return \yii\web\Response
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function actionDelete($id)
    {
        $model = $this->findModel($id);
        $model->deleted = 1;
        if($model->save()) {
            Yii::$app->session->setFlash('success', 'Запись удалена успешно');
        }
        return $this->redirect(Yii::$app->request->referrer);
        //$this->findModel($id)->delete();
        //return $this->redirect(['index']);
    }

    /**
     * Finds the ClinicType model based on its primary key value.
     * If the model is not found, a 404 HTTP exception will be thrown.
     * @param int $id ID
     * @return ClinicType the loaded model
     * @throws NotFoundHttpException if the model cannot be found
     */
    public function findModel($id)
    {
        if(array_key_exists('className', $this->behaviors()) && ($model = $this->getModel())) {
            if(($findModel = $model::findOne(['id' => $id])) !== null) {
                return $findModel;
            }
        }
        throw new NotFoundHttpException('The requested page does not exist.');
    }

    public function getModel()
    {
        $behaviors = $this->behaviors();
        if(array_key_exists('className', $this->behaviors())) {
            return $behaviors['className'];
        }
        return false;
    }


}
