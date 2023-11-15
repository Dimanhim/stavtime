<?php if($model) : ?>
    <?php
        $fullImage = $model->secondImage->filePath;
        $previewImage = $model->mainImage->filePath ;
    ?>
    <div class="col-md-4 col-sm-6 portfolio-work-item">
        <div class="portfolio-card">
            <div class="portfolio-card-bg">
                <div class="portfolio-card-bg-content">
                    <a href="<?= $model->fullPath ?>" class="portfolio-full-path">
                    <h5>
                        <?= $model->name ?>
                    </h5>
                    <?php if($model->tags) : ?>
                    <div class="portfolio-card-desc">
                        <p>
                            <?= $model->getListChunk($model->tags) ?>
                        </p>
                    </div>
                    <?php endif; ?>
                    </a>
                    <div class="portrolio-bg-btns">
                        <div class="container-fluid">
                            <div class="row">
                                <div class="col-md-6">
                                    <div>
                                        <a href="<?= $fullImage ?>" style="margin-left: -20px;" class="button-slty btn-portfolio-item-popup btn-portfolio-item">Посмотреть</a>
                                    </div>
                                </div>
                                <?php if($model->link) : ?>
                                <div class="col-md-6">
                                    <div style="text-align: right">
                                        <a href="<?= $model->link ?>" target="_blank" class="button-slty btn-portfolio-item">Сайт</a>
                                    </div>
                                </div>
                                <?php endif; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php if($previewImage) : ?>
                <a href="<?= $fullImage ?>" class="one-work-popup-link">
                    <?= $model->getImageByPath($model->mainImage->path, 400, 300) ?>
                </a>
            <?php else : ?>
                <?= $model->mainImage ? $model->getImageByPath($model->mainImage->path, 400, 300) : null ?>
            <?php endif; ?>
        </div>
    </div>
<?php endif; ?>
