<?php

use yii\helpers\Html;
use common\models\Order;

$this->title = (Yii::$app->user->identity->name ? Yii::$app->user->identity->name .' - ' : ''). 'Личный кабинет ';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$orderModel = new Order();
?>
<div class="container-fluid">
    <h2>Инструкция по работе с личным кабинетом</h2>

    <p>
        Уважаемый(ая) <?= Yii::$app->user->identity->name ?>!
    </p>
    <p>
        На этой странице мы расскажем как пользоваться личным кабинетом
    </p>
    <p>
        Ваши заявки в нашей компании (<?= Yii::$app->params['orders_count'] ?>):
    </p>
    <?php if($orders = Order::getOrders()) : ?>
    <ul>
        <?php foreach($orders as $order) : ?>
            <?php $active = ($order->id == Yii::$app->params['order_id']) ? ' (активная)' : '' ?>
            <li><?= Html::a($order->name.' ('.$order->price.')', ['order/view', 'id' => $order->id]).$active  ?></li>
        <?php endforeach; ?>
    </ul>
    <?php else : ?>
        <p><b>Заявок не найдено</b></p>
    <?php endif; ?>
    <p>
        Заявка, которую сейчас Вы просматриваете <?= Html::a('просмотреть', ['order/view', 'id' => Yii::$app->params['order_id']]) ?>
    </p>
    <p>
        Этапы работы по заявке:
    </p>
    <?php if($steps = $orderModel->getOrderSteps()) : ?>
        <ul>
            <?php foreach($steps as $step) : ?>
                <li><?= Html::a($step->name, ['step/view', 'id' => $step->id]) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p style="margin-left: 20px;">
            <b>Этапов работы не найдено</b>
        </p>
    <?php endif; ?>

    <p>
        Оплаты по заявке:
    </p>
    <?php if($payments = $orderModel->getOrderPayments()) : ?>
        <ul>
            <?php foreach($payments as $payment) : ?>
                <li><?= Html::a($payment->name, ['payment/view', 'id' => $step->id]) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p style="margin-left: 20px;">
            <b>Оплат не найдено</b>
        </p>
    <?php endif; ?>

    <p>
        Документы по заявке:
    </p>
    <?php if($documents = $orderModel->getOrderDocuments()) : ?>
        <ul>
            <?php foreach($documents as $document) : ?>
                <li><?= Html::a($document->name, ['document/view', 'id' => $step->id]) ?></li>
            <?php endforeach; ?>
        </ul>
    <?php else : ?>
        <p style="margin-left: 20px;">
            <b>Документов не найдено</b>
        </p>
    <?php endif; ?>

</div>
