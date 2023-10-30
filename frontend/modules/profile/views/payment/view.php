<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Payment $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $model->modelName;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payment-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'type_id',
                'value' => function($data) {
                    return $data->typeName;
                },
            ],
            [
                'attribute' => 'document_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->document) {
                        return Html::a($data->document->name, ['document/view', 'id' => $data->document->id], ['target' => '_blanc']);
                    }
                }
            ],
            'price',
            'short_description:ntext',
            'description:ntext',

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
        ],
    ]) ?>

</div>
