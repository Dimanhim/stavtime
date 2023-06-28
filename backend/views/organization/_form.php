<?php

use common\models\Client;
use common\models\Order;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Organization $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="organization-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?php
            $attributes = [
                $form->field($model, 'name')->textInput(['maxlength' => true]),
                $form->field($model, 'organization_name')->textInput(['maxlength' => true]),
                $form->field($model, 'position_name')->textInput(['maxlength' => true]),
                $form->field($model, 'action_basis')->textInput(['maxlength' => true]),
                $form->field($model, 'person_name')->textInput(['maxlength' => true]),
                $form->field($model, 'short_person_name')->textInput(['maxlength' => true]),
                $form->field($model, 'phone')->textInput(['maxlength' => true]),
                $form->field($model, 'email')->textInput(['maxlength' => true]),
                $form->field($model, 'legal_address')->textarea(['maxlength' => true]),
                $form->field($model, 'actual_address')->textarea(['maxlength' => true]),
                $form->field($model, 'inn')->textInput(['maxlength' => true]),
                $form->field($model, 'kpp')->textInput(['maxlength' => true]),
                $form->field($model, 'okpo')->textInput(['maxlength' => true]),
                $form->field($model, 'ogrn')->textInput(['maxlength' => true]),
                $form->field($model, 'rs')->textInput(['maxlength' => true]),
                $form->field($model, 'kors')->textInput(['maxlength' => true]),
                $form->field($model, 'bik')->textInput(['maxlength' => true]),
                $form->field($model, 'bank_name')->textInput(['maxlength' => true]),
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
