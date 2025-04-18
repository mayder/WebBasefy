<?php

/** @var yii\web\View $this */
/** @var string $content */

use backend\assets\AppAsset;
use yii\helpers\Html;

AppAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>" class="h-100">

<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>

<body class="d-flex align-items-center justify-content-center vh-100 bg-light">

    <?php $this->beginBody() ?>

    <main role="main">
        <div class="container">
            <?= $content ?>
        </div>
    </main>

    <?php if (Yii::$app->session->hasFlash('loginErro')): ?>
        <div class="toast-container position-fixed bottom-0 end-0 p-3">
            <div id="toastErro" class="toast align-items-center text-bg-danger border-0 show" role="alert" aria-live="assertive" aria-atomic="true">
                <div class="d-flex">
                    <div class="toast-body">
                        <?= Yii::$app->session->getFlash('loginErro') ?>
                    </div>
                    <button type="button" class="btn-close btn-close-white me-2 m-auto" data-bs-dismiss="toast" aria-label="Fechar"></button>
                </div>
            </div>
        </div>
    <?php endif; ?>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
