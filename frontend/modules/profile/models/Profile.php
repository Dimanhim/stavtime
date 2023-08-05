<?php

namespace frontend\modules\profile\models;

use Yii;
use common\models\Order;

class Profile
{
    public static function getOrders()
    {
        return Yii::$app->user->identity->id ? Order::findModels()->andWhere(['client_id' => Yii::$app->user->identity->id])->all() : [];
    }

    public function getSidebarOrders()
    {
        $data = [
            'label' => 'Мои заявки',
            'icon' => 'address-book',
            'badge' => '<span class="right badge badge-info">'.Yii::$app->params['orders_count'].'</span>',
            'url' => ['order/index'],
        ];
        if(($orders = self::getOrders())) {
            $data['items'] = [];
            foreach($orders as $model) {
                $data['items'][] = [
                    'label' => $model->order_name ? $model->order_name : $model->name,
                    'url' => ['order/view', 'id' => $model->id],
                    'options' => ['class' => 'nav-item '.$model->linkClass],
                    'iconStyle' => 'far',
                ];
            }
        }
        return $data;
    }
    public static function getSidebarSteps()
    {
        $data = [
            'label' => 'Этапы работы',
            'url' => ['step/index'],
        ];
        if(($order = Yii::$app->params['orderModel']) and ($models = $order->steps)) {
            $data['items'] = [];
            foreach($models as $model) {
                $data['items'][] = [
                    'label' => $model->name,
                    'url' => ['step/view', 'id' => $model->id],
                    'options' => ['class' => 'nav-item '.$model->linkClass],
                    'iconStyle' => 'far',
                ];
            }
        }
        return $data;
    }
    public static function getSidebarDocuments()
    {
        $data = [
            'label' => 'Документы',
            'url' => ['document/index'],
        ];
        if(($order = Yii::$app->params['orderModel']) and ($models = $order->documents)) {
            $data['items'] = [];
            foreach($models as $model) {
                $data['items'][] = [
                    'label' => $model->name,
                    'url' => ['document/view', 'id' => $model->id],
                    'options' => ['class' => 'nav-item'],
                    'iconStyle' => 'far',
                ];
            }
        }
        return $data;
    }
    public static function getSidebarPayments()
    {
        $data = [
            'label' => 'Оплаты',
            'url' => ['payment/index'],
        ];
        if(($order = Yii::$app->params['orderModel']) and ($models = $order->payments)) {
            $data['items'] = [];
            foreach($models as $model) {
                $data['items'][] = [
                    'label' => $model->name,
                    'url' => ['payment/view', 'id' => $model->id],
                    'options' => ['class' => 'nav-item'],
                    'iconStyle' => 'far',
                ];
            }
        }
        return $data;
    }

    public static function getNavbarSteps()
    {
        $models = [];
        $order = Yii::$app->params['orderModel'];
        if($order) $models = $order->steps;
        return Yii::$app->controller->renderPartial('/chunks/_navbar_steps', [
            'models' => $models
        ]);
        return null;
    }
    public static function getNavbarDocuments()
    {
        $models = [];
        $order = Yii::$app->params['orderModel'];
        if($order) $models = $order->orderDocuments;
        return Yii::$app->controller->renderPartial('/chunks/_navbar_documents', [
            'models' => $models
        ]);
        return null;
    }
    public static function getNavbarPayments()
    {
        $models = [];
        $order = Yii::$app->params['orderModel'];
        if($order) $models = $order->payments;
        return Yii::$app->controller->renderPartial('/chunks/_navbar_payments', [
            'models' => $models
        ]);
        return null;
    }
    public static function getNavbarOrders()
    {
        $models = self::getOrders();
        return Yii::$app->controller->renderPartial('/chunks/_navbar_orders', [
            'models' => $models
        ]);
        return null;
    }


}
