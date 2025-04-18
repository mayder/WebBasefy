<?php

/** @var yii\web\View $this */
/** @var string $name */
/** @var string $message */
/** @var Exception $exception */

use yii\helpers\Html;

$this->title = $name;
?>
<div class="container py-5">
    <div class="text-center">
        <h1 class="display-4 text-danger mb-3">
            <i class="bi bi-exclamation-triangle-fill me-2"></i> <?= Html::encode($this->title) ?>
        </h1>
        <p class="lead mb-4"><?= nl2br(Html::encode($message)) ?></p>

        <div class="alert alert-warning shadow-sm p-3 mx-auto" style="max-width: 600px;">
            <p class="mb-1">
                Ocorreu um erro ao processar sua solicitação.
            </p>
            <p class="mb-0">
                Por favor, tente novamente ou entre em contato com o administrador do sistema se o problema persistir.
            </p>
        </div>

        <a href="<?= Yii::$app->homeUrl ?>" class="btn btn-primary mt-4">
            <i class="bi bi-house-door-fill me-1"></i> Voltar para o início
        </a>
    </div>
</div>