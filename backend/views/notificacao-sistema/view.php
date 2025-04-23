<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\NotificacaoSistema */

$isModal = Yii::$app->request->isAjax;
?>

<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-bell-fill me-1"></i> <?= Yii::t('app', 'Detalhes da Notificação') ?>
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
                    'titulo',
                    [
                        'attribute' => 'conteudo',
                        'format' => 'ntext',
                    ],
                    [
                        'attribute' => 'tipo',
                        'label' => Yii::t('app', 'Tipo'),
                    ],
                    [
                        'attribute' => 'link',
                        'format' => 'ntext',
                        'label' => Yii::t('app', 'Link'),
                    ],
                    [
                        'attribute' => 'lida',
                        'format' => 'boolean',
                        'label' => Yii::t('app', 'Lida'),
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