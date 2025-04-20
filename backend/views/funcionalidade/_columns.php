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
        'attribute' => 'chave',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'modulo_id',
        'value' => fn($model) => $model->modulo->nome ?? Yii::t('app', '(não informado)'),
        'hAlign' => 'center',
        'vAlign' => 'middle',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'value' => fn($model) => $model->status
            ? '<span class="badge bg-success">' . Yii::t('app', 'Ativo') . '</span>'
            : '<span class="badge bg-secondary">' . Yii::t('app', 'Inativo') . '</span>',
        'filter' => [1 => Yii::t('app', 'Ativo'), 0 => Yii::t('app', 'Inativo')],
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'width' => '120px',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data_cadastro',
        'format' => ['datetime', 'php:d/m/Y H:i'],
        'hAlign' => 'center',
        'vAlign' => 'middle',
        'width' => '160px',
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
            'class' => 'btn btn-sm btn-outline-success',
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
