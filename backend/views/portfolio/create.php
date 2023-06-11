<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Portfolio $model */

$this->title = 'Добавить работу';
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="portfolio-create">

    <?= $this->render('_form', [
        'model' => $model,
    ]) ?>

</div>
