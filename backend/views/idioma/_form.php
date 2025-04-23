<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Idioma */
/* @var $form yii\widgets\ActiveForm */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="idioma-form">
    <?php $form = ActiveForm::begin([
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">
        <!-- Campo: Nome -->
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>

        <!-- Campo: Sigla -->
        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'sigla')->textInput(['maxlength' => true]) ?>
        </div>

        <!-- Campo: Status com switch -->
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'status', [
                'template' => '{input}{label}{error}',
                'options' => ['class' => 'form-check form-switch'],
            ])->checkbox([
                'class' => 'form-check-input',
                'role'  => 'switch',
                'labelOptions' => ['class' => 'form-check-label ms-2'],
                'uncheck' => 0,
                'value'   => 1,
            ])->label(Yii::t('app', 'Ativo')) ?>
        </div>

        <!-- Campo: Padrão com switch -->
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'padrao', [
                'template' => '{input}{label}{error}',
                'options' => ['class' => 'form-check form-switch'],
            ])->checkbox([
                'class' => 'form-check-input',
                'role'  => 'switch',
                'labelOptions' => ['class' => 'form-check-label ms-2'],
                'uncheck' => 0,
                'value'   => 1,
            ])->label(Yii::t('app', 'Padrão')) ?>
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