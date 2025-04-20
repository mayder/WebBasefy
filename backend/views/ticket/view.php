<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Ticket */

$isModal = Yii::$app->request->isAjax;
?>
<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-info-circle-fill me-1"></i> Detalhes
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'attributes' => [
                    'id',
                    [
                        'attribute' => 'usuario_id',
                        'value' => $model->usuario ? $model->usuario->nome : '(Não informado)',
                    ],
                    [
                        'attribute' => 'cliente_id',
                        'value' => $model->cliente ? $model->cliente->nome : '(Não informado)',
                    ],
                    'titulo',
                    'descricao:ntext',
                    [
                        'attribute' => 'tipo_id',
                        'value' => $model->tipo ? $model->tipo->nome : '(Não informado)',
                    ],
                    [
                        'attribute' => 'status_id',
                        'value' => $model->status ? $model->status->nome : '(Não informado)',
                    ],
                    'publico:boolean',
                    'prioridade',
                    'voto',
                    [
                        'attribute' => 'data_resposta',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                    ],
                    [
                        'attribute' => 'data_cadastro',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                    ],
                ],
            ]) ?>

            <?php if (!$isModal): ?>
            </div>
        </div>
    </div>
<?php endif; ?>