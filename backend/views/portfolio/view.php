<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Portfolio $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="portfolio-view">

    <p>
        <?= Html::a('Редактировать', ['update', 'id' => $model->id], ['class' => 'btn btn-primary']) ?>
        <?= Html::a('Удалить', ['delete', 'id' => $model->id], [
            'class' => 'btn btn-danger',
            'data' => [
                'confirm' => 'Вы уверены, что хотите удалить работу?',
                'method' => 'post',
            ],
        ]) ?>
    </p>

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            [
                'attribute' => 'order_id',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->order) {
                        $str = '';
                        $order = $data->order->order_name ? $data->order->order_name : 'Б/н';
                        $str .= Html::a($order. '', ['order/view', 'id' => $data->order->id]);
                        if($data->order->client) {
                            $str .= ' ('.Html::a($data->order->client->name. '', ['client/view', 'id' => $data->order->client->id]).')';
                        }
                        return $str;
                    }
                }
            ],
            'name',
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
            [
                'attribute' => 'portfolio_services',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->services) {
                        return $data->getListLinksChunk($data->services, 'service');
                    }
                }
            ],
            [
                'attribute' => 'portfolio_tags',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->services) {
                        return $data->getListLinksChunk($data->tags, 'tag');
                    }
                }
            ],
            'description:ntext',
            'comment:ntext',
            'created_date',
            'is_private:boolean',

            [
                'attribute' => 'image_fields',
                'format' => 'raw',
                'value' => function($data) {
                    return $data->getImagesHtml(4);
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
