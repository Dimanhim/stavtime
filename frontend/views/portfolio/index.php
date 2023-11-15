<?php

use yii\widgets\ListView;
use common\models\Tag;

?>
<div id="portfolio-page" class="portfolio">
    <div class="container-fluid">
        <div class="row">
            <h3>Портфолио <?= Yii::$app->name ?></h3>
            <?= $this->render('_filter', [
                'dataProvider' => $dataProvider,
                'searchModel' => $searchModel,
            ]) ?>
        </div>
    </div>
</div>

