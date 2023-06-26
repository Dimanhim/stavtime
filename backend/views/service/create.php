<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Service $model */

$this->title = 'Добавление услуги';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="service-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
