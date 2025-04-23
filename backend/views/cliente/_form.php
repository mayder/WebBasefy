<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Cliente */
/* @var $form yii\widgets\ActiveForm */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="cliente-form">
    <?php $form = ActiveForm::begin([
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'nome')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'plano_id')->dropDownList(
                common\models\Plano::find()->select(['nome', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione...')]
            ) ?>
        </div>

        <div class="form-check form-switch mt-3 ms-3">
            <?= $form->field($model, 'status', [
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

    </div>

    <?php if (!$isAjax): ?>
        <div class="form-group mt-3 text-end">
            <?= Html::submitButton(
                $model->isNewRecord
                    ? '<i class="bi bi-check-circle me-1"></i> ' . Yii::t('app', 'Criar')
                    : '<i class="bi bi-pencil-square me-1"></i> ' . Yii::t('app', 'Atualizar'),
                ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']
            ) ?>
        </div>
    <?php endif; ?>

    <?php ActiveForm::end(); ?>
</div>