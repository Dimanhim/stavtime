<?php

use common\models\Order;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\date\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Step $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="step-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?php
            $attributes = [
                $form->field($model, 'order_id')->widget(Select2::className(), [
                    'options' => ['placeholder' => '[не выбран]'],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Order::getList(),
                ]),
                $form->field($model, 'name')->textInput(['maxlength' => true]),
                $form->field($model, 'description')->textarea(['cols' => 3, 'rows' => 10]),
                $form->field($model, 'short_description')->textarea(['cols' => 3, 'rows' => 10]),
                $form->field($model, 'done')->dropDownList([0 => 'Нет', 1 => 'Да'], ['prompt' => '[Не выбрано]']),
                $form->field($model, 'deadline')->widget(DatePicker::className(), [
                    //'format' => 'dd.mm.yyy'
                ]),
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
