<?php

use yii\helpers\Html;
use yii\swiftmailer\Message;

/** @var \yii\web\View $this view component instance */
/** @var \yii\mail\MessageInterface $message the message being composed */
/** @var string $content main view render result */

?>
<?php $this->beginPage() ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=<?= Yii::$app->charset ?>" />
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
    <?php $this->beginBody() ?>
    <div style="background-color:#e5e5e5">
        <div style="width: 500px; margin:auto; background-color: #fff;">

            <div style="padding: 20px;">
                <div style="text-align: center; padding: 20px;">
                    <h1 style="font-weight: bold; font-size: 22px;"><?= Yii::$app->name ?></h1>
                </div>
                <?= $content ?>

                <p></p>
                <p>Спасибо!</p>
                <p>С уважением, Ваш менеджер по проекту - Дмитрий!</p>
                <p>Сайт <a href="<?= Yii::$app->urlManager->hostInfo ?>"><?= Yii::$app->urlManager->hostInfo ?></a></p>
            </div>

        </div>
    </div>
    <?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage();
