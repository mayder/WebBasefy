<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Idioma */

$this->title = Yii::t('app', 'Editar Idioma');
$this->params['breadcrumbs'][] = ['label' => Yii::t('app', 'Idiomas'), 'url' => ['index']];
$this->params['breadcrumbs'][] = $this->title;
?>

<div class="container-fluid py-3 idioma-update">
    <div class="card shadow-sm">
        <div class="card-header bg-primary text-white">
            <h5 class="mb-0">
                <i class="bi bi-pencil-square me-1"></i> <?= Html::encode($this->title) ?>
            </h5>
        </div>
        <div class="card-body">
            <?= $this->render('_form', [
                'model' => $model,
            ]) ?>
        </div>
    </div>
</div>