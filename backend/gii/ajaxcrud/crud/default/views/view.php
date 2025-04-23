<?php

use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $generator yii\gii\generators\crud\Generator */

$modelClass = StringHelper::basename($generator->modelClass);
$modelId = Inflector::camel2id($modelClass);
$modelTitle = Inflector::camel2words($modelClass);

echo "<?php\n";
?>

use yii\widgets\DetailView;

/* @var \$this yii\web\View */
/* @var \$model <?= ltrim($generator->modelClass, '\\') ?> */

<?= "\$isModal = Yii::\$app->request->isAjax; \n" ?>

<?= "if (!\$isModal): \n?>\n" ?>
<div class="container-fluid py-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-info-circle me-1"></i> <?= "<?= Yii::t('app', 'Detalhes do {$modelTitle}') ?>" ?>

            </h5>
        </div>
        <div class="card-body">
            <?= "<?php endif; ?>\n" ?>

            <?= "<?= " ?>DetailView::widget([
            'model' => $model,
            'options' => ['class' => 'table table-bordered table-striped detail-view'],
            'attributes' => [
            <?php
            $tableSchema = $generator->getTableSchema();
            foreach ($generator->getColumnNames() as $name) {
                if ($name === 'status') {
                    echo <<<PHP
        [
            'attribute' => 'status',
            'format' => 'raw',
            'value' => \$model->status
                ? '<span class="badge bg-success">' . Yii::t('app', 'Ativo') . '</span>'
                : '<span class="badge bg-secondary">' . Yii::t('app', 'Inativo') . '</span>',
        ],
PHP;
                    echo "\n";
                } elseif ($name === 'data_cadastro') {
                    echo <<<PHP
        [
            'attribute' => 'data_cadastro',
            'format' => ['datetime', 'php:d/m/Y H:i'],
        ],
PHP;
                    echo "\n";
                } else {
                    $formatted = $generator->generateColumnFormat($tableSchema?->columns[$name] ?? null);
                    echo "        '" . $name . ($formatted !== 'text' ? ":$formatted" : "") . "',\n";
                }
            }
            ?>
            ],
            ]) ?>

            <?= "<?php if (!\$isModal): ?>\n" ?>
        </div>
    </div>
</div>
<?= "<?php endif; ?>\n" ?>