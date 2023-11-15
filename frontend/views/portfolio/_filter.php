<?php

use common\models\Tag;
use common\models\Portfolio;
use yii\widgets\ListView;

?>
<div id="portfolio-filter">
    <div class="col-md-4">
        <h4>Фильтры</h4>
        <div id="portfolio-filters" class="portfolio-filters filters-col" data-type="<?= $searchModel->type ? '1' : '0' ?>">
            <?php if($tags = Tag::findModels()->all()) : ?>
                <ul>
                    <?php foreach($tags as $tag) : ?>
                        <li>
                            <div class="portfolio-item-checkbox-row">
                                <div>
                                    <input id="<?= $tag->id ?>_checkbox" type="checkbox" <?= $tag->filterChecked($requestParams) ?> class="portfolio-filter-checkbox" data-id="<?= $tag->id ?>">
                                    <label for="<?= $tag->id ?>_checkbox">
                                        <?= $tag->name ?>
                                    </label>
                                </div>
                            </div>
                        </li>
                    <?php endforeach; ?>
                </ul>
            <?php endif; ?>
        </div>
    </div>
    <div class="col-md-8">
        <h4>Работы (<?= $dataProvider->getCount() ?>)</h4>
        <div class="container-fluid">
            <div class="row">
                <?= ListView::widget([
                    'dataProvider' => $dataProvider,
                    'emptyText' => false,
                    'layout' => "{items}\n{pager}",
                    'options' => ['class' => 'filters-col', 'id' => 'portfolio-row'],
                    'itemOptions' => ['tag' => false],
                    'itemView' => '//portfolio/_card',
                ]); ?>
            </div>

        </div>
    </div>
</div>
