<?php

use yii\helpers\Url;
use common\models\SessionOrder;
use frontend\modules\profile\models\Profile;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to('/') ?>" class="brand-link">
        <img src="/images/short_logo.png" alt="<?= Yii::$app->name ?>" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light"><?= Yii::$app->name ?></span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                <img src="<?= Yii::$app->params['avatarPath'] ?>" class="img-circle elevation-2" alt="User Image">
            </div>
            <div class="info">
                <a href="<?= Url::to(['profile/profile/edit']) ?>" class="d-block"><?= Yii::$app->user->identity->name ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Starter Pages',
                        'icon' => 'tachometer-alt',
                        'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Active Page', 'url' => ['site/index'], 'iconStyle' => 'far'],
                            ['label' => 'Inactive Page', 'iconStyle' => 'far'],
                        ]
                    ],
                    ['label' => 'Simple Link', 'icon' => 'th', 'badge' => '<span class="right badge badge-danger">New</span>'],
                    ['label' => 'МЕНЮ', 'header' => true],
                    Profile::getSidebarOrders(),
                    ['label' => 'Бриф', 'url' => ['/profile/brief']],
                    //Profile::getSidebarSteps(),
                    //Profile::getSidebarDocuments(),
                    //Profile::getSidebarPayments(),
                    ['label' => 'АДМИНИСТРАТОР', 'header' => true],
                    ['label' => 'Активная заявка', 'url' => ['order/view', 'id' => Yii::$app->params['order_id']], 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Заполненный бриф', 'url' => ['brief/index'], 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    //['label' => 'Warning', 'iconClass' => 'nav-icon far fa-circle text-warning'],
                    //['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
