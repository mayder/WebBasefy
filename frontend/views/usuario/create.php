<?php

use yii\helpers\Html;

/* @var $this yii\web\View */
/* @var $model common\models\Usuario */

$isModal = Yii::$app->request->isAjax;
?>

<?php if (!$isModal): ?>
    <div class="container-fluid py-3">
        <div class="card shadow-sm">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">
                    <i class="bi bi-person-plus-fill me-1"></i> Novo Usuário
                </h5>
            </div>
            <div class="card-body">
            <?php endif; ?>

            <?= $this->render('_form', ['model' => $model]) ?>

            <?php if (!$isModal): ?>
            </div>
        </div>
    </div>
<?php endif; ?>