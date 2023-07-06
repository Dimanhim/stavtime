<?php

use common\models\Client;
use common\models\Order;
use frontend\modules\profile\Profile;
use himiklab\sortablegrid\SortableGridView;
use kartik\widgets\DatePicker;
use kartik\widgets\Select2;
use yii\grid\ActionColumn;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = 'Клиент: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <div class="row">
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Информация по клиенту
                </div>
                <div class="card-body">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'name',
                            'phone',
                            'email:email',
                            'comment',


                            [
                                'attribute' => 'image_fields',
                                'format' => 'raw',
                                'value' => function($data) {
                                    return $data->imagesHtml;
                                }
                            ],
                            [
                                'attribute' => 'is_active',
                                'value' => function($data) {
                                    return $data->active;
                                }
                            ],
                            [
                                'attribute' => 'created_at',
                                'value' => function($data) {
                                    return $data->createdAt;
                                }
                            ],
                            [
                                'attribute' => 'updated_at',
                                'value' => function($data) {
                                    return $data->updatedAt;
                                }
                            ],
                            [
                                'attribute' => 'Личный кабинет',
                                'format' => 'raw',
                                'value' => function($data) {
                                    if($data->user_id) {
                                        return Html::a('Перейти', Yii::$app->urlManager->hostInfo.Profile::ROUTE.'/login?user_id='.$data->user_id, ['target' => '_blanc']);

                                    }
                                    else {
                                        return Html::a('Создать', ['client/create-lk', 'id' => $data->id], ['class' => 'btn btn-warning']);
                                    }
                                }
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>
        <div class="col-6">
            <div class="card">
                <div class="card-header">
                    Реквизиты
                </div>
                <div class="card-body">
                    <?php if($model->info) : ?>
                    <?= DetailView::widget([
                        'model' => $model->info,
                        'attributes' => [
                            'organization_name',
                            'position_name',
                            'action_basis',
                            'person_name',
                            'short_person_name',
                            'phone',
                            'email',
                            'legal_address',
                            'actual_address',
                            'inn',
                            'kpp',
                            'okpo',
                            'ogrn',
                            'rs',
                            'kors',
                            'bik',
                            'bank_name',
                        ],
                    ]) ?>
                    <?php else : ?>
                        <p>Реквизиты не заполнены</p>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-12">
            <?= SortableGridView::widget([
                'dataProvider' => $orderDataProvider,
                'filterModel' => $orderSearchModel,
                'rowOptions' => function ($data, $key, $index, $grid) {
                    return ['class' => $data->seenClass()];
                },
                'columns' => [
                    [
                        'class' => ActionColumn::className(),
                        'urlCreator' => function ($action, Order $data, $key, $index, $column) {
                            return Url::to(['order/'.$action, 'id' => $data->id]);
                        }
                    ],
                    ['class' => 'yii\grid\SerialColumn'],
                    [
                        'attribute' => 'order_name',
                        'format' => 'raw',
                        'value' => function($data) {
                            $name = $data->order_name ? $data->order_name : 'Б/Н';
                            return Html::a($name, ['order/view', 'id' => $data->id]);
                        }
                    ],
                    'name',
                    [
                        'attribute' => 'created_at',
                        'format' => 'date',
                        'contentOptions' => [
                            'data-label' => $orderSearchModel->attributeLabels()['created_at'],
                            'class' => 'date-filter-range'
                        ],
                        'headerOptions' => [
                            'class' => 'date-filter-range'
                        ],
                        'filter' => DatePicker::widget([
                            'model' => $orderSearchModel,
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
                            'model' => $orderSearchModel,
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
                            'model' => $orderSearchModel,
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

                ],
            ]); ?>
        </div>
    </div>



</div>
