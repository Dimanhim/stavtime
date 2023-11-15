<?php

use common\models\Service;
use common\models\Tag;
use common\models\Portfolio;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use himiklab\sortablegrid\SortableGridView;

/** @var yii\web\View $this */
/** @var backend\models\PortfolioSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-index">

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
            [
                'attribute' => 'name',
                'format' => 'raw',
                'value' => function($data) {
                    return Html::a($data->name, ['portfolio/update', 'id' => $data->id]);
                }
            ],

            [
                'attribute' => 'order_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->order) {
                        return Html::a($data->order->name, ['order/view', 'id' => $data->order->id]);
                    }
                }
            ],
            'price',
            'price_lead',
            'conversion',
            [
                'attribute' => 'link',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->link) {
                        return Html::a($data->link, $data->link, ['target' => '_blanc']);
                    }
                }
            ],

            /*[
                'attribute' => 'portfolio_services',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->services) {
                        return $data->getListLinksChunk($data->services, 'service');
                    }
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'portfolio_services',
                    'options' => ['placeholder' => '[не выбраны]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Service::getList(),
                ]),
            ],*/
            [
                'attribute' => 'portfolio_tags',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->tags) {
                        return $data->getListLinksChunk($data->tags, 'tag');
                    }
                },
                'filter' => Select2::widget([
                    'model' => $searchModel,
                    'attribute' => 'portfolio_tags',
                    'options' => ['placeholder' => '[не выбраны]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Tag::getList(),
                ]),
            ],


            [
                'attribute' => 'created_at',
                'value' => function($data) {
                    return $data->createdAt;
                }
            ],
            'is_active:boolean',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Portfolio $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
