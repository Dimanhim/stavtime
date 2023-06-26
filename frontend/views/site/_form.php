<?php
    use yii\widgets\ActiveForm;
    use yii\helpers\Html;
?>

<?php $form = ActiveForm::begin([
    'fieldConfig' => [
        'options' => [
            'tag' => false,
        ]
    ],
    'action' => '/site/send-form',
    'enableClientScript' => false,
    'options' => [
        'class' => 'order-form'
    ],
]) ?>
    <div class="container">
        <div class="row">
            <div class="col-md-3 col-sm-3">
                <?= $form->field($model, 'name', ['template' => "{input}\n{error}"])->textInput(['placeholder' => "Имя", 'class' => 'form-name']) ?>
            </div>
            <div class="col-md-3 col-sm-3">
                <?= $form->field($model, 'phone', ['template' => "{input}\n{error}"])->textInput(['placeholder' => "Телефон", 'class' => 'form-phone phone']) ?>
            </div>
            <div class="col-md-3 col-sm-3">
                <?= $form->field($model, 'email', ['template' => "{input}\n{error}"])->textInput(['placeholder' => "e-mail", 'type' => 'email', 'class' => 'form-email']) ?>
            </div>

            <?= $form->field($model, 'pressed_btn', ['template' => "{input}"])->hiddenInput(['value' => 'Нижняя форма', 'class' => 'form-btn']) ?>
            <?= $form->field($model, 'service_id', ['template' => "{input}"])->hiddenInput(['value' => '', 'class' => 'form-service']) ?>

            <div class="col-md-3 col-sm-3">
                <?= $form->field($model, 'utm', ['template' => "{input}"])->hiddenInput(['value' => $model->getUtms()]) ?>
                <?= Html::submitButton('Получить клиентов', ['class' => "button-slty", 'disabled' => true,]) ?>
            </div>
            <div class="col-md-12 col-sm-12">
                <p class="info-message"></p>
            </div>
        </div>
    </div>
<?php ActiveForm::end() ?>
