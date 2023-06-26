<?php

use common\models\Order;
use kartik\editors\Summernote;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Service $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="service-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?php
                $attributes = [
                    $form->field($model, 'name')->textInput(['maxlength' => true]),
                    $form->field($model, 'price')->textInput(['maxlength' => true]),
                    $form->field($model, 'old_price')->textInput(['maxlength' => true]),
                    $form->field($model, 'term')->textInput(['maxlength' => true]),
                    $form->field($model, 'description')->textarea(['cols' => 3, 'rows' => 10]),
                    $form->field($model, 'is_active')->checkbox(),
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
