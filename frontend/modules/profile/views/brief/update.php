<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\Brief;

$this->params['breadcrumbs'][] = ['label' => 'Бриф', 'url' => ['brief/index']];
$this->params['breadcrumbs'][] = 'Редактирование';

$typeId = null;
?>
<?php if($briefs) : ?>
    <?php $form = ActiveForm::begin(['id' => 'form-brief', 'fieldConfig' => ['options' => ['tag' => false]]]) ?>
        <table class="table table-striped table-brief-form">
            <tr>
                <th>Вопрос брифа</th>
                <th>Ответ</th>
            </tr>
            <?php foreach($briefs as $brief) : ?>
            <?php $showName = ($typeId != $brief->type_id) ?>
            <?php if($showName) : ?>
                <tr class="brief-head">
                    <td colspan="2">
                        <?= $brief->typeName ?>
                    </td>
                </tr>
            <?php $typeId = $brief->type_id; endif; ?>
                <tr>
                    <td><?= $brief->name ?></td>
                    <td>
                        <?php
                            if($brief->tag_id == Brief::TAG_ID_INPUT) {
                                echo $form->field($model, "value[{$brief->id}]", ['template' => '{input}'])->textInput(['maxlength' => true]);
                            }
                            elseif($brief->tag_id == Brief::TAG_ID_TEXTAREA) {
                                echo $form->field($model, "value[{$brief->id}]", ['template' => '{input}'])->textarea(['cols' => 10, 'rows' => 1]);
                            }
                        ?>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    <?= Html::submitButton('Сохранить', ['class' => "btn btn-success"]) ?>
    <?php ActiveForm::end() ?>
<?php endif; ?>


