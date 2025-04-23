<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NotificacaoSistema */

$this->title = Yii::t('app', 'Atualizar Notificação');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Notificações de Sistema'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid py-3 notificacao-sistema-update">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square me-1"></i> <?= Html::encode($this->title) ?>
            </h5>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>