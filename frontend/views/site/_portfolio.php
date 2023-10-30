<div class="recent-work" id="portfolio">
    <h3>Недавние работы - кейсы</h3>
    <div class="container">
        <div class="row">
            <?php use himiklab\thumbnail\EasyThumbnailImage;

            if($portfolio) : ?>
                <?php $i = 1; foreach($portfolio as $item) : ?>
                <?php $offsetClass = ($i == 1 or $i%2 != 0) ? ' col-md-offset-2' : '' ?>
                    <div class="one-work col-md-4 col-sm-6 wow fadeInLeft<?= $offsetClass ?>">
                        <figure>
                            <div>
                                <?= $item->getImageByPath($item->mainImage->path, 400, 300) ?>
                            </div>
                            <figcaption>
                                <div class="name-project">
                                    <!--
                                    <a href="<?= $item->link ?>" target="blanc">
                                        <?//= $item->name ?>
                                    </a>
                                    -->
                                    <span><?= $item->name ?></span>
                                </div>
                                <div class="port_desc">
                                    <p>цена создания:<br/><span><?= $item->price ? $item->price : '---' ?> руб.</span></p>
                                    <p>цена заявки<br/><span><?= $item->price_lead ? $item->price_lead : '---' ?> руб.</span></p>
                                    <p>конверсия<br/><span><?= $item->conversion ? $item->conversion.'5' : '---' ?></span></p>
                                </div>
                                <?php
                                    $fullImage = ($item->gallery && $item->gallery->images && array_key_exists(1, $item->gallery->images)) ? $item->gallery->images[1]->path : null;
                                ?>
                                <?php if($fullImage) : ?>
                                    <a href="/upload/<?= $fullImage ?>" class="button-slty">Посмотреть</a>
                                <?php endif; ?>
                            </figcaption>
                        </figure>
                    </div>
                <?php $i++; endforeach; ?>
            <?php endif; ?>
        </div>
    </div>
    <div class="more-view wow rotateIn">
        <a href="" class="get-user package-go">
            Посмотреть еще
        </a>
    </div>
</div>
