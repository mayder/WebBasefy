<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Perfil */

$isModal = Yii::$app->request->isAjax;
?>

<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-person-gear me-1"></i> <?= Yii::t('app', 'Detalhes do Perfil') ?>
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-striped detail-view'],
                'attributes' => [
                    'nome',
                    'sigla',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => $model->status
                            ? '<span class="badge bg-success">' . Yii::t('app', 'Ativo') . '</span>'
                            : '<span class="badge bg-secondary">' . Yii::t('app', 'Inativo') . '</span>',
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