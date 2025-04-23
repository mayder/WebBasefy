<?php

use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;
use common\models\Usuario;

/* @var $this yii\web\View */
/* @var $model common\models\NotificacaoSistema */
/* @var $form yii\bootstrap5\ActiveForm */

$isAjax = Yii::$app->request->isAjax;
?>

<div class="notificacao-sistema-form">
    <?php $form = ActiveForm::begin([
        'options' => ['autocomplete' => 'off'],
    ]); ?>

    <div class="row">
        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'usuario_id')->dropDownList(
                Usuario::find()->select(['nome', 'id'])->indexBy('id')->column(),
                ['prompt' => Yii::t('app', 'Selecione o usuário...')]
            ) ?>
        </div>

        <div class="col-md-6 mb-3">
            <?= $form->field($model, 'tipo')->dropDownList([
                'info' => 'Info',
                'warning' => 'Warning',
                'success' => 'Success',
                'danger' => 'Danger',
            ], ['prompt' => Yii::t('app', 'Selecione o tipo...')]) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'conteudo')->textarea(['rows' => 4]) ?>
        </div>

        <div class="col-md-12 mb-3">
            <?= $form->field($model, 'link')->textarea(['rows' => 2]) ?>
        </div>

        <div class="form-check form-switch mt-3 ms-3">
            <?= $form->field($model, 'lida', [
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