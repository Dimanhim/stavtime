<?php

use common\models\Order;
use common\models\Step;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use himiklab\sortablegrid\SortableGridView;

/** @var yii\web\View $this */
/** @var backend\models\StepSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="step-index">

    <p>
        <?= Html::a('Добавить этап', ['create'], ['class' => 'btn btn-success']) ?>
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
            'name',
            [
                'attribute' => 'done',
                'value' => function($data) {
                    return $data->doneName;
                }
            ],
            'deadline',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Step $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
