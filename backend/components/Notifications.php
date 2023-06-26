<?php

namespace backend\components;

use common\models\Notification;
use common\models\Order;
use yii\base\Component;

class Notifications extends Component
{
    /**
     * @return array
     */
    public function types()
    {
        return [
            Notification::MODEL_TYPE_ORDER => [
                'iconClass' => 'fas fa-envelope mr-2',  // иконка конверт
                'count' => 0,
                'text' => 'Новая заявка',
                'link' => [],
            ],
            Notification::MODEL_TYPE_CLIENT => [
                'iconClass' => 'fas fa-users mr-2',  // иконка человечков
                'count' => 0,
                'text' => 'Новый клиент',
                'link' => [],
            ],
        ];
        //'iconClass' => 'fas fa-file mr-2',   // иконка листа
    }

    public function adminData()
    {
        $data = [];
        $items = $this->adminItems();
        if($items) {
            foreach($items as $item) {
                $eachData = [
                    'iconClass' => '',
                    'text' => '',
                    'link' => [],
                ];
                if($item->model_type == Notification::MODEL_TYPE_ORDER) {
                    if($item->type_id == Notification::TYPE_CREATE) {
                        $eachData = [
                            'iconClass' => 'fas fa-envelope mr-2',
                            'text' => 'Новая заявка с сайта',
                            'link' => ['order/view', 'id' => $item->model_id],
                        ];
                    }
                }
                if($item->model_type == Notification::MODEL_TYPE_CLIENT) {
                    if($item->type_id == Notification::TYPE_CREATE) {
                        $eachData = [
                            'iconClass' => 'fas fa-users mr-2',
                            'text' => 'Новый клиент',
                            'link' => ['client/view', 'id' => $item->model_id],
                        ];
                    }
                }
                $data[] = $eachData;
            }
            return $data;
        }
        return false;

    }

    public function adminItems()
    {
        return Notification::find()->where(['manager_seen' => null])->all();
    }

    public function userItems()
    {
        return Notification::find()->where(['client_id' => \Yii::$app->user->id, 'user_seen' => null])->all();
    }
}
