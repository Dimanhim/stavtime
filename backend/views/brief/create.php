<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Brief $model */

$this->title = 'Добавление вопроса';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="brief-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
