<?php
use yii\helpers\Url;
?>
<footer class="main-footer">
    <strong>Copyright &copy; 2014-<?= date('Y') ?> <a href="<?= Url::to('/') ?>"><?= Yii::$app->name ?></a>.</strong>
    Все права защищены.
    <div class="float-right d-none d-sm-inline-block">
        <b>Version</b> 3.1.0
    </div>
</footer>
