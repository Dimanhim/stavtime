<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Visitor $model */

$this->title = 'Посетитель ID='.$model->id;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['visitor/index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="visitor-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'id',
            'user_agent',
            'remote_addr',
            'http_referer:ntext',
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
        ],
    ]) ?>

</div>
