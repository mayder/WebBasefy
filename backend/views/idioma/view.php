<?php

use yii\widgets\DetailView;
use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Idioma */
?>

<div class="idioma-view container-fluid py-2">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
            <h5 class="mb-0">
                <i class="bi bi-translate me-2"></i> <?= Html::encode($model->nome) ?>
            </h5>
        </div>
        <div class="card-body">
            <?= DetailView::widget([
                'model' => $model,
                'options' => ['class' => 'table table-bordered table-striped'],
                'attributes' => [
                    'id',
                    'nome',
                    'sigla',
                    [
                        'attribute' => 'status',
                        'format' => 'boolean',
                        'label' => Yii::t('app', 'Ativo'),
                    ],
                    [
                        'attribute' => 'padrao',
                        'format' => 'boolean',
                        'label' => Yii::t('app', 'Padrão'),
                    ],
                    [
                        'attribute' => 'data_cadastro',
                        'format' => ['datetime', 'php:d/m/Y H:i'],
                        'label' => Yii::t('app', 'Data de Cadastro'),
                    ],
                ],
            ]) ?>
        </div>
    </div>
</div>