<?php

use yii\widgets\DetailView;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$isModal = Yii::$app->request->isAjax;
?>

<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-person-circle me-1"></i> Detalhes do Usuário
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-striped detail-view'],
                'attributes' => [
                    'nome',
                    'email:email',
                    [
                        'attribute' => 'status',
                        'format' => 'raw',
                        'value' => $model->status
                            ? '<span class="badge bg-success">Ativo</span>'
                            : '<span class="badge bg-secondary">Inativo</span>',
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

            <?php if (!$isModal): ?>
            </div>
        </div>
    </div>
<?php endif; ?>