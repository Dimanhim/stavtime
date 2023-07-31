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

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [

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
                    return $data->getImagesHtml(4);
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
