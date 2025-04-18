<?php

use yii\helpers\Html;
use yii\widgets\DetailView;

/** @var yii\web\View $this */
/** @var common\models\Usuario $model */

$this->title = 'Usuário: ' . Html::encode($model->nome);
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Usuários'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $model->nome;
\yii\web\YiiAsset::register($this);
?>

<div class="usuario-view">

    <div class="card shadow-sm border-0 mb-4">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0"><i class="bi bi-person-fill me-2"></i> <?= Html::encode($this->title) ?></h5>
            <div>
                <?= Html::a('<i class="bi bi-pencil-square me-1"></i> Editar', ['update', 'id' => $model->id], ['class' => 'btn btn-outline-light btn-sm me-2']) ?>
                <?= Html::a('<i class="bi bi-trash me-1"></i> Excluir', ['delete', 'id' => $model->id], [
                    'class' => 'btn btn-outline-light btn-sm',
                    'data' => [
                        'confirm' => 'Tem certeza que deseja excluir este item?',
                        'method' => 'post',
                    ],
                ]) ?>
            </div>
        </div>

        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    'nome',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => $model->status
                            ? '<span class="badge bg-success"><i class="bi bi-check-circle me-1"></i> Ativo</span>'
                            : '<span class="badge bg-secondary"><i class="bi bi-x-circle me-1"></i> Inativo</span>',
                    ],
                    [
                        'attribute' => 'ultimo_acesso',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                    ],
                    [
                        'attribute' => 'data_cadastro',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>