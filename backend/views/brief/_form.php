<?php

use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Brief;

/** @var yii\web\View $this */
/** @var common\models\Brief $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="brief-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?php
            $attributes = [
                $form->field($model, 'type_id')->dropDownList(Brief::getTypes(), ['prompt' => '[Не выбрано]']),
                $form->field($model, 'name')->textInput(['maxlength' => true]),
                $form->field($model, 'short_description')->textarea(['cols' => 3, 'rows' => 10]),
                $form->field($model, 'description')->textarea(['cols' => 3, 'rows' => 10]),
                $form->field($model, 'tag_id')->dropDownList(Brief::getTags(), ['prompt' => '[Не выбрано]']),
                $form->field($model, 'is_active')->checkbox()
            ];
            echo $model->getFormCard($attributes, 'Основная информация');
            ?>
        </div>
        <div class="col-6">
            <?= $model->getImagesField($form) ?>
        </div>
        <div class="clearfix"></div>
        <div class="col-12">
            <div class="form-group mt10">
                <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
            </div>
        </div>
    </div>
    <?php ActiveForm::end(); ?>
</div>
