<?php

use himiklab\thumbnail\EasyThumbnailImage;
use yii\helpers\Html;
$class = (isset($rows) and $rows) ? 'col-md-'.$rows : 'col-md-6';

?>

<?php if ($model && ($images = $model->images)): ?>
    <div class="container-fluid">
        <div class="image-preview-container">
            <div class="row" style="width: 100%;">
                <?php foreach($images as $image) : ?>
                    <div class="<?= $class ?> image-preview" data-id="<?= $image->id ?>">
                        <div class="image-preview-content">
                            <a href="<?= $image->fileUrl ?>" <?= $image->galleryAttributes() ?>>
                                <?= $image->img ?>
                            </a>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    </div>
<?php endif ?>
