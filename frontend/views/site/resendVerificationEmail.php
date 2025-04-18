<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var \frontend\models\ResendVerificationEmailForm $model */

$this->title = 'Reenviar Verificação de E-mail';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="d-flex justify-content-center align-items-center py-5">
    <div class="card shadow-sm border-0" style="min-width: 340px; max-width: 400px; width: 100%;">
        <div class="card-header bg-warning text-white text-center">
            <h5 class="mb-0"><i class="bi bi-envelope-arrow-up-fill me-2"></i> <?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body">
            <p class="text-muted text-center mb-4">Informe seu e-mail para receber um novo link de verificação</p>

            <?php $form = ActiveForm::begin(['id' => 'resend-verification-email-form']); ?>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope-fill"></i></span>
                    <?= Html::activeTextInput($model, 'email', [
                        'class' => 'form-control ' . ($model->hasErrors('email') ? 'is-invalid' : ''),
                        'placeholder' => 'E-mail',
                        'autofocus' => true,
                    ]) ?>
                </div>
                <?= Html::error($model, 'email', ['class' => 'invalid-feedback d-block']) ?>
            </div>

            <div class="d-grid">
                <?= Html::submitButton('<i class="bi bi-send-check me-1"></i> Enviar Link', ['class' => 'btn btn-warning text-white']) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="card-footer text-muted text-center small">
            &copy; <?= date('Y') ?> Basefy
        </div>
    </div>
</div>