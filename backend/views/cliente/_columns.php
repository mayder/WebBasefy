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
        'attribute' => 'id',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'nome',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'plano_id',
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'value' => function ($model) {
            return $model->status
                ? '<span class="badge bg-success">' . Yii::t('app', 'Ativo') . '</span>'
                : '<span class="badge bg-secondary">' . Yii::t('app', 'Inativo') . '</span>';
        },
        'filter' => [1 => Yii::t('app', 'Ativo'), 0 => Yii::t('app', 'Inativo')],
    ],
    [
        'class' => '\kartik\grid\DataColumn',
        'attribute' => 'data_cadastro',
        'format' => ['datetime', 'php:d/m/Y H:i'],
    ],
[
'class' => 'kartik\grid\ActionColumn',
'dropdown' => false,
'vAlign' => 'middle',
'urlCreator' => function ($action, $model, $key, $index) {
return Url::to([$action, 'id' => $key]);
},
'viewOptions' => ['role' => 'modal-remote', 'title' => Yii::t('app', 'Visualizar'), 'class' => 'btn btn-sm btn-outline-secondary'],
'updateOptions' => ['role' => 'modal-remote', 'title' => Yii::t('app', 'Atualizar'), 'class' => 'btn btn-sm btn-outline-primary'],
'deleteOptions' => [
'role' => 'modal-remote',
'title' => Yii::t('app', 'Excluir'),
'class' => 'btn btn-sm btn-outline-danger',
'data-confirm' => false,
'data-method' => false,
'data-request-method' => 'post',
'data-toggle' => 'tooltip',
'data-confirm-title' => Yii::t('app', 'Excluir'),
'data-confirm-message' => Yii::t('app', 'Tem certeza que deseja excluir este item?')
],
],
];