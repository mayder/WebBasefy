<?php

use yii\helpers\Url;

return [
    ['class' => 'kartik\grid\CheckboxColumn', 'width' => '20px'],
    ['class' => 'kartik\grid\SerialColumn', 'width' => '30px'],

    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'usuario_id',
        'value' => fn($model) => $model->usuario->nome ?? '(?)',
        'label' => Yii::t('app', 'Usuário'),
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'cliente_id',
        'value' => fn($model) => $model->cliente->nome_fantasia ?? '(?)',
        'label' => Yii::t('app', 'Cliente'),
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'titulo',
        'format' => 'text',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'tipo_id',
        'value' => fn($model) => $model->tipo->nome ?? '-',
        'label' => Yii::t('app', 'Tipo'),
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'status_id',
        'value' => fn($model) => $model->status->nome ?? '-',
        'label' => Yii::t('app', 'Status'),
        'format' => 'raw',
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'publico',
        'format' => 'boolean',
        'label' => Yii::t('app', 'Público?'),
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'filter' => [1 => Yii::t('app', 'Sim'), 0 => Yii::t('app', 'Não')],
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'prioridade',
        'label' => Yii::t('app', 'Prioridade'),
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => 'kartik\grid\DataColumn',
        'attribute' => 'data_cadastro',
        'format' => ['datetime', 'php:d/m/Y H:i'],
        'label' => Yii::t('app', 'Data de Abertura'),
        'hAlign' => 'center',
        'width' => '180px',
    ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => true,
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => fn($action, $model, $key, $index) => Url::to([$action, 'id' => $key]),
        'viewOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'View'),
            'class' => 'btn btn-sm btn-outline-secondary',
            'data-bs-toggle' => 'tooltip',
        ],
        'updateOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Update'),
            'class' => 'btn btn-sm btn-outline-primary',
            'data-bs-toggle' => 'tooltip',
        ],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'class' => 'btn btn-sm btn-outline-danger',
            'data-confirm' => false,
            'data-method' => false,
            'data-request-method' => 'post',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm'),
            'data-bs-toggle' => 'tooltip',
        ],
        'contentOptions' => ['class' => 'text-center'],
    ],
];
