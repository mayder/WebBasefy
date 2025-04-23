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
        'attribute' => 'usuario_id',
        'value' => function ($model) {
            return $model->usuario->nome ?? $model->usuario_id; // ou outra propriedade que represente bem o usuário
        },
        'label' => Yii::t('app', 'Usuário'),
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'titulo',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'conteudo',
        'format' => 'ntext',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'tipo',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'link',
        'format' => 'url',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'lida',
        'format' => 'boolean',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data_cadastro',
        'format' => ['datetime', 'php:d/m/Y H:i'],
    ],
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
            'title' => Yii::t('yii2-ajaxcrud', 'View'),
            'data-toggle' => 'tooltip',
            'class' => 'btn btn-sm btn-outline-success'
        ],
        'updateOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Update'),
            'data-toggle' => 'tooltip',
            'class' => 'btn btn-sm btn-outline-primary'
        ],
        'deleteOptions' => [
            'role' => 'modal-remote',
            'title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'class' => 'btn btn-sm btn-outline-danger',
            'data-confirm' => false,
            'data-method' => false,
            'data-request-method' => 'post',
            'data-toggle' => 'tooltip',
            'data-confirm-title' => Yii::t('yii2-ajaxcrud', 'Delete'),
            'data-confirm-message' => Yii::t('yii2-ajaxcrud', 'Delete Confirm')
        ],
    ],
];
