<?php

use yii\bootstrap5\ActiveForm;
use yii\bootstrap5\Html;

$this->title = 'Login';
?>

<div class="card shadow-sm" style="min-width: 350px; max-width: 400px; width: 100%;">
    <div class="card-header bg-primary text-white text-center">
        <h4 class="mb-0"><i class="bi bi-person-circle me-2"></i><?= Html::encode($this->title) ?></h4>
    </div>
    <div class="card-body">
        <p class="text-muted text-center">Informe suas credenciais</p>

        <?php $form = ActiveForm::begin(['id' => 'login-form']); ?>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                <?= Html::activeTextInput($model, 'username', [
                    'class' => 'form-control ' . ($model->hasErrors('username') ? 'is-invalid' : ''),
                    'placeholder' => 'E-mail',
                    'autofocus' => true
                ]) ?>
            </div>
            <?= Html::error($model, 'username', ['class' => 'invalid-feedback d-block']) ?>
        </div>

        <div class="mb-3">
            <div class="input-group">
                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                <?= Html::activePasswordInput($model, 'password', [
                    'class' => 'form-control ' . ($model->hasErrors('password') ? 'is-invalid' : ''),
                    'placeholder' => 'Senha',
                ]) ?>
            </div>
            <?= Html::error($model, 'password', ['class' => 'invalid-feedback d-block']) ?>
        </div>

        <?= $form->field($model, 'rememberMe')->checkbox([
            'template' => "<div class=\"form-check\">{input} {label}</div>\n{error}",
        ]) ?>

        <div class="d-grid">
            <?= Html::submitButton('<i class="bi bi-box-arrow-in-right me-1"></i> Entrar', [
                'class' => 'btn btn-primary btn-block',
                'name' => 'login-button'
            ]) ?>
        </div>

        <?php ActiveForm::end(); ?>
    </div>
    <div class="card-footer text-muted text-center small">
        &copy; <?= date('Y') ?> Basefy
    </div>
</div>