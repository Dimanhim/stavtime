<?php

namespace backend\controllers;

use common\models\Client;
use common\models\LanOrders;
use common\models\Order;
use Yii;
use common\models\Image;
use yii\web\Response;

class ImagesController extends BaseController
{
    /**
     * @inheritDoc
     */
    public function behaviors()
    {
        return array_merge(
            parent::behaviors(),
            [
                'className' => Image::className(),
            ]
        );
    }

    /**
     * @param int $id
     * @return \yii\web\Response
     * @throws \Throwable
     * @throws \yii\db\StaleObjectException
     * @throws \yii\web\NotFoundHttpException
     */
    public function actionDelete($id)
    {
        $this->findModel($id)->delete();
        return $this->redirect(Yii::$app->request->referrer);
    }

    public function actionSaveSort()
    {
        $response = ['result' => false, 'message' => null];
        Yii::$app->response->format = Response::FORMAT_JSON;
        $sort = Yii::$app->request->post();
        if($sort && $sort['ids'] && ($ids = json_decode($sort['ids'], true))) {
            foreach($ids as $position => $imageId) {
                if($image = Image::findOne($imageId)) {
                    $image->position = $position;
                    $image->save();
                }
            }
            $response['result'] = true;
            $response['message'] = 'Сортировка изображений успешно сохранена';
        }
        return $response;
    }
    public function actionImport()
    {
        return true;
        $lanOrders = LanOrders::find()->all();
        $countClients = 0;
        $countOrders = 0;
        foreach($lanOrders as $lanOrder) {
            $client = new Client();
            $client->name = $lanOrder->name;
            $client->phone = $lanOrder->phone;
            $client->email = $lanOrder->email;
            $client->status_id = Client::STATUS_ONE_TIME;
            $client->created_at = $lanOrder->date_order;
            $client->updated_at = $lanOrder->date_order;
            if($client->save()) {
                $countClients++;
                $model = new Order();
                $model->name = $lanOrder->ordername;
                $model->client_id = $client->id;
                $model->status_id = $lanOrder->status;
                $model->price = $lanOrder->price;
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
                $model->created_at = $lanOrder->date_order;
                $model->updated_at = $lanOrder->date_order;
                if($model->save()) {
                    $countOrders++;
                }
            }
        }
        return 'Добавлено '.$countClients.' клиентов и '.$countOrders.' заявок';
    }
}
