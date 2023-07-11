<?php

namespace frontend\modules\profile\models;

use Yii;
use common\models\BriefOrder;
use yii\base\Model;

class BriefForm extends Model
{
    public $value;

    public function init()
    {
        if($briefOrders = BriefOrder::findAll(['order_id' => Yii::$app->params['order_id']])) {
            foreach($briefOrders as $briefOrder) {
                $this->value[$briefOrder->brief_id] = $briefOrder->value;
            }
        }
        return parent::init();
    }

    public function rules()
    {
        return [
            [['value'], 'safe'],
        ];
    }
}
