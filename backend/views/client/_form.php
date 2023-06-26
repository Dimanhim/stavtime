<?php

use kartik\widgets\FileInput;
use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Client $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="client-form">
    <?php $form = ActiveForm::begin(); ?>
        <div class="row">
            <div class="col-6">
                <?php
                    $attributes = [
                        $form->field($model, 'name')->textInput(['maxlength' => true]),
                        $form->field($model, 'phone')->textInput(['maxlength' => true, 'class' => 'form-control phone-mask']),
                        $form->field($model, 'email')->textInput(['maxlength' => true]),
                        $form->field($model, 'comment')->textarea(),
                        $form->field($model, 'is_active')->checkbox()
                    ];
                    echo $model->getFormCard($attributes, 'Основная информация');
                ?>
            </div>
            <div class="col-6">
                <?= $model->getImagesField($form) ?>
            </div>
            <div class="col-6">
                <?php
                $attributes = [
                    $form->field($info, 'organization_name')->textInput(['maxlength' => true]),
                    $form->field($info, 'position_name')->textInput(['maxlength' => true]),
                    $form->field($info, 'action_basis')->textInput(['maxlength' => true]),
                    $form->field($info, 'person')->textInput(['maxlength' => true]),
                    $form->field($info, 'phone')->textInput(['maxlength' => true]),
                    $form->field($info, 'email')->textInput(['maxlength' => true]),
                    $form->field($info, 'legal_address')->textarea(['maxlength' => true]),
                    $form->field($info, 'actual_address')->textarea(['maxlength' => true]),
                    $form->field($info, 'inn')->textInput(['maxlength' => true]),
                    $form->field($info, 'kpp')->textInput(['maxlength' => true]),
                    $form->field($info, 'okpo')->textInput(['maxlength' => true]),
                    $form->field($info, 'ogrn')->textInput(['maxlength' => true]),
                    $form->field($info, 'rs')->textInput(['maxlength' => true]),
                    $form->field($info, 'kors')->textInput(['maxlength' => true]),
                    $form->field($info, 'bik')->textInput(['maxlength' => true]),
                    $form->field($info, 'bank_name')->textInput(['maxlength' => true]),
                ];
                echo $model->getFormCard($attributes, 'Реквизиты', true);
                ?>
            </div>
            <div class="col-12">
                <div class="form-group mt10">
                    <?= Html::submitButton('Сохранить', ['class' => 'btn btn-success']) ?>
                </div>
            </div>
        </div>
    <?php ActiveForm::end(); ?>
</div>
