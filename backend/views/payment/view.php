<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Payment $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="payment-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить оплату?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',

            'name',
            [
                'attribute' => 'type_id',
                'value' => function($data) {
                    return $data->typeName;
                },
            ],
            [
                'attribute' => 'client_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->client) {
                        return Html::a($data->client->name, ['client/view', 'id' => $data->client->id], ['target' => '_blanc']);
                    }
                }
            ],
            [
                'attribute' => 'order_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->order) {
                        return Html::a($data->order->order_name, ['order/view', 'id' => $data->order->id], ['target' => '_blanc']);
                    }
                }
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
        ],
    ]) ?>

</div>
