<?php

use kartik\widgets\FileInput;
use yii\widgets\ActiveForm;
use yii\helpers\Html;

$this->title = 'Редактирование профиля';
$this->params['breadcrumbs'][] = 'Редактирование';

?>

<?php $form = ActiveForm::begin(['id' => 'form-profile']) ?>
<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Основная информация
            </div>
            <div class="card-body">
                <?= $form->field($model, 'name')->textInput(['placeholder' => "ФИО"]) ?>
                <?= $form->field($model, 'phone')->textInput(['placeholder' => "Телефон", 'class' => 'form-control phone']) ?>
                <?= $form->field($model, 'email')->textInput(['placeholder' => "E-mail", 'type' => 'email']) ?>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Аватар
            </div>
            <div class="card-body">
                <?php if (!$model->isNewRecord && $model->gallery) echo $model->gallery->getPreviewListHTML() ?>
                <?= $form->field($model, 'image_fields[]')->widget(FileInput::classname(), [
                    'options' => [
                        'accept' => 'image/*',
                        'multiple' => true
                    ],
                    'pluginOptions' => [
                        'browseLabel' => 'Выбрать',
                        'showPreview' => false,
                        'showUpload' => false,
                        'showRemove' => false,
                    ]
                ]) ?>
            </div>
        </div>
    </div>
    <div class="col-md-12">
        <?= Html::submitButton('Сохранить', ['class' => "btn btn-success"]) ?>
    </div>
</div>
<?php ActiveForm::end() ?>
