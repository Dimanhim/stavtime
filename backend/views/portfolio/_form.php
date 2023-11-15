<?php

use common\models\Tag;
use common\models\Service;
use common\models\Order;
use kartik\widgets\Select2;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use kartik\widgets\DatePicker;

/** @var yii\web\View $this */
/** @var common\models\Portfolio $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="portfolio-form">

    <?php $form = ActiveForm::begin(); ?>
    <div class="row">
        <div class="col-6">
            <?php
            $attributes = [
                $form->field($model, 'name')->textInput(['maxlength' => true]),
                $form->field($model, 'price')->textInput(['maxlength' => true]),
                $form->field($model, 'price_lead')->textInput(['maxlength' => true]),
                $form->field($model, 'conversion')->textInput(['maxlength' => true]),
                $form->field($model, 'link')->textInput(['maxlength' => true]),
                $form->field($model, 'description')->textarea(['cols' => 3, 'rows' => 10]),
                $form->field($model, 'comment')->textarea(['cols' => 3, 'rows' => 10]),
                $form->field($model, 'created_date')->widget(DatePicker::className(), []),
                $form->field($model, 'portfolio_services')->widget(Select2::className(), [
                    'options' => ['placeholder' => '[не выбраны]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Service::getList(),
                ]),
                $form->field($model, 'portfolio_tags')->widget(Select2::className(), [
                    'options' => ['placeholder' => '[не выбраны]', 'multiple' => true],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Tag::getList(),
                ]),
                $form->field($model, 'order_id')->widget(Select2::className(), [
                    'options' => ['placeholder' => '[не выбран]'],
                    'showToggleAll' => false,
                    'pluginOptions' => [
                        'allowClear' => true,
                    ],
                    'data' => Order::getListName(),
                ]),
                $form->field($model, 'is_private')->checkbox(),
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
