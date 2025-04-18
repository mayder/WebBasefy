<?php

/** @var \yii\web\View $this */
/** @var string $content */

use frontend\widgets\Alert;
use frontend\assets\AppAsset;
use yii\bootstrap5\Breadcrumbs;
use yii\bootstrap5\Html;
use yii\bootstrap5\Nav;
use yii\bootstrap5\NavBar;

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

<body class="d-flex flex-column h-100">
    <?php $this->beginBody() ?>

    <header>
        <?php
        NavBar::begin([
            'brandLabel' => Html::tag('span', '<i class="bi bi-globe2 me-2"></i> Basefy', ['class' => 'fw-bold']),
            'brandUrl' => Yii::$app->homeUrl,
            'options' => [
                'class' => 'navbar navbar-expand-lg navbar-dark bg-primary shadow-sm',
            ],
        ]);

        $menuItems = [];

        if (Yii::$app->user->isGuest) {
            $menuItems[] = ['label' => '<i class="bi bi-person-plus-fill me-1"></i> Criar Conta', 'url' => ['/site/signup']];
        } else {
            $menuItems[] = ['label' => '<i class="bi bi-house-door-fill me-1"></i> Dashboard', 'url' => ['/site/index']];
            $menuItems[] = ['label' => '<i class="bi bi-people-fill me-1"></i> Usuários', 'url' => ['/usuario/index']];
        }

        echo Nav::widget([
            'options' => ['class' => 'navbar-nav me-auto mb-2 mb-lg-0'],
            'items' => $menuItems,
            'encodeLabels' => false,
        ]);

        echo '<div class="d-flex align-items-center">';
        if (Yii::$app->user->isGuest) {
            echo Html::a('<i class="bi bi-box-arrow-in-right me-1"></i> Entrar', ['/site/login'], ['class' => 'btn btn-outline-light btn-sm']);
        } else {
            echo Html::beginForm(['/site/logout'], 'post', ['class' => 'd-inline'])
                . Html::submitButton(
                    '<i class="bi bi-box-arrow-right me-1"></i> Sair (' . Yii::$app->user->identity->nome . ')',
                    ['class' => 'btn btn-outline-light btn-sm']
                )
                . Html::endForm();
        }
        echo '</div>';

        NavBar::end();
        ?>
    </header>

    <main role="main" class="flex-shrink-0">
        <div class="container">
            <?= (!Yii::$app->user->isGuest) ? Breadcrumbs::widget([
                'links' => $this->params['breadcrumbs'] ?? [],
                'options' => ['class' => 'breadcrumb bg-light px-3 py-2 mb-3 shadow-sm border rounded'],
                'itemTemplate' => "<li class=\"breadcrumb-item\">{link}</li>\n",
                'activeItemTemplate' => "<li class=\"breadcrumb-item active text-dark\" aria-current=\"page\">{link}</li>\n",
            ]) : '' ?>
            <?= Alert::widget() ?>
            <?= $content ?>
        </div>
    </main>

    <footer class="footer mt-auto py-3 text-muted">
        <div class="container">
            <p class="float-start">&copy; <?= Html::encode(Yii::$app->name) ?> <?= date('Y') ?></p>
            <p class="float-end">
                Desenvolvido por
                <?= Html::a('Mayder', 'https://mayder.com.br', ['target' => '_blank', 'rel' => 'noopener noreferrer']) ?>
            </p>
        </div>
    </footer>

    <?php $this->endBody() ?>
</body>

</html>
<?php $this->endPage();
