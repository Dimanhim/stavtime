<?php

use common\models\Order;
use common\models\Client;
use himiklab\thumbnail\EasyThumbnailImage;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var backend\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'columns' => [

            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'order_name',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->orderName, ['order/view', 'id' => $data->id]);
                }
            ],
            'name',
            'price',
            [
                'attribute' => 'status_id',
                'value' => function($data) {
                    return $data->statusName;
                }
            ],
            'phone',
            'email:email',
            'created_at:date',
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                }
            ],


        ],
    ]); ?>


</div>
