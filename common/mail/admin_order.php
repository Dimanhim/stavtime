<?php

//$message = new Swift_Message('My subject');
//$message->embed(Swift_Image::fromPath( Yii::getAlias('@frontend').'/web/images/logo.png'));

$message = Yii::$app->mailer->compose();
$path = Yii::getAlias('@frontend'). '/web/images/logo.png';
$logoPath = $message->embed($path);



?>

<p>
    Заполнена контактная форма на сайте <b><?= \Yii::$app->name ?></b>
</p>
<ul>
    <li>Имя: <b><?= $model->name ?></b></li>
    <li>Номер телефона: <b><?= $model->phone ?></b></li>
    <li>E-mail: <b><?= $model->email ?></b></li>
    <li>Нажатая кнопка: <b><?= $model->pressed_btn ?></b></li>
    <li>Услуга: <b><?= $model->service ? $model->service->name : '---' ?></b></li>
</ul>

<p>
    Заявка успешно добавлена в базу данных!
</p>
