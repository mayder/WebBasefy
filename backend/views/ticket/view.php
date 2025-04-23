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
                    <i class="bi bi-ticket-detailed me-1"></i> <?= Yii::t('app', 'Detalhes do Ticket') ?>
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-striped detail-view'],
                'attributes' => [
                    [
                        'attribute' => 'usuario_id',
                        'value' => $model->usuario->nome ?? null,
                        'label' => Yii::t('app', 'Usuário'),
                    ],
                    [
                        'attribute' => 'cliente_id',
                        'value' => $model->cliente->nome_fantasia ?? null,
                        'label' => Yii::t('app', 'Cliente'),
                    ],
                    'titulo',
                    [
                        'attribute' => 'descricao',
                        'format' => 'ntext',
                    ],
                    [
                        'attribute' => 'tipo_id',
                        'value' => $model->tipo->nome ?? null,
                        'label' => Yii::t('app', 'Tipo'),
                    ],
                    [
                        'attribute' => 'status_id',
                        'value' => $model->status->nome ?? null,
                        'label' => Yii::t('app', 'Status'),
                    ],
                    [
                        'attribute' => 'publico',
                        'format' => 'boolean',
                        'label' => Yii::t('app', 'Público'),
                    ],
                    [
                        'attribute' => 'prioridade',
                        'label' => Yii::t('app', 'Prioridade'),
                    ],
                    [
                        'attribute' => 'voto',
                        'format' => 'raw',
                    ],
                    [
                        'attribute' => 'data_resposta',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                        'label' => Yii::t('app', 'Data da Resposta'),
                    ],
                    [
                        'attribute' => 'data_cadastro',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                        'label' => Yii::t('app', 'Data de Cadastro'),
                    ],
                ],
            ]) ?>

            <?php if (!$isModal): ?>
            </div>
        </div>
    </div>
<?php endif; ?>