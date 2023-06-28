<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Organization $model */

$this->title = 'Редактирование организации: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="organization-update">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
