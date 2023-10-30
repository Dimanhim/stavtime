<?php
use yii\helpers\Url;
use frontend\modules\profile\Profile;

$link = Yii::$app->urlManager->hostInfo.Profile::ROUTE.'/login?user_id='.$model->client->user_id;
$brief = Yii::$app->urlManager->hostInfo.Profile::ROUTE.'/login?user_id='.$model->client->user_id.'&action_id=brief'
?>

<p>
    Пользователем <?= $model->client->name ?> заполнен бриф
</p>
<p>
    По заявке <?= $model->id ?> <?= $model->name ? ' ('.$model->name.')' : '' ?>
</p>
<p style="text-align: center;">
    <a
        href="<?= Url::to(['/admin/order', 'id' => $model->id]) ?>" style="
                padding: 6px 12px;
                color: #fff;
                background: #28a745;
                text-decoration: none;
            "
    >
        перейти
    </a>
</p>





