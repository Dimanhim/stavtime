<?php

use yii\helpers\Html;
use common\models\Order;
use yii\helpers\Url;

//$this->title = (Yii::$app->user->identity->name ? Yii::$app->user->identity->name .' - ' : ''). 'Личный кабинет ';
$this->title = 'Инструкция по работе с личным кабинетом';
$this->params['breadcrumbs'] = [['label' => $this->title]];
$orderModel = new Order();
?>
<div class="container-fluid profile-main">
    <ul class="nav nav-tabs" id="myTab" role="tablist">

        <!-- Заявки TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link active" id="tab-1" data-toggle="tab" href="#main-tab" role="tab" aria-controls="main-tab" aria-selected="true">
                Заявки
            </a>
        </li>

        <!-- Этапы TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-2" data-toggle="tab" href="#step-tab" role="tab" aria-controls="step-tab" aria-selected="false">
                Этапы работы
            </a>
        </li>

        <!-- Оплаты TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-3" data-toggle="tab" href="#payment-tab" role="tab" aria-controls="payment-tab" aria-selected="false">
                Оплаты
            </a>
        </li>

        <!-- Документы TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-4" data-toggle="tab" href="#document-tab" role="tab" aria-controls="document-tab" aria-selected="false">
                Документы
            </a>
        </li>

        <!-- Бриф TAB -->
        <li class="nav-item" role="presentation">
            <a class="nav-link" id="tab-5" data-toggle="tab" href="#brief-tab" role="tab" aria-controls="brief-tab" aria-selected="false">
                Бриф
            </a>
        </li>
    </ul>

    <div class="tab-content" id="myTabContent">

        <!-- Заявки -->
        <div class="tab-pane fade show active" id="main-tab" role="tabpanel" aria-labelledby="home-tab">
            <div class="card">
                <div class="card-body">
                    <p>
                        Уважаемый(ая) <?= Yii::$app->user->identity->name ?>!
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        На этой странице мы расскажем как пользоваться личным кабинетом на примере клиента с условным именем <b>"Тестовое имя"</b> и на примере четырех заявок <b>"Продажа услуг"</b>
                        <br>
                        <span class="profile-annotation">Все изображения на данной странице можно увеличить, кликнув на них.</span>
                    </p>
                    <p>
                        <a href="/images/profile/1.jpg" data-fancybox="gallery">
                            <img src="/images/profile/1.jpg" alt="">
                        </a>
                        <a href="/images/profile/2.jpg" data-fancybox="gallery">
                            <img src="/images/profile/2.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Все ваши заявки можно посмотреть <a href="<?= Url::to(['order/index']) ?>">здесь</a>
                    </p>
                    <p>
                        <a href="/images/profile/3.jpg" data-fancybox="gallery" style="margin-left: 20px;">
                            <img src="/images/profile/3.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        <b>"Активная заявка"</b> - если у Вас более одной заявки на услуги нашей компании, это заявка, которую Вы просмотриваете в данный момент. Вся информация в личном кабинете именно по ней.
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Выбрать активную заявку можно в левом меню:
                    </p>
                    <p>
                        <a href="/images/profile/4.jpg" data-fancybox="gallery" style="margin-left: 20px;">
                            <img src="/images/profile/4.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        <span><b><i>После выбора активной заявки, она сохраняется и при переходе по страницам личного кабинета, будет показываться информация только по выбранной активной заявке.</i></b></span>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Всю информацию по активной заявке (в данный момент) можно получить по <a href="<?= Url::to(['order/view', 'id' => Yii::$app->params['order_id']]) ?>"> ссылке</a> в левом меню:
                    </p>
                    <p>
                        <a href="/images/profile/5.jpg" data-fancybox="gallery" style="margin-left: 20px;">
                            <img src="/images/profile/5.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Узнать какая заявка активна в данный момент можно здесь:
                    </p>
                    <p>
                        <a href="/images/profile/6.jpg" data-fancybox="gallery" style="margin-left: 20px;">
                            <img src="/images/profile/6.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Все Ваши заявки в нашей компании (<?= Yii::$app->params['orders_count'] ?>):
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
                </div>
            </div>
        </div>

        <!-- Этапы работы -->
        <div class="tab-pane fade" id="step-tab" role="tabpanel" aria-labelledby="profile-tab">
            <div class="card">
                <div class="card-body">
                    <p>
                        Для Вашего удобства и прозрачности работ, менеджер разбивает всю работу на <a href="<?= Url::to(['order/view', 'id' => Yii::$app->params['order_id'], '#' => 'step-tab']) ?>">этапы работы</a>.
                    </p>
                    <p>
                        <a href="/images/profile/8.jpg" data-fancybox="gallery">
                            <img src="/images/profile/8.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Невыполненные этапы работы в таблице подсвечиваются красным цветом
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        На каждый этап работ Вы можете кликнуть и посмотреть (скачать) результат:
                    </p>
                    <p>
                        <a href="/images/profile/9.jpg" data-fancybox="gallery">
                            <img src="/images/profile/9.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Ваши этапы работы по проекту:
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
                </div>
            </div>
        </div>

        <!-- Оплаты -->
        <div class="tab-pane fade" id="payment-tab" role="tabpanel" aria-labelledby="contact-tab">
            <div class="card">
                <div class="card-body">
                    <p>
                        Все оплаты, которые Вы проводили по проекту, отображаются в подразделе <a href="<?= Url::to(['order/view', 'id' => Yii::$app->params['order_id'], '#' => 'payment-tab']) ?>">оплаты</a> активной заявки.
                    </p>
                    <p>
                        <a href="/images/profile/10.jpg" data-fancybox="gallery">
                            <img src="/images/profile/10.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Ознакомиться с деталями, а также с документами по оплате, можно кликнув на ее название.
                    </p>
                    <p>
                        <a href="/images/profile/11.jpg" data-fancybox="gallery">
                            <img src="/images/profile/11.jpg" alt="">
                        </a>
                        <a href="/images/profile/12.jpg" data-fancybox="gallery">
                            <img src="/images/profile/12.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Ваши оплаты по проекту:
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
                </div>
            </div>
        </div>

        <!-- Документы -->
        <div class="tab-pane fade" id="document-tab" role="tabpanel" aria-labelledby="document-tab">
            <div class="card">
                <div class="card-body">
                    <p>
                        Все имеющиеся документы по проекту можно посмотреть <a href="<?= Url::to(['order/view', 'id' => Yii::$app->params['order_id'], '#' => 'document-tab']) ?>">здесь</a>
                    </p>
                    <p>
                        <a href="/images/profile/10.jpg" data-fancybox="gallery">
                            <img src="/images/profile/10.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Ознакомиться с деталями документа, а также скачать его, можно кликнув на его название.
                    </p>
                    <p>
                        <a href="/images/profile/14.jpg" data-fancybox="gallery">
                            <img src="/images/profile/14.jpg" alt="">
                        </a>
                        <a href="/images/profile/15.jpg" data-fancybox="gallery">
                            <img src="/images/profile/15.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Также вы можете самостоятельно загрузить нужный документ в личный кабинет. Это может быть, к примеру, бриф на разработку, карточка организации, презентация или любые другие материалы.
                    </p>
                    <p>
                        Чтобы создать и загрузить документ, кликните на иконку плюса
                    </p>
                    <p>
                        <a href="/images/profile/18.jpg" data-fancybox="gallery">
                            <img src="/images/profile/18.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Дайте название документу, при необходимости поясните - заполните поля "Краткое описание" и "Описание"
                    </p>
                    <p>
                        <a href="/images/profile/20.jpg" data-fancybox="gallery">
                            <img src="/images/profile/20.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Перетащите документы в поле для загрузки, либо воспользуйтесь кнопкой "Выбрать" для выбора документов на компьютере.
                    </p>
                    <p>
                        Если Вы загружаете сразу несколько документов, перетаскивайте в поле сразу все. Если Вы пользуетесь выбором документов на компьютере, зажимайте кнопку Ctrl и с ее помощью выбирайте несколько документов.
                    </p>
                    <p>
                        <a href="/images/profile/21.jpg" data-fancybox="gallery">
                            <img src="/images/profile/21.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Затем сохраните документы, кликнув на кнопку "Upload", либо зеленую кнопку "Сохранить" внизу экрана.
                    </p>
                    <p>
                        <a href="/images/profile/22.jpg" data-fancybox="gallery">
                            <img src="/images/profile/22.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Загруженные документы станут доступны Вам и администратору в активной заявке
                    </p>
                    <p>
                        <a href="/images/profile/23.jpg" data-fancybox="gallery">
                            <img src="/images/profile/23.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Ваши документы по проекту:
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
            </div>
        </div>

        <!-- Бриф -->
        <div class="tab-pane fade" id="brief-tab" role="tabpanel" aria-labelledby="brief-tab">
            <div class="card">
                <div class="card-body">
                    <p>
                        Для того, чтобы мы могли ознакомиться со спецификой Вашего бизнеса и подойти к разработке сайта не поверхностно, а глубоко, перед началом работ по проекту, Вам предлагается заполнить бриф на создание сайта, прямо в личном кабинете.
                    </p>
                    <p>
                        <a href="/images/profile/16.jpg" data-fancybox="gallery">
                            <img src="/images/profile/16.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Статус заполнения брифа подсвечивается на кнопке.
                    </p>
                    <p>
                        <a href="/images/profile/16.jpg" data-fancybox="gallery">
                            <img src="/images/profile/16.jpg" alt="">
                        </a>
                        <a href="/images/profile/25.jpg" data-fancybox="gallery">
                            <img src="/images/profile/25.jpg" alt="">
                        </a>
                        <a href="/images/profile/24.jpg" data-fancybox="gallery">
                            <img src="/images/profile/24.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Если у Вас уже есть заполненный бриф, в формате, к примеру, текстового документа, вы можете загрузить его в разделе "Документы" активной заявки, кликнув на кнопку плюс
                    </p>
                    <p>
                        <a href="/images/profile/18.jpg" data-fancybox="gallery">
                            <img src="/images/profile/18.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        И сохранить его, кликнув на кнопку "Upload", либо зеленую кнопку "Сохранить" внизу экрана.
                    </p>
                    <p>
                        <a href="/images/profile/19.jpg" data-fancybox="gallery">
                            <img src="/images/profile/19.jpg" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Подробная инструкция по загрузке документов в личный кабинет находится в настоящем разделе на вкладке "Документы"
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Пример заполнения брифа:
                    </p>
                    <p>
                        <a href="/images/profile/brief.png" data-fancybox="gallery">
                            <img src="/images/profile/brief.png" alt="">
                        </a>
                    </p>
                    <p class="profile-separator"></p>
                    <p>
                        Ссылка на Ваш бриф на разработку сайта
                    </p>
                    <p>
                        <?= Html::a('Бриф', ['brief/index']) ?>
                    </p>
                </div>
            </div>
        </div>

    </div>
</div>
