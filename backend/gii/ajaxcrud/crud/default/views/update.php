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
use yii\helpers\Html;

/* @var \$this yii\web\View */
/* @var \$model <?= ltrim($generator->modelClass, '\\') ?> */

<?= "\$isModal = Yii::\$app->request->isAjax;\n" ?>

<?= "if (!\$isModal): \n?>\n" ?>
<div class="container-fluid py-3">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square me-1"></i> <?= "<?= Yii::t('app', 'Atualizar {$modelTitle}: {name}', ['name' => \$model->nome]) ?>" ?>

            </h5>
        </div>
        <div class="card-body">
            <?= "<?php endif; ?>\n" ?>

            <?= "<?= " ?>$this->render('_form', [
            'model' => $model,
            ]) ?>

            <?= "<?php if (!\$isModal): ?>\n" ?>
        </div>
    </div>
</div>
<?= "<?php endif; ?>\n" ?>