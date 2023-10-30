<?php

use common\models\Visitor;
use yii\helpers\Html;
use yii\helpers\Url;
use yii\grid\ActionColumn;
use yii\grid\GridView;

/** @var yii\web\View $this */
/** @var backend\models\VisitorSearch $searchModel */
/** @var yii\data\ActiveDataProvider $dataProvider */

?>
<div class="visitor-index">

    <?= GridView::widget([
        'dataProvider' => $dataProvider,
        'filterModel' => $searchModel,
        'columns' => [
            ['class' => 'yii\grid\SerialColumn'],

            [
                'attribute' => 'user_agent',
                'value' => function($data) {
                    return mb_substr($data->user_agent, 0, 30);
                }
            ],
            'remote_addr',
            [
                'attribute' => 'http_referer',
                'headerOptions' => ['style' => 'max-width: 200px;'],
                'value' => function($data) {
                    return $data->http_referer;
                }
            ],
            [
                'attribute' => 'get_params',
                'format' => 'raw',
                'value' => function($data) {
                    if($data->get_params) {
                        $str = '<ul>';
                        foreach($data->get_params as $paramName => $paramValue) {
                            $str .= "<li>{$paramName} = {$paramValue}</li>";
                        }
                        $str .= '</ul>';
                        return $str;
                    }
                }
            ],
            [
                'attribute' => 'created_at',
                'value' => function($data) {
                    return $data->createdAt;
                }
            ],
            [
                'class' => ActionColumn::className(),
                'template' => '{view}',
                'urlCreator' => function ($action, Visitor $model, $key, $index, $column) {
                    return Url::toRoute([$action, 'id' => $model->id]);
                 }
            ],
        ],
    ]); ?>


</div>
