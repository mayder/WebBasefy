<?php
use yii\helpers\Html;
use yii\bootstrap5\ActiveForm;

/* @var $this yii\web\View */
/* @var $model common\models\Mensagem */
/* @var $form yii\widgets\ActiveForm */
?>

<div class="mensagem-form">

    <?php $form = ActiveForm::begin(); ?>

    <?= $form->field($model, 'tipo')->dropDownList([ 'email' => 'Email', 'push' => 'Push', 'sms' => 'Sms', 'webhook' => 'Webhook', 'whatsapp' => 'Whatsapp', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'usuario_id')->textInput() ?>

    <?= $form->field($model, 'titulo')->textInput(['maxlength' => true]) ?>

    <?= $form->field($model, 'conteudo')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'status_envio')->dropDownList([ 'pendente' => 'Pendente', 'enviado' => 'Enviado', 'erro' => 'Erro', ], ['prompt' => '']) ?>

    <?= $form->field($model, 'tentativa')->textInput() ?>

    <?= $form->field($model, 'max_tentativa')->textInput() ?>

    <?= $form->field($model, 'data_agendada')->textInput() ?>

    <?= $form->field($model, 'data_envio')->textInput() ?>

    <?= $form->field($model, 'erro')->textarea(['rows' => 6]) ?>

    <?= $form->field($model, 'usuario_id_cad')->textInput() ?>

    <?= $form->field($model, 'data_cadastro')->textInput() ?>

  
	<?php if (!Yii::$app->request->isAjax){ ?>
	  	<div class="form-group">
	        <?= Html::submitButton($model->isNewRecord ? Yii::t('app', 'Create') : Yii::t('app', 'Update'), ['class' => $model->isNewRecord ? 'btn btn-success' : 'btn btn-primary']) ?>
	    </div>
	<?php } ?>

    <?php ActiveForm::end(); ?>
    
</div>
