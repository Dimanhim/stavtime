<?php

use common\models\Document;
use common\models\Order;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Office $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="office-form">
    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?php
            $attributes = [
                $form->field($model, 'name')->textInput(['maxlength' => true]),
                $form->field($model, 'number')->textInput(['maxlength' => true]),
                $form->field($model, 'document_id')->widget(Select2::className(), [
                    'options' => ['placeholder' => '[не выбран]'],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Document::getListOrder(),
                ]),
                $form->field($model, 'office_date')->widget(DatePicker::className(), []),
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
