<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Usuario;
use common\models\Cliente;
use common\models\TicketTipo;
use common\models\TicketStatus;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="ticket-form">
    <?php $form = ActiveForm::begin([
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'usuario_id')->dropDownList(
                Usuario::find()->select(['nome', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione o usuário...')]
            ) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'cliente_id')->dropDownList(
                Cliente::find()->select(['nome_fantasia', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione o cliente...')]
            ) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'descricao')->textarea(['rows' => 4]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'tipo_id')->dropDownList(
                TicketTipo::find()->select(['nome', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione o tipo...')]
            ) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'status_id')->dropDownList(
                TicketStatus::find()->select(['nome', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione...')]
            ) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'prioridade')->dropDownList([
                'baixa' => Yii::t('app', 'Baixa'),
                'media' => Yii::t('app', 'Média'),
                'alta' => Yii::t('app', 'Alta'),
            ], ['prompt' => Yii::t('app', 'Selecione a prioridade...')]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'voto')->textInput(['type' => 'number']) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'data_resposta')->textInput(['type' => 'datetime-local']) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'data_cadastro')->textInput(['type' => 'datetime-local']) ?>
        </div>

        <div class="form-check form-switch mt-3 ms-3">
            <?= $form->field($model, 'publico', [
                'template' => '{input}{label}{error}',
                'options' => ['class' => 'form-check'],
            ])->checkbox([
                'class' => 'form-check-input',
                'role' => 'switch',
                'labelOptions' => ['class' => 'form-check-label ms-2'],
                'uncheck' => 0,
                'value' => 1,
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