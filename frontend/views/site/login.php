<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var \common\models\LoginForm $model */

$this->title = 'Login';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="d-flex justify-content-center align-items-center py-5">
    <div class="card shadow-sm border-0" style="min-width: 340px; max-width: 400px; width: 100%;">
        <div class="card-header bg-primary text-white text-center">
            <h5 class="mb-0"><i class="bi bi-box-arrow-in-right me-2"></i> <?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body">
            <p class="text-muted text-center mb-4">Informe seus dados para acessar</p>

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

            <div class="form-check mb-3">
                <?= Html::activeCheckbox($model, 'rememberMe', [
                    'class' => 'form-check-input',
                    'labelOptions' => ['class' => 'form-check-label'],
                ]) ?>
            </div>

            <div class="text-center small mb-3">
                <?= Html::a('Esqueci minha senha', ['site/request-password-reset']) ?><br>
                <?= Html::a('Reenviar verificação de e-mail', ['site/resend-verification-email']) ?>
            </div>

            <div class="d-grid">
                <?= Html::submitButton('<i class="bi bi-box-arrow-in-right me-1"></i> Entrar', [
                    'class' => 'btn btn-primary btn-block',
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="card-footer text-muted text-center small">
            &copy; <?= date('Y') ?> Basefy
        </div>
    </div>
</div>