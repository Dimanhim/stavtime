<?php

/* @var $this \yii\web\View */
/* @var $content string */

use backend\assets\AppAsset;
use yii\helpers\Html;
use frontend\modules\profile\models\ChangeOrderForm;
use common\models\Order;

\hail812\adminlte3\assets\FontAwesomeAsset::register($this);
\hail812\adminlte3\assets\AdminLteAsset::register($this);


$this->registerCssFile('https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback');

$assetDir = Yii::$app->assetManager->getPublishedUrl('@vendor/almasaeed2010/adminlte/dist');

$publishedRes = Yii::$app->assetManager->publish('@vendor/hail812/yii2-adminlte3/src/web/js');
$this->registerCssFile( '/admin/css/bootstrap-icons.css', ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);
$this->registerCssFile( '/admin/css/font-awesome.min.css', ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);
$this->registerJsFile($publishedRes[1].'/control_sidebar.js', ['depends' => '\hail812\adminlte3\assets\AdminLteAsset']);
$this->registerJsFile('/js/profile.js?v='.mt_rand(1000,10000), ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);
$this->registerCssFile( '/admin/css/admin.css?v='.mt_rand(1000,10000), ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);

$this->registerCssFile('/css/profile.css?v='.mt_rand(1000,10000), ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);

$this->registerCssFile('css/jquery.fancybox.min.css', ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);
$this->registerJsFile('js/jquery.fancybox.min.js', ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);
$this->registerJsFile('js/inputmask.js', ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);
$this->registerJsFile('js/jquery.inputmask.js', ['depends' => 'hail812\adminlte3\assets\AdminLteAsset']);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body class="hold-transition sidebar-mini">
<?php $this->beginBody() ?>

<div class="wrapper">
    <!-- Navbar -->
    <?= $this->render('navbar', [
        'assetDir' => $assetDir,
        'orderForm' => ChangeOrderForm::getModel(),
    ]) ?>
    <!-- /.navbar -->

    <!-- Main Sidebar Container -->
    <?= $this->render('sidebar', ['assetDir' => $assetDir]) ?>

    <!-- Content Wrapper. Contains page content -->
    <?= $this->render('content', [
        'content' => $content,
        'assetDir' => $assetDir,
    ]) ?>
    <!-- /.content-wrapper -->

    <!-- Control Sidebar -->
    <?= $this->render('control-sidebar') ?>
    <!-- /.control-sidebar -->

    <!-- Main Footer -->
    <?= $this->render('footer') ?>
</div>

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
