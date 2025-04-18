<?php

use yii\bootstrap5\Html;
use yii\bootstrap5\ActiveForm;

/** @var yii\web\View $this */
/** @var \frontend\models\SignupForm $model */

$this->title = 'Criar Conta';
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="d-flex justify-content-center align-items-center py-5">
    <div class="card shadow-sm border-0" style="min-width: 340px; max-width: 400px; width: 100%;">
        <div class="card-header bg-success text-white text-center">
            <h5 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i> <?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body">
            <p class="text-muted text-center mb-4">Preencha os campos para criar sua conta</p>

            <?php $form = ActiveForm::begin(['id' => 'form-signup']); ?>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-person"></i></span>
                    <?= Html::activeTextInput($model, 'nome', [
                        'class' => 'form-control ' . ($model->hasErrors('nome') ? 'is-invalid' : ''),
                        'placeholder' => 'Nome de usuário',
                        'autofocus' => true,
                    ]) ?>
                </div>
                <?= Html::error($model, 'nome', ['class' => 'invalid-feedback d-block']) ?>
            </div>

            <div class="mb-3">
                <div class="input-group">
                    <span class="input-group-text"><i class="bi bi-envelope"></i></span>
                    <?= Html::activeTextInput($model, 'email', [
                        'class' => 'form-control ' . ($model->hasErrors('email') ? 'is-invalid' : ''),
                        'placeholder' => 'E-mail',
                    ]) ?>
                </div>
                <?= Html::error($model, 'email', ['class' => 'invalid-feedback d-block']) ?>
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

            <div class="d-grid">
                <?= Html::submitButton('<i class="bi bi-check-circle me-1"></i> Criar conta', [
                    'class' => 'btn btn-success btn-block',
                    'name' => 'signup-button',
                ]) ?>
            </div>

            <?php ActiveForm::end(); ?>
        </div>
        <div class="card-footer text-muted text-center small">
            &copy; <?= date('Y') ?> Basefy
        </div>
    </div>
</div>