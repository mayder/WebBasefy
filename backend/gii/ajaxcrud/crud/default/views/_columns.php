<?php

use yii\helpers\Url;
use yii\helpers\Html;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$urlParams = $generator->generateUrlParams();
$actionParams = $generator->generateActionParams();

echo "<?php\n";
?>
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
<?php
$count = 0;
$tableSchema = $generator->getTableSchema();
foreach ($generator->getColumnNames() as $name) {
    $column = $tableSchema->columns[$name] ?? null;

    if ($name === 'status') {
        echo <<<PHP
    [
        'class' => '\\kartik\\grid\\DataColumn',
        'attribute' => 'status',
        'format' => 'raw',
        'value' => function (\$model) {
            return \$model->status
                ? '<span class="badge bg-success">' . Yii::t('app', 'Ativo') . '</span>'
                : '<span class="badge bg-secondary">' . Yii::t('app', 'Inativo') . '</span>';
        },
        'filter' => [1 => Yii::t('app', 'Ativo'), 0 => Yii::t('app', 'Inativo')],
    ],

PHP;
    } elseif ($name === 'data_cadastro') {
        echo <<<PHP
    [
        'class' => '\\kartik\\grid\\DataColumn',
        'attribute' => 'data_cadastro',
        'format' => ['datetime', 'php:d/m/Y H:i'],
    ],

PHP;
    } elseif ($column !== null && $column->phpType === 'boolean') {
        echo <<<PHP
    [
        'class' => '\\kartik\\grid\\DataColumn',
        'attribute' => '$name',
        'format' => ['boolean'],
        'filter' => [1 => Yii::t('app', 'Sim'), 0 => Yii::t('app', 'Não')],
    ],

PHP;
    } elseif ($count < 6) {
        echo <<<PHP
    [
        'class' => '\\kartik\\grid\\DataColumn',
        'attribute' => '$name',
    ],

PHP;
        $count++;
    } else {
        echo <<<PHP
    // [
    //     'class' => '\\kartik\\grid\\DataColumn',
    //     'attribute' => '$name',
    // ],

PHP;
    }
}
?>
[
'class' => 'kartik\grid\ActionColumn',
'dropdown' => false,
'vAlign' => 'middle',
'urlCreator' => function ($action, $model, $key, $index) {
return Url::to([$action, '<?= substr($actionParams, 1) ?>' => $key]);
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