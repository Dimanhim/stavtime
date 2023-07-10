<?php

use yii\helpers\Html;

?>
<p>
    <?= Html::a('Редактировать', ['update'], ['class' => 'btn btn-success']) ?>
</p>
<?php if($briefs) : ?>
<table class="table table-striped table-brief-form">
    <tr>
        <th>Вопрос брифа</th>
        <th>Ответ</th>
    </tr>
    <?php foreach($briefs as $brief) : ?>
        <tr>
            <td><?= $brief->name ?></td>
            <td><?= $brief->userAnswer ?></td>
        </tr>
    <?php endforeach; ?>
</table>

<?php endif; ?>
