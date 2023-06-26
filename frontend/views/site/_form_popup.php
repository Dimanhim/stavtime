<?php

use yii\widgets\ActiveForm;
use yii\helpers\Html;

?>


<div class="popup_window popup_form">
    <div class="remodal_bg"></div>
    <div class="package remodal_window">
        <button data-remodal-action="close" class="remodal-close" data-dismiss="modal" aria-label="Close"></button>
        <h3>Заказать лендинг <br><span>и получить мультилендинг в подарок!</span></h3>
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
        ]);
        ?>
            <?= $form->field($model, 'name', ['template' => "{input}"])->textInput(['placeholder' => "Имя", 'class' => 'form-name']) ?>
            <?= $form->field($model, 'phone', ['template' => "{input}"])->textInput(['placeholder' => "Телефон", 'class' => 'form-phone phone']) ?>
            <?= $form->field($model, 'email', ['template' => "{input}"])->textInput(['placeholder' => "e-mail", 'type' => 'email', 'class' => 'form-email']) ?>
            <?= $form->field($model, 'service_id', ['template' => "{input}"])->hiddenInput(['class' => 'form-service']) ?>
            <?= $form->field($model, 'pressed_btn', ['template' => "{input}"])->hiddenInput(['class' => 'form-btn']) ?>
        <p class="info-message"></p>
        <?= $form->field($model, 'utm', ['template' => "{input}"])->hiddenInput(['value' => $model->getUtms()]) ?>
        <?= Html::submitButton('Получить клиентов', ['class' => "button-slty", 'disabled' => true]) ?>
        <?php ActiveForm::end() ?>
        <p class="sec">
            <i></i>Ваши данные не будут переданы <br> третьим лицам
        <p style="text-aling: center; font-size: 10px">Нажимая на эту кнопку, Вы даете согласие на обработку своих
            персональных данных <a style="font-size: 10px;" href="/site/politika" target="blanc">Политика
                конфиденциальности</a></p>

        </p>
    </div>
</div>
