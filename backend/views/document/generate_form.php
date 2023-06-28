<?php

use common\models\Order;
use kartik\widgets\Select2;
use yii\widgets\ActiveForm;
use yii\helpers\Html;
use backend\components\Generator;

$this->title = 'Генерация документа';

?>

<div class="generator-form">
    <div class="row">
        <div class="col-6 offset-3">
            <div class="card">
                <div class="card-header">
                    <?= Html::encode($this->title) ?>
                </div>
                <div class="card-body">
                    <?php $form = ActiveForm::begin(['id' => 'generate-document']) ?>
                    <?= $form->field($model, 'type_id')->dropDownList(Generator::getTypes(), ['prompt' => '[Не выбрано]']) ?>
                    <?= $form->field($model, 'order_id')->widget(Select2::className(), [
                            'options' => ['placeholder' => '[не выбран]'],
                            'showToggleAll' => false,
                            'pluginOptions' => [
                                'allowClear' => true,
                            ],
                            'data' => Order::getList(),
                        ]) ?>
                    <?= Html::submitButton('Сгенерировать', ['class' => "btn btn-success"]) ?>
                    <?php ActiveForm::end() ?>
                </div>
            </div>
        </div>
    </div>
</div>
