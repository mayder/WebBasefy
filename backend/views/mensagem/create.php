<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */

?>
<div class="mensagem-create container-fluid py-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-chat-dots me-1"></i> <?= Yii::t('app', 'Nova Mensagem') ?>
            </h5>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>