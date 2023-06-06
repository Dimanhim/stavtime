<?php

/** @var \yii\web\View $this */

/** @var string $content */

use common\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
          content="создание лендингов, разработка лендингов, landing page, создание продающих лендинг пейдж, разработка продающих лендинг пейдж">
    <meta name="description"
          content="Разработка продающих лендингов. Эксклюзивный дизайн, высокая коверсия, без предоплаты, мультилендинги CRM-система в подарок!">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<?= $content ?>

<?php $this->endBody() ?>
<script>

</script>
<script>

</script>

</body>
</html>
<?php $this->endPage(); ?>

