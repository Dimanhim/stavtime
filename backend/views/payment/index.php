<?php

use common\models\Client;
use common\models\Order;
use common\models\Document;
use common\models\Payment;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use himiklab\sortablegrid\SortableGridView;

/** @var yii\web\View $this */
/** @var backend\models\PaymentSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'image_fields',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->mainImageHtml;
                }
            ],
            'name',
            [
                'attribute' => 'type_id',
                'value' => function($data) {
                    return $data->typeName;
                },
                'filter' => Payment::getTypes(),
            ],
            [
                'attribute' => 'client_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->client) {
                        return Html::a($data->client->name, ['client/view', 'id' => $data->client->id], ['target' => '_blanc']);
                    }
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'client_id',
                    'options' => ['placeholder' => '[не выбран]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Client::getList(),
                ]),
            ],
            [
                'attribute' => 'order_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->order) {
                        return Html::a($data->order->order_name, ['order/view', 'id' => $data->order->id], ['target' => '_blanc']);
                    }
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'order_id',
                    'options' => ['placeholder' => '[не выбран]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Order::getList(),
                ]),
            ],
            [
                'attribute' => 'document_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->document) {
                        return Html::a($data->document->name, ['document/view', 'id' => $data->document->id], ['target' => '_blanc']);
                    }
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'document_id',
                    'options' => ['placeholder' => '[не выбран]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Document::getList(),
                ]),
            ],
            'price',
            //'is_active',
            //'deleted',
            //'position',
            //'created_at',
            //'updated_at',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Payment $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
