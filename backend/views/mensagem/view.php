<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */

$isModal = Yii::$app->request->isAjax;
?>

<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-eye me-1"></i> <?= Yii::t('app', 'Detalhes da Mensagem') ?>
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-striped detail-view'],
                'attributes' => [
                    'id',
                    'tipo',
                    [
                        'attribute' => 'usuario_id',
                        'value' => $model->usuario->nome ?? null,
                        'label' => Yii::t('app', 'Usuário'),
                    ],
                    'titulo',
                    [
                        'attribute' => 'conteudo',
                        'format' => 'ntext',
                    ],
                    'status_envio',
                    'tentativa',
                    'max_tentativa',
                    [
                        'attribute' => 'data_agendada',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                    ],
                    [
                        'attribute' => 'data_envio',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                    ],
                    [
                        'attribute' => 'erro',
                        'format' => 'ntext',
                    ],
                    [
                        'attribute' => 'usuario_id_cad',
                        'value' => $model->usuarioCad->nome ?? null,
                        'label' => Yii::t('app', 'Cadastrado por'),
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