<?php

use yii\helpers\Html;
use yii\helpers\Url;
use frontend\modules\profile\models\Profile;

?>
<!-- Navbar -->
<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="/profile" class="nav-link">Инструкция</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="<?= Url::to(['order/index']) ?>" class="nav-link">Мои заявки</a>
        </li>
        <li class="nav-item dropdown">
            <a id="dropdownSubMenu1" href="#" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" class="nav-link dropdown-toggle">Меню...</a>
            <ul aria-labelledby="dropdownSubMenu1" class="dropdown-menu border-0 shadow">
                <li><a href="<?= Url::to(['/profile/brief']) ?>" class="dropdown-item">Бриф</a></li>

                <li class="dropdown-divider"></li>

                <!-- Level two dropdown-->
                <?= Profile::getNavbarSteps() ?>
                <?= Profile::getNavbarDocuments() ?>
                <?= Profile::getNavbarPayments() ?>

                <!-- End Level two -->
            </ul>
        </li>
    </ul>
    <ul class="navbar-nav ml-auto">
        <li>
            <?= $this->render('_order_form', [
                'orderForm' => $orderForm
            ]) ?>
        </li>
    </ul>
    <!-- Right navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <?= Html::a('<i class="fas fa-sign-out-alt"></i>', ['/profile/default/logout'], ['data-method' => 'post', 'class' => 'nav-link']) ?>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
    </ul>
</nav>
<!-- /.navbar -->
