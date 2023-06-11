<?php

use common\models\Client;
use kartik\widgets\FileInput;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\Order;
use kartik\editors\Summernote;

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
                        $form->field($model, 'email')->textInput(['maxlength' => true, 'type' => 'email']),
                        $form->field($model, 'price')->textInput(['maxlength' => true]),
                        $form->field($model, 'status_id')->dropDownList(Order::getStatuses(), ['prompt' => '[Не выбрано]']),
                        $form->field($model, 'client_id')->widget(Select2::className(), [
                            'options' => ['placeholder' => '[не выбран]', 'multiple' => true],
                            'showToggleAll' => false,
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                            'data' => Client::getList(),
                        ]),
                        $form->field($model, 'split_template')->textInput(['maxlength' => true, 'disabled' => true]),
                        $form->field($model, 'pressed_btn')->textInput(['maxlength' => true, 'disabled' => true]),
                        $form->field($model, 'utm_source')->textInput(['maxlength' => true, 'disabled' => true]),
                        $form->field($model, 'utm_campaign')->textInput(['maxlength' => true, 'disabled' => true]),
                        $form->field($model, 'utm_medium')->textInput(['maxlength' => true, 'disabled' => true]),
                        $form->field($model, 'utm_content')->textInput(['maxlength' => true, 'disabled' => true]),
                        $form->field($model, 'utm_term')->textInput(['maxlength' => true, 'disabled' => true]),
                        $form->field($model, 'comment')->textarea(['cols' => 3, 'rows' => 10]),
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
