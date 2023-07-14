<?php
/* @var $content string */

use common\widgets\Alert;
use yii\bootstrap4\Breadcrumbs;
use yii\helpers\Html;
use yii\widgets\ActiveForm;
use common\models\SessionOrder;

?>
<div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <?= Alert::widget() ?>
                <div class="col-sm-3">
                    <h1 class="m-0">
                        <?php
                        if (!is_null($this->title)) {
                            echo \yii\helpers\Html::encode($this->title);
                        } else {
                            echo \yii\helpers\Inflector::camelize($this->context->id);
                        }
                        ?>
                    </h1>
                </div><!-- /.col -->
                <div class="col-md-4">
                    <?php $form = ActiveForm::begin(['id' => 'form-change-order', 'action' => '/profile/default/change-order', 'fieldConfig' => ['options' => ['tag' => false]]]) ?>
                    <?= $form->field($orderForm, 'order_id', ['template' => "{label}{input}"])->dropDownList(SessionOrder::userOrders(), ['prompt' => '[Заявка не выбрана]', 'class' => 'select-style change-order-o'])->label('Вы просматриваете заявку ') ?>
                    <?= Html::submitButton('Отправить', ['id' => 'change-order-btn', 'class' => 'btn btn-default', 'style' => 'display: none']) ?>
                    <?php ActiveForm::end() ?>
                </div>
                <div class="col-sm-5">
                    <?php
                    echo Breadcrumbs::widget([
                        'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
                        'homeLink' => ['label' => 'Личный кабинет', 'url' => '/profile'],
                        'options' => [
                            'class' => 'breadcrumb float-sm-right'
                        ]
                    ]);
                    ?>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
        <?= $content ?><!-- /.container-fluid -->
    </div>
    <!-- /.content -->
</div>
