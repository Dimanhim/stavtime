<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Step $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="step-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить этап?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

            [
                'attribute' => 'order_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->order) {
                        return Html::a($data->order->order_name, ['order/view', 'id' => $data->order->id], ['target' => '_blanc']);
                    }
                }
            ],
            'name',
            'short_description:ntext',
            'description:ntext',
            [
                'attribute' => 'done',
                'value' => function($data) {
                    return $data->doneName;
                }
            ],
            'deadline',

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
