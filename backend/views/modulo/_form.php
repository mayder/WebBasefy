<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Modulo */
/* @var $form yii\widgets\ActiveForm */

$isAjax = Yii::$app->request->isAjax;

// Lista de ícones do Bootstrap Icons que você pode personalizar/expandir
$icones = [
    'bi-house' => 'Casa',
    'bi-gear' => 'Engrenagem',
    'bi-people' => 'Usuários',
    'bi-person' => 'Pessoa',
    'bi-list' => 'Lista',
    'bi-check-circle' => 'Check',
    'bi-x-circle' => 'X',
    'bi-pencil' => 'Editar',
    'bi-trash' => 'Lixeira',
    'bi-eye' => 'Visualizar',
    'bi-box-arrow-right' => 'Sair',
    'bi-lock' => 'Cadeado',
    'bi-sliders' => 'Ajustes',
    'bi-bar-chart' => 'Gráfico',
];

?>

<div class="modulo-form">
    <?php $form = ActiveForm::begin([
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'icone')->dropDownList(
                $icones,
                [
                    'class' => 'form-select selectpicker',
                    'data-live-search' => 'true',
                    'encode' => false,
                    'options' => array_map(fn($icon) => ['data-content' => "<i class='bi $icon'></i> $icon"], array_keys($icones)),
                    'prompt' => Yii::t('app', 'Selecione um ícone...')
                ]
            ) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'ordem')->textInput(['type' => 'number']) ?>
        </div>

        <div class="col-md-6 mt-3">
            <?= $form->field($model, 'status', [
                'template' => '{input}{label}{error}',
                'options' => ['class' => 'form-check form-switch'],
            ])->checkbox([
                'class' => 'form-check-input',
                'role' => 'switch',
                'labelOptions' => ['class' => 'form-check-label ms-2'],
                'uncheck' => 0,
                'value' => 1
            ]) ?>
        </div>
    </div>

    <?php if (!$isAjax): ?>
        <div class="form-group mt-3 text-end">
            <?= Html::submitButton(
                $model->isNewRecord
                    ? '<i class="bi bi-check-circle me-1"></i> ' . Yii::t('app', 'Criar')
                    : '<i class="bi bi-pencil-square me-1"></i> ' . Yii::t('app', 'Atualizar'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>