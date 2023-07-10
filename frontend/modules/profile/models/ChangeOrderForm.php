<?php

namespace frontend\modules\profile\models;

use common\models\Order;
use yii\base\Model;

class ChangeOrderForm extends Model
{
    public $order_id;

    public function rules()
    {
        return [
            [['order_id'], 'integer']
        ];
    }

    public static function getModel()
    {
        $model = new self();
        //$model->order_id = 195;
        if($order = \Yii::$app->params['orderModel']) {
            $model->order_id = $order->id;
        }
        return $model;
    }
}
