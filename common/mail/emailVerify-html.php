<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Usuario $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl([
    'site/verify-email',
    'token' => $user->token_verificacao_email,
]);
?>
<div style="font-family: Arial, sans-serif; font-size: 15px; line-height: 1.6; color: #333;">
    <p>Olá <strong><?= Html::encode($user->nome) ?></strong>,</p>

    <p>Obrigado por se registrar na <strong><?= Html::encode(Yii::$app->name) ?></strong>.</p>

    <p>Para confirmar seu e-mail e ativar sua conta, clique no botão abaixo:</p>

    <p style="margin: 30px 0;">
        <?= Html::a('Confirmar E-mail', $verifyLink, [
            'style' => '
                display: inline-block;
                background-color: #0d6efd;
                color: #fff;
                padding: 12px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
            ',
        ]) ?>
    </p>

    <p>Ou copie e cole o link abaixo no seu navegador:</p>

    <p style="color: #555;">
        <?= Html::encode($verifyLink) ?>
    </p>

    <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">
    <p style="font-size: 13px; color: #999;">
        Se você não realizou este cadastro, ignore este e-mail.
    </p>
</div>