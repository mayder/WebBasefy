<?php

use yii\helpers\Html;
use yii\widgets\ActiveForm;

/** @var yii\web\View $this */
/** @var common\models\Usuario $model */
/** @var yii\widgets\ActiveForm $form */
?>

<div class="usuario-form">

    <?php $form = ActiveForm::begin(); ?>

    <div class="row">
        <div class="col-md-5">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-5">
            <?= $form->field($model, 'email')->textInput(['maxlength' => true]) ?>
        </div>
        <div class="col-md-2">
            <?= $form->field($model, 'senha_hash')->passwordInput(['maxlength' => true])->label('Senha') ?>
        </div>

        <?php if (!$model->isNewRecord): ?>
            <div class="form-check form-switch mt-3 ms-3">
                <?= $form->field($model, 'status', [
                    'template' => '{input}{label}{error}',
                    'options' => ['class' => 'form-check'],
                ])->checkbox([
                    'class' => 'form-check-input',
                    'role' => 'switch',
                    'labelOptions' => ['class' => 'form-check-label ms-2'],
                    'uncheck' => 0,
                    'value' => 1
                ]) ?>
            </div>
        <?php endif; ?>
    </div>

    <div class="form-group mt-3">
        <?= Html::submitButton('<i class="bi bi-save me-1"></i> Salvar', ['class' => 'btn btn-primary']) ?>
    </div>

    <?php ActiveForm::end(); ?>

</div>