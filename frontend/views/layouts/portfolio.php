<?php

/** @var \yii\web\View $this */

/** @var string $content */

use frontend\assets\PortfolioAsset;
use yii\bootstrap5\Html;

PortfolioAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="keywords"
          content="создание сайтов, разработка сайтов, создание продающих сайтов, разработка продающих сайтов">
    <meta name="description"
          content="Разработка сайтов. Эксклюзивный дизайн, высокая коверсия, CRM-система в подарок!">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <link href="/favicon.ico" rel="shortcut icon" type="image/x-icon"/>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>
<div class="loader-block"></div>
<!-- Yandex.Metrika counter -->
<!--
<script type="text/javascript" >
    (function(m,e,t,r,i,k,a){m[i]=m[i]||function(){(m[i].a=m[i].a||[]).push(arguments)};
        m[i].l=1*new Date();
        for (var j = 0; j < document.scripts.length; j++) {if (document.scripts[j].src === r) { return; }}
        k=e.createElement(t),a=e.getElementsByTagName(t)[0],k.async=1,k.src=r,a.parentNode.insertBefore(k,a)})
    (window, document, "script", "https://mc.yandex.ru/metrika/tag.js", "ym");

    ym(94545224, "init", {
        clickmap:true,
        trackLinks:true,
        accurateTrackBounce:true,
        webvisor:true
    });
</script>
<noscript><div><img src="https://mc.yandex.ru/watch/94545224" style="position:absolute; left:-9999px;" alt="" /></div></noscript>
-->
<!-- /Yandex.Metrika counter -->

<?= $content ?>

<?php $this->endBody() ?>

</body>
</html>
<?php $this->endPage(); ?>

