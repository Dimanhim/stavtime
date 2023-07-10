<?php

use common\models\Office;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use himiklab\sortablegrid\SortableGridView;
use common\models\Document;
use kartik\select2\Select2;

/** @var yii\web\View $this */
/** @var backend\models\OfficeSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

$this->params['breadcrumbs'][] = $this->title;
?>
<div class="office-index">
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
            'number',
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
                    'data' => Document::getListOrder(),
                ]),
            ],
            'office_date',
            [
                'class' => ActionColumn::className(),
                'urlCreator' => function ($action, Office $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
