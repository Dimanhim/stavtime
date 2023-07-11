<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;
use common\models\Brief;

?>
<?php if($briefs) : ?>
    <?php $form = ActiveForm::begin(['id' => 'form-brief', 'fieldConfig' => ['options' => ['tag' => false]]]) ?>
        <table class="table table-striped table-brief-form">
            <tr>
                <th>Вопрос брифа</th>
                <th>Ответ</th>
            </tr>
            <?php foreach($briefs as $brief) : ?>
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


