<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Payment $model */

$this->title = 'Добавить оплату';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="payment-create">

    <?= $this->render('_form', [
        'model' => $model,
        'order_id' => $order_id,
    ]) ?>

</div>
