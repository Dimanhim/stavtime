<?php

use yii\helpers\Html;

$this->title = 'Работа в портфолио - '.$model->name;

?>
<div id="portfolio-item" class="portfolio">
    <div class="container-fluid">
        <div class="row">
            <div class="row">
                <div class="col-md-1" style="text-align: center; padding-top: 15px;">
                    <a href="/portfolio" class="btn btn-primary">
                        <i class="bi bi-back"></i>
                        Назад
                    </a>
                </div>
                <div class="col-md-11">
                    <h3>
                        Портфолио <?= Yii::$app->name ?>
                    </h3>
                </div>
            </div>


            <div class="row">
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Информация
                        </div>
                        <div class="card-body">
                            <table class="table table-borderless">
                                <tr>
                                    <td>Название</td>
                                    <td><?= $model->name ?></td>
                                </tr>
                                <tr>
                                    <td>Ссылка на сайт</td>
                                    <td><?= $model->link ? Html::a('Посмотреть', $model->link, ['target' => '_blanc']) : '---' ?></td>
                                </tr>
                                <tr>
                                    <td>Теги</td>
                                    <td><?= $model->tags ? $model->getListChunk($model->tags) : '---' ?></td>
                                </tr>
                                <tr>
                                    <td>Описание</td>
                                    <td><?= $model->description ?></td>
                                </tr>
                            </table>
                        </div>
                    </div>

                </div>
                <div class="col-md-6">
                    <div class="card">
                        <div class="card-header">
                            Галерея
                        </div>
                        <div class="card-body">
                            <?php if($images = $model->allImages) : ?>
                                <div class="col-row">
                                    <?php $i = 1; foreach($images as $image) : ?>
                                        <div class="col-md-4">
                                            <div class="portfolio-img-card">
                                                <a href="<?= $image->filePath ?>" data-fancybox="fancy" rel="group">
                                                    <img src="<?= $image->filePath ?>" alt="<?= $model->name ?>">
                                                </a>
                                            </div>
                                        </div>
                                            <?php if($i%3 == 0) : ?>
                                            <div class="clearfix"></div>
                                            <?php endif; ?>
                                    <?php $i++; endforeach; ?>
                                </div>
                            <div class="col-row">
                                <div class="col-md-12">
                                    <div style="margin: 15px 0;">
                                        <?php
                                            if($fullImage = $model->secondImage->filePath) {
                                                echo Html::a('Полная версия', $fullImage, ['class' => 'button-slty btn-portfolio-item-popup btn-portfolio-item']);
                                            }
                                        ?>
                                    </div>
                                </div>
                            </div>

                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
</div>
