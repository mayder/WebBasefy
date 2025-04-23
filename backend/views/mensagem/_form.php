<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Usuario;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */
/* @var $form yii\widgets\ActiveForm */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="mensagem-form">
    <?php $form = ActiveForm::begin(['options' => ['autocomplete' => 'off']]); ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'tipo')->dropDownList([
                'email' => 'Email',
                'push' => 'Push',
                'sms' => 'SMS',
                'webhook' => 'Webhook',
                'whatsapp' => 'WhatsApp',
            ], ['prompt' => Yii::t('app', 'Selecione o tipo...')]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'usuario_id')->dropDownList(
                Usuario::find()->select(['nome', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione o usuário...')]
            ) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'conteudo')->textarea(['rows' => 4]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'status_envio')->dropDownList([
                'pendente' => 'Pendente',
                'enviado' => 'Enviado',
                'erro' => 'Erro',
            ], ['prompt' => Yii::t('app', 'Selecione o status...')]) ?>
        </div>

        <div class="col-md-3 mb-3">
            <?= $form->field($model, 'tentativa')->input('number') ?>
        </div>

        <div class="col-md-3 mb-3">
            <?= $form->field($model, 'max_tentativa')->input('number') ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'data_agendada')->input('datetime-local') ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'data_envio')->input('datetime-local') ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'erro')->textarea(['rows' => 3]) ?>
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