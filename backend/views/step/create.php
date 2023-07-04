<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Step $model */

$this->title = 'Добавление этапа';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="step-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
