<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var \frontend\models\ResetPasswordForm $model */

$this->title = 'Redefinir Senha';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="d-flex justify-content-center align-items-center py-5">
    <div class="card shadow-sm border-0" style="min-width: 340px; max-width: 400px; width: 100%;">
        <div class="card-header bg-danger text-white text-center">
            <h5 class="mb-0"><i class="bi bi-lock-fill me-2"></i> <?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body">
            <p class="text-muted text-center mb-4">Escolha sua nova senha abaixo</p>

            <?php $form = ActiveForm::begin(['id' => 'reset-password-form']); ?>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-shield-lock"></i></span>
                    <?= Html::activePasswordInput($model, 'password', [
                        'class' => 'form-control ' . ($model->hasErrors('password') ? 'is-invalid' : ''),
                        'placeholder' => 'Nova Senha',
                        'autofocus' => true,
                    ]) ?>
                </div>
                <?= Html::error($model, 'password', ['class' => 'invalid-feedback d-block']) ?>
            </div>

            <div class="d-grid">
                <?= Html::submitButton('<i class="bi bi-check-circle me-1"></i> Salvar Nova Senha', [
                    'class' => 'btn btn-danger'
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="card-footer text-muted text-center small">
            &copy; <?= date('Y') ?> Basefy
        </div>
    </div>
</div>