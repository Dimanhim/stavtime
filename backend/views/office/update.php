<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Office $model */

$this->title = 'Редактирование: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="office-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
