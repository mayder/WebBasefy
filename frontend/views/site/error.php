<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>

<div class="d-flex justify-content-center align-items-center py-5">
    <div class="card shadow-sm border-0 w-100" style="max-width: 600px;">
        <div class="card-header bg-danger text-white text-center">
            <h5 class="mb-0"><i class="bi bi-exclamation-triangle-fill me-2"></i> <?= Html::encode($this->title) ?></h5>
        </div>
        <div class="card-body text-center">
            <div class="alert alert-danger shadow-sm">
                <?= nl2br(Html::encode($message)) ?>
            </div>
            <p class="text-muted mb-1">O erro acima ocorreu enquanto o sistema processava sua solicitação.</p>
            <p class="text-muted">Caso o problema persista, entre em contato com o administrador.</p>
            <div class="mt-4">
                <?= Html::a('<i class="bi bi-house-door-fill me-1"></i> Voltar para o início', Yii::$app->homeUrl, ['class' => 'btn btn-outline-secondary']) ?>
            </div>
        </div>
        <div class="card-footer text-muted text-center small">
            &copy; <?= date('Y') ?> Basefy
        </div>
    </div>
</div>