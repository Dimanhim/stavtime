<?php

use yii\helpers\Url;

?>
<li class="dropdown-submenu dropdown-hover">
    <a id="dropdownSubMenu2" href="<?= Url::to(['step/index']) ?>" role="button" <?php if($models) : ?>data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"<?php endif; ?> class="dropdown-item<?= $models ? ' dropdown-toggle' : '' ?> ">Этапы работы</a>
    <?php if($models) : ?>
        <ul aria-labelledby="dropdownSubMenu2" class="dropdown-menu border-0 shadow">
            <?php foreach($models as $model) : ?>
                <li class="<?= $model->linkClass ?>">
                    <a tabindex="-1" href="<?= Url::to(['step/view', 'id' => $model->id]) ?>" class="dropdown-item"><?= $model->name ?></a>
                </li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</li>
