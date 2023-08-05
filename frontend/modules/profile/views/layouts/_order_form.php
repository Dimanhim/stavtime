<?php
use common\models\SessionOrder;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
?>

<?php $form = ActiveForm::begin(['id' => 'form-change-order', 'action' => '/profile/default/change-order', 'fieldConfig' => ['options' => ['tag' => false]]]) ?>

<?= $form->field($orderForm, 'order_id', ['template' => "{label}{input}"])->dropDownList(SessionOrder::userOrders(), ['prompt' => '[Заявка не выбрана]', 'class' => 'select-style change-order-o'])->label('Вы просматриваете заявку ') ?>
<?= Html::submitButton('Отправить', ['id' => 'change-order-btn', 'class' => 'btn btn-default', 'style' => 'display: none']) ?>

<?php ActiveForm::end() ?>
