<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Office $model */

$this->title = 'Добавление';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="office-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
