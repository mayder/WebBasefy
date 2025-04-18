<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Usuario $model */

$this->title = Yii::t('app', 'Cadastrar usuário');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuarios'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="usuario-create">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-light d-flex justify-content-between align-items-center">
            <h5 class="mb-0 text-primary">
                <i class="bi bi-plus-circle me-2"></i> <?= Html::encode($this->title) ?>
            </h5>
            <?= Html::a('<i class="bi bi-arrow-left-circle me-1"></i> Voltar', ['index'], ['class' => 'btn btn-outline-secondary btn-sm']) ?>
        </div>

        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>

</div>