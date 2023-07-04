<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Payment $model */

$this->title = 'Редактирование оплаты: ' . $model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Редактирование';
?>
<div class="payment-update">

    <?= $this->render('_form', [
        'model' => $model,
        'order_id' => null,
    ]) ?>

</div>
