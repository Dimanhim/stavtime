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
    <div class="col-6">
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
    <div class="col-6">
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
                    <tr>
                        <td>
                            Договор
                        </td>
                        <td>
                            <?= Html::a('<i class="bi bi-file-earmark-pdf"></i>', ['order/document', 'id' => '1']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Договор 2
                        </td>
                        <td>
                            <?= Html::a('<i class="bi bi-file-earmark-pdf"></i>', ['order/document', 'id' => '1']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Счет на предоплату
                        </td>
                        <td>
                            <?= Html::a('<i class="bi bi-file-earmark-pdf"></i>', ['order/document', 'id' => '1']) ?>
                        </td>
                    </tr>
                    <tr>
                        <td>
                            Акт выполненных работ
                        </td>
                        <td>
                            <?= Html::a('<i class="bi bi-file-earmark-pdf"></i>', ['order/document', 'id' => '1']) ?>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
    <div class="col-6">
        <div class="card">
            <div class="card-header">
                Оплаты
            </div>
            <div class="card-body">
                <table class="table table-striped">
                    <tr>
                        <th>Название</th>
                        <th>Основание</th>
                        <th>Сумма</th>
                        <th>Дата</th>
                    </tr>
                    <tr>
                        <td>Предоплата</td>
                        <td>Счет на предоплату <?= Html::a('<i class="bi bi-file-earmark-pdf"></i>', ['order/document', 'id' => '1']) ?></td>
                        <td>5000</td>
                        <td>21.06.2023</td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</div>
