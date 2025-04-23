<?php

use yii\bootstrap5\ActiveForm;
use yii\helpers\Inflector;
use yii\helpers\StringHelper;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */

$isAjax = Yii::$app->request->isAjax;
$modelClass = new $generator->modelClass();
$tableSchema = $modelClass->getTableSchema();
$safeAttributes = $modelClass->safeAttributes();
if (empty($safeAttributes)) {
    $safeAttributes = $modelClass->attributes();
}
echo "<?php\n";
?>
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model <?= ltrim($generator->modelClass, '\\') ?> */
/* @var $form yii\widgets\ActiveForm */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="<?= Inflector::camel2id(StringHelper::basename($generator->modelClass)) ?>-form">
    <?= "<?php " ?>$form = ActiveForm::begin([
    'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">
        <?php foreach ($tableSchema->columns as $column):
            $name = $column->name;
            if (!in_array($name, $safeAttributes) || in_array($name, ['id', 'data_cadastro'])) {
                continue;
            }
            // Detecta boolean
            if ($column->type === 'boolean') {
                echo <<<PHP
        
        <div class="form-check form-switch mt-3 ms-3">
            <?= \$form->field(\$model, '$name', [
                'template' => '{input}{label}{error}',
                'options' => ['class' => 'form-check'],
            ])->checkbox([
                'class' => 'form-check-input',
                'role' => 'switch',
                'labelOptions' => ['class' => 'form-check-label ms-2'],
                'uncheck' => 0,
                'value' => 1,
            ]) ?>
        </div>
PHP;
                continue;
            }

            // Detecta campo status (switch só na edição)
            if ($name === 'status') {
                echo <<<PHP
        
        <?php if (!\$model->isNewRecord): ?>
            <div class="form-check form-switch mt-3 ms-3">
                <?= \$form->field(\$model, '$name', [
                    'template' => '{input}{label}{error}',
                    'options' => ['class' => 'form-check'],
                ])->checkbox([
                    'class' => 'form-check-input',
                    'role' => 'switch',
                    'labelOptions' => ['class' => 'form-check-label ms-2'],
                    'uncheck' => 0,
                    'value' => 1,
                ]) ?>
            </div>
        <?php endif; ?>
PHP;
                continue;
            }

            // Detecta ENUM
            if ($column->dbType && strpos($column->dbType, 'enum(') === 0) {
                preg_match("/^enum\((.*)\)$/", $column->dbType, $matches);
                $values = array_map(fn($v) => trim($v, "'"), explode(',', $matches[1]));
                $items = '[' . implode(', ', array_map(fn($v) => "'$v' => Yii::t('app', '$v')", $values)) . ']';
                echo <<<PHP
        
        <div class="col-md-6 mb-3">
            <?= \$form->field(\$model, '$name')->dropDownList($items, ['prompt' => Yii::t('app', 'Selecione...')]) ?>
        </div>
PHP;
                continue;
            }

            // Detecta relacionamento por *_id
            if (preg_match('/_id$/', $name)) {
                $relModel = ucfirst(str_replace('_id', '', $name));
                $relClass = "common\\models\\$relModel";

                echo <<<PHP
        
        <div class="col-md-6 mb-3">
            <?= \$form->field(\$model, '$name')->dropDownList(
                $relClass::find()->select(['nome', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione...')]
            ) ?>
        </div>
PHP;
                continue;
            }

            // Default text input
            echo <<<PHP
    
        
        <div class="col-md-6 mb-3">
            <?= \$form->field(\$model, '$name')->textInput(['maxlength' => true]) ?>
        </div>
PHP;
        endforeach; ?>


    </div>

    <?php
    echo <<<PHP
<?php if (!\$isAjax): ?>
        <div class="form-group mt-3 text-end">
            <?= Html::submitButton(
                \$model->isNewRecord
                    ? '<i class="bi bi-check-circle me-1"></i> ' . Yii::t('app', 'Criar')
                    : '<i class="bi bi-pencil-square me-1"></i> ' . Yii::t('app', 'Atualizar'),
                ['class' => \$model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    <?php endif; ?>
PHP;
    ?>


    <?= "<?php " ?>ActiveForm::end(); ?>
</div>