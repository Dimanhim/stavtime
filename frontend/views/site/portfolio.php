<?php

use common\models\Portfolio;

$portfolioItems = Portfolio::preparePortfolio($portfolio);

?>
<div id="portfolio-page">
    <div class="recent-work" id="portfolio">
        <h3>Портфолио <?= Yii::$app->name ?></h3>
        <div class="container">
            <div class="row">
                <?php if($portfolioItems) : ?>
                <?php foreach($portfolioItems as $portfolioName => $portfolio) : ?>
                    <h2><?= $portfolioName ?></h2>
                    <?php foreach($portfolio as $item) : ?>
                        <?php
                            $fullImage = ($item->gallery && $item->gallery->images && array_key_exists(1, $item->gallery->images))
                                ?
                                $item->gallery->images[1]->path
                                :
                                null;
                        ?>
                        <div class="one-work col-md-4 col-sm-6 wow fadeInLeft">
                            <figure>
                                <div>
                                    <?php if($fullImage) : ?>
                                        <a href="/upload/<?= $fullImage ?>" class="one-work-popup-link">
                                            <?= $item->getImageByPath($item->mainImage->path, 400, 300) ?>
                                        </a>
                                    <?php else : ?>
                                        <?= $item->mainImage ? $item->getImageByPath($item->mainImage->path, 400, 300) : null ?>
                                    <?php endif; ?>
                                </div>
                                <figcaption>
                                    <div class="name-project">
                                        <a href="<?= $item->link ?>" target="blanc">
                                            <?= $item->name ?>
                                        </a>
                                    </div>
                                    <div class="port_desc">
                                        <p>цена создания:<br/><span><?= $item->price ? $item->price : '---' ?> руб.</span></p>
                                        <p>цена заявки<br/><span><?= $item->price_lead ? $item->price_lead : '---' ?> руб.</span></p>
                                        <p>конверсия<br/><span><?= $item->conversion ? $item->conversion.'5' : '---' ?></span></p>
                                    </div>
                                    <?php if($fullImage) : ?>
                                        <a href="/upload/<?= $fullImage ?>" class="button-slty">Посмотреть</a>
                                    <?php endif; ?>
                                </figcaption>
                            </figure>
                        </div>
                        <?php endforeach; ?>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</div>

