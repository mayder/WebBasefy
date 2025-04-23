<?php

use yii\helpers\Url;

return [
    [
        'class' => 'kartik\grid\CheckboxColumn',
        'width' => '20px',
    ],
    [
        'class' => 'kartik\grid\SerialColumn',
        'width' => '30px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nome',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'sigla',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'value' => fn($model) => $model->status
            ? '<span class="badge bg-success">Ativo</span>'
            : '<span class="badge bg-secondary">Inativo</span>',
        'hAlign' => 'center',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'padrao',
        'format' => 'raw',
        'value' => fn($model) => $model->padrao
            ? '<i class="bi bi-check-circle-fill text-primary"></i>'
            : '',
        'hAlign' => 'center',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data_cadastro',
        'format' => ['datetime', 'php:d/m/Y H:i'],
        'hAlign' => 'center',
    ],
    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => true,
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => fn($action, $model, $key, $index) =>
        Url::to([$action, 'id' => $key]),
        'viewOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Visualizar'),
            'data-toggle' => 'tooltip',
            'class' => 'btn btn-sm btn-outline-success',
            'aria-label' => 'Visualizar',
        ],
        'updateOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Editar'),
            'data-toggle' => 'tooltip',
            'class' => 'btn btn-sm btn-outline-primary',
            'aria-label' => 'Editar',
        ],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Excluir'),
            'class' => 'btn btn-sm btn-outline-danger',
            'data-confirm' => false,
            'data-method' => false,
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Excluir'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Tem certeza que deseja excluir este item?'),
            'aria-label' => 'Excluir',
        ],
    ],
];
