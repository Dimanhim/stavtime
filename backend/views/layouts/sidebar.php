<?php

use yii\helpers\Url;

?>
<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="<?= Url::to('/') ?>" class="brand-link" target="_blank">
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
                <a href="#" class="d-block"><?= Yii::$app->user->identity->username ?></a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        <!-- href be escaped -->
        <!--
         <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Поиск" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div>
        -->

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <?php
            echo \hail812\adminlte\widgets\Menu::widget([
                'items' => [
                    [
                        'label' => 'Заявки',
                        'icon' => 'address-card',
                        //'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Список', 'url' => ['order/index'], 'iconStyle' => 'far'],
                            ['label' => 'Добавить', 'url' => ['order/create'], 'iconStyle' => 'far'],
                        ]
                    ],
                    [
                        'label' => 'Клиенты',
                        'icon' => 'user',
                        //'badge' => '<span class="right badge badge-info">2</span>',
                        'items' => [
                            ['label' => 'Список', 'url' => ['client/index'], 'iconStyle' => 'far'],
                            ['label' => 'Добавить', 'url' => ['client/create'], 'iconStyle' => 'far'],
                        ]
                    ],


                    ['label' => 'СТАТИСТИКА', 'header' => true],
                    ['label' => 'Level1'],
                    /*[
                        'label' => 'Level1',
                        'items' => [
                            ['label' => 'Level2', 'iconStyle' => 'far'],
                            [
                                'label' => 'Level2',
                                'iconStyle' => 'far',
                                'items' => [
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle'],
                                    ['label' => 'Level3', 'iconStyle' => 'far', 'icon' => 'dot-circle']
                                ]
                            ],
                            ['label' => 'Level2', 'iconStyle' => 'far']
                        ]
                    ],*/
                    ['label' => 'Сплит-шаблон'],
                    ['label' => 'Заполненная форма'],
                    ['label' => 'Переход с сайта'],
                    ['label' => 'ID рекламной кампании/Город'],
                    ['label' => 'ID объявления/тип/позиция'],
                    ['label' => 'Ключевая фраза'],
                    ['label' => 'ДОПОЛНИТЕЛЬНЫЕ РАЗДЕЛЫ', 'header' => true],
                    ['label' => 'Бриф', 'url' => 'brief/index', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],
                    ['label' => 'Реквизиты', 'url' => 'organization/index', 'iconStyle' => 'far', 'iconClassAdded' => 'text-warning'],

                    //['label' => 'Important', 'iconStyle' => 'far', 'iconClassAdded' => 'text-danger'],

                    //['label' => 'Informational', 'iconStyle' => 'far', 'iconClassAdded' => 'text-info'],

                    //['label' => 'Сгенерировать pdf', 'url' => ['document/generate'], 'icon' => 'file-pdf'],


                    ['label' => 'Yii2 PROVIDED', 'header' => true],
                    ['label' => 'Login', 'url' => ['site/login'], 'icon' => 'sign-in-alt', 'visible' => Yii::$app->user->isGuest],
                    ['label' => 'Gii',  'icon' => 'file-code', 'url' => ['/gii'], 'target' => '_blank'],
                    ['label' => 'Debug', 'icon' => 'bug', 'url' => ['/debug'], 'target' => '_blank'],
                ],
            ]);
            ?>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>
<!--
главная
заявки
портфолио
клиенты

Настройки
На сайт
-->
