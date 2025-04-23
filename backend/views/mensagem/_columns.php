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
        'attribute' => 'tipo',
        'class' => 'kartik\grid\DataColumn',
        'label' => Yii::t('app', 'Tipo'),
    ],
    [
        'attribute' => 'usuario_id',
        'class' => 'kartik\grid\DataColumn',
        'value' => function ($model) {
            return $model->usuario->nome ?? null;
        },
        'label' => Yii::t('app', 'Usuário'),
    ],
    [
        'attribute' => 'titulo',
        'class' => 'kartik\grid\DataColumn',
        'label' => Yii::t('app', 'Título'),
    ],
    [
        'attribute' => 'conteudo',
        'class' => 'kartik\grid\DataColumn',
        'format' => 'ntext',
        'label' => Yii::t('app', 'Conteúdo'),
    ],
    [
        'attribute' => 'status_envio',
        'class' => 'kartik\grid\DataColumn',
        'label' => Yii::t('app', 'Status de Envio'),
    ],
    // Descomente conforme necessidade:
    // [
    //     'attribute' => 'tentativa',
    //     'class' => 'kartik\grid\DataColumn',
    // ],
    // [
    //     'attribute' => 'data_envio',
    //     'class' => 'kartik\grid\DataColumn',
    //     'format' => ['datetime', 'php:d/m/Y H:i'],
    // ],

    [
        'class' => 'kartik\grid\ActionColumn',
        'dropdown' => false,
        'noWrap' => true,
        'template' => '{view} {update} {delete}',
        'vAlign' => 'middle',
        'urlCreator' => function ($action, $model, $key, $index) {
            return Url::to([$action, 'id' => $key]);
        },
        'viewOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Visualizar'),
            'data-toggle' => 'tooltip',
            'class' => 'btn btn-sm btn-outline-success',
            'icon' => '<i class="bi bi-eye"></i>',
        ],
        'updateOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Atualizar'),
            'data-toggle' => 'tooltip',
            'class' => 'btn btn-sm btn-outline-primary',
            'icon' => '<i class="bi bi-pencil"></i>',
        ],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Excluir'),
            'data-toggle' => 'tooltip',
            'class' => 'btn btn-sm btn-outline-danger',
            'data-confirm' => false,
            'data-method' => false,
            'data-request-method' => 'post',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Excluir'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Tem certeza que deseja excluir este item?'),
            'icon' => '<i class="bi bi-trash"></i>',
        ],
    ],
];
