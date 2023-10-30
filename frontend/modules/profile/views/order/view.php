<?php

use frontend\modules\profile\Profile;
use yii\helpers\Html;
use yii\widgets\DetailView;
use common\models\Brief;
use yii\helpers\Url;

/** @var yii\web\View $this */
/** @var common\models\Client $model */

$this->title = 'Заявка: '.$model->name;
$this->params['breadcrumbs'][] = ['label' => $model->modelName, 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
\yii\web\YiiAsset::register($this);
?>
<div class="client-view">

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-1" data-toggle="tab" href="#main-tab" role="tab" aria-controls="main-tab" aria-selected="true">
                Основная информация
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-2" data-toggle="tab" href="#step-tab" role="tab" aria-controls="step-tab" aria-selected="false">
                Этапы работы
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-3" data-toggle="tab" href="#payment-tab" role="tab" aria-controls="payment-tab" aria-selected="false">
                Оплаты
            </a>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-4" data-toggle="tab" href="#document-tab" role="tab" aria-controls="document-tab" aria-selected="false">
                Документы
            </a>
            <?= Html::a('<i class="bi bi-plus-square-fill"></i>', ['document/create', 'order_id' => $model->id], ['class' => 'action-link pull-right']) ?>
        </li>
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-5" data-toggle="tab" href="#brief-tab" role="tab" aria-controls="brief-tab" aria-selected="false">
                Бриф
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">
        <!-- Основная информация -->
        <div class="tab-pane fade show active" id="main-tab" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="card-body card-body-o">
                    <?= DetailView::widget([
                        'model' => $model,
                        'attributes' => [
                            'order_name',
                            'name',
                            [
                                'attribute' => 'status_id',
                                'value' => function($data) {
                                    return $data->statusName;
                                }
                            ],
                            [
                                'attribute' => 'service_id',
                                'value' => function($data) {
                                    if($data->service) {
                                        return $data->service->name;
                                    }
                                }
                            ],
                            'price',
                            'phone',
                            'email:email',

                            [
                                'attribute' => 'is_active',
                                'value' => function($data) {
                                    return $data->active;
                                }
                            ],
                        ],
                    ]) ?>
                </div>
            </div>
        </div>

        <!-- Этапы работы -->
        <div class="tab-pane fade" id="step-tab" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Название</th>
                            <th>Выполнение</th>
                            <th>Документ</th>
                            <th>Дата</th>
                        </tr>
                        <?php if($steps = $model->orderSteps) : ?>
                            <?php foreach($steps as $step) : ?>
                                <?php $doneClass = !$step->done ? ' class="pale-red"' : '' ?>
                                <tr<?= $doneClass ?>>
                                    <td><?= Html::a($step->name, ['step/view', 'id' => $step->id])  ?></td>
                                    <td><?= $step->doneName ?></td>
                                    <td><?= $step->mainImageHtml ?></td>
                                    <td><?= $step->deadline ?></td>
                                    <td>
                                        <?= Html::a('<i class="bi bi-eye"></i>', ['step/view', 'id' => $step->id]) ?>
                                    </td>
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

        <!-- Оплаты -->
        <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Название</th>
                            <th>Тип</th>
                            <th>Основание</th>
                            <th>Сумма</th>
                            <th>Дата</th>
                        </tr>
                        <?php if($payments = $model->orderPayments) : ?>
                            <?php foreach($payments as $payment) : ?>
                                <tr>
                                    <td><?= Html::a($payment->name, ['payment/view', 'id' => $payment->id])  ?></td>
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

        <!-- Документы -->
        <div class="tab-pane fade" id="document-tab" role="tabpanel" aria-labelledby="document-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Название</th>
                            <th>Скачать</th>
                        </tr>
                        <?php if($documents = $model->orderDocuments) : ?>
                            <?php foreach($documents as $document) : ?>
                                <tr>
                                    <td>
                                        <?= Html::a($document->name, ['document/view', 'id' => $document->id])  ?>
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
        <div class="tab-pane fade" id="brief-tab" role="tabpanel" aria-labelledby="brief-tab">
            <div class="card">
                <div class="card-body">
                    <table class="table table-striped">
                        <tr>
                            <th>Вопрос</th>
                            <th>Ответ</th>
                        </tr>
                        <?php if($briefs = Brief::getBriefsList()) : ?>
                            <?php foreach($briefs as $brief) : ?>
                                <tr>
                                    <td>
                                        <?= $brief->name ?>
                                    </td>
                                    <td>
                                        <?= $brief->getUserAnswer($model->id) ?>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                        <?php else : ?>
                            <tr>
                                <td colspan="2">Бриф не заполнен</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
