<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Document $model */

$this->title = $model->name;
$this->params['breadcrumbs'][] = $model->modelName;
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="document-view">

    <?= DetailView::widget([
        'model' => $model,
        'attributes' => [
            'name',
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
