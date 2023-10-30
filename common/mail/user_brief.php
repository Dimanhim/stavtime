<?php
use yii\helpers\Url;
use frontend\modules\profile\Profile;

$link = Yii::$app->urlManager->hostInfo.Profile::ROUTE.'/login?user_id='.$model->client->user_id;
$brief = Yii::$app->urlManager->hostInfo.Profile::ROUTE.'/login?user_id='.$model->client->user_id.'&action_id=brief'
?>

<p>
    Вы оставляли заявку на нашем сайте на создание лендинга.
</p>
<p>
    Для Вашего удобства и экономии времени, мы специально для Вас создали личный кабинет, который доступен по <a href="<?= $link ?>">ссылке</a>.
</p>
<p>
    Ваши данные для входа в личный кабинет:
</p>
<ul>
    <li>Логин: <b><?= $model->client->email ?></b></li>
    <li>Пароль: <b><?= $model->client->user_id ?></b></li>
</ul>
<p>
    Для начала работы, мы Вам предлагаем заполнить бриф на создание сайта, чтобы уменьшить количество вопросов в будущем.
</p>
<p style="text-align: center;">
    <a
            href="<?= $brief ?>" style="
                padding: 6px 12px;
                color: #fff;
                background: #28a745;
                text-decoration: none;
            "
    >
        Заполнить бриф
    </a>
</p>
<p>
    Пожалуйста, не удаляйте данное письмо, чтобы пароль был всегда доступен.
</p>
<p style="text-align: center;">
    <a
            href="<?= $link ?>" style="
                padding: 6px 12px;
                color: #fff;
                background: #28a745;
                text-decoration: none;
            "
    >
        Перейти в личный кабинет
    </a>
</p>





