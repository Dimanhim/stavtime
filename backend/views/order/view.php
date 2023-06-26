<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = 'Заявка: '.$model->name;
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
        <?= Html::a('Информация', ['info', 'id' => $model->id], [
            'class' => 'btn btn-warning'
        ]) ?>
        <?= Html::a('Добавить документ', ['document/create', 'order_id' => $model->id], [
            'class' => 'btn btn-success'
        ]) ?>
        <?= Html::a('Сгенерировать документ', ['document/generate', 'order_id' => $model->id], [
            'class' => 'btn btn-success'
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
            [
                'attribute' => 'status_id',
                'value' => function($data) {
                    return $data->statusName;
                }
            ],
            [
                'attribute' => 'client_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->client) {
                        return Html::a($data->client->name, ['client/view', 'id' => $data->client->id]);
                    }
                },
            ],
            //'service_id',
            'price',
            'phone',
            'email:email',
            'split_template',
            'pressed_btn',
            'utm_source',
            'utm_campaign',
            'utm_medium',
            'utm_content',
            'utm_term',
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
                'attribute' => 'Отправить бриф',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->send_brief) {
                        return Html::tag('span', 'Бриф отправлен', ['class' => 'send-brief']);
                    }
                    else {
                        return Html::a('Отправить', ['order/send-brief', 'id' => $data->id], ['class' => 'btn btn-warning']);
                    }
                }
            ],
        ],
    ]) ?>

</div>
