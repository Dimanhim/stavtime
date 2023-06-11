<?php

use common\models\Order;
use common\models\Client;
use himiklab\thumbnail\EasyThumbnailImage;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use himiklab\sortablegrid\SortableGridView;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var backend\models\ClientSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="client-index">

    <p>
        <?= Html::a('Добавить', ['create'], ['class' => 'btn btn-success']) ?>
    </p>

    <?= SortableGridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($data) {
                    $name = $data->name ? $data->name : 'Б/Н';
                    return Html::a($name, ['order/view', 'id' => $data->id]);
                }
            ],
            [
                'attribute' => 'created_at',
                'format' => 'date',
                'contentOptions' => [
                    'data-label' => $searchModel->attributeLabels()['created_at'],
                    'class' => 'date-filter-range'
                ],
                'headerOptions' => [
                    'class' => 'date-filter-range'
                ],
                'filter' => DatePicker::widget([
                    'model' => $searchModel,
                    'attribute' => '_created_from',
                    'attribute2' => '_created_to',
                    'type' => DatePicker::TYPE_RANGE,
                    'separator' => '-',
                    'pluginOptions' => [
                        'format' => 'dd-mm-yyyy',
                        'language' => 'ru'
                    ],
                    'options' => [
                        'autocomplete' => 'off',
                    ],
                    'options2' => ['autocomplete' => 'off'],
                ]),
            ],
            [
                'attribute' => 'image_fields',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->mainImageHtml;
                }
            ],

            [
                'attribute' => 'status_id',
                'value' => 'statusName',
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'status_id',
                    'options' => ['placeholder' => '[не выбран]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Order::getStatuses(),
                ]),
            ],
            [
                'attribute' => 'client_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->client) {
                        return Html::a($data->client->name, ['client/view', 'id' => $data->client->id]);
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
            /*[
                'attribute' => 'service_id',
                'format' => 'raw',
                'value' => function($data) {
                    return false;
                },
            ],*/
            'price',
            'phone',
            'email:email',
            'split_template',
            'pressed_btn',
            [
                'attribute' => 'utm_source',
                'filter' => Order::getUtmArray('utm_source'),
            ],
            [
                'attribute' => 'utm_campaign',
                'filter' => Order::getUtmArray('utm_campaign'),
            ],
            [
                'attribute' => 'utm_medium',
                'filter' => Order::getUtmArray('utm_medium'),
            ],
            [
                'attribute' => 'utm_content',
                'filter' => Order::getUtmArray('utm_content'),
            ],
            [
                'attribute' => 'utm_term',
                'filter' => Order::getUtmArray('utm_term'),
            ],
            [
                'attribute' => 'is_active',
                'value' => function($data) {
                    return $data->active;
                },
                'filter' => [0 => 'Нет', 1 => 'Да'],
            ],
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Order $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
