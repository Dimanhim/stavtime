<?php

use yii\helpers\Html;

$this->title = 'Информация по заявке '.$model->order_name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = ['label' => $model->name, 'url' => ['view', 'id' => $model->id]];
$this->params['breadcrumbs'][] = 'Информация';

?>
<p>
    <?= Html::a('Добавить документ', ['document/create', 'order_id' => $model->id], ['class' => 'btn btn-primary']) ?>
    <?= Html::a('Перейти к заявке', ['order/view', 'id' => $model->id], ['class' => 'btn btn-warning']) ?>
</p>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Основная информация
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Изображение</th>
                        <td></td>
                    </tr>
                    <tr>
                        <th>Имя</th>
                        <td><?= $model->order_name ? $model->order_name : 'Б/н' ?></td>
                    </tr>
                    <tr>
                        <th>Клиент</th>
                        <td>
                            <?php
                                if($model->client) {
                                    echo Html::a($model->client->name, ['client/view', 'id' => $model->client->id], ['target' => '_blanc']);
                                }
                            ?>
                        </td>
                    </tr>
                    <tr>
                        <th>Телефон</th>
                        <td><?= $model->phone ?></td>
                    </tr>
                    <tr>
                        <th>E-mail</th>
                        <td><?= $model->email ?></td>
                    </tr>
                    <tr>
                        <th>Статус</th>
                        <td><?= $model->statusName ?></td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Документы
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Название</th>
                        <th>Скачать</th>
                    </tr>
                    <?php if($documents = $model->documents) : ?>
                        <?php foreach($documents as $document) : ?>
                            <tr>
                                <td>
                                    <?= $document->name ?>
                                </td>
                                <td>
                                    <?= $document->mainImageHtml ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="2">Документов не найдено</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Оплаты
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Название</th>
                        <th>Тип</th>
                        <th>Основание</th>
                        <th>Сумма</th>
                        <th>Дата</th>
                    </tr>
                    <?php if($payments = $model->payments) : ?>
                        <?php foreach($payments as $payment) : ?>
                            <tr>
                                <td><?= $payment->name ?></td>
                                <td><?= $payment->typeName ?></td>
                                <td><?= $payment->document ? $payment->document->name.' '.$payment->document->mainImageHtml : '' ?></td>
                                <td><?= $payment->price ?></td>
                                <td><?= date('d.m.Y', $payment->created_at) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Оплаты не проводились</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                Этапы работы
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Название</th>
                        <th>Выполнение</th>
                        <th>Документ</th>
                        <th>Дедлайн</th>
                        <th>Выполнить</th>
                    </tr>
                    <?php if($steps = $model->steps) : ?>
                        <?php foreach($steps as $step) : ?>
                        <?php $doneClass = !$step->done ? ' class="pale-red"' : '' ?>
                            <tr<?= $doneClass ?>>
                                <td><?= $step->name ?></td>
                                <td><?= $step->doneName ?></td>
                                <td><?= $step->mainImageHtml ?></td>
                                <td><?= $step->deadline ?></td>
                                <td><?= $step->done ? '<i class="bi bi-check-circle"></i>' : Html::a('<i class="bi bi-check2-square"></i>', ['step/done', 'id' => $step->id]) ?></td>
                            </tr>
                        <?php endforeach; ?>
                    <?php else : ?>
                        <tr>
                            <td colspan="5">Этапов не найдено</td>
                        </tr>
                    <?php endif; ?>
                </table>
            </div>
        </div>
    </div>
</div>
