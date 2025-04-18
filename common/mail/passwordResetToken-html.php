<?php

use yii\helpers\Html;

/** @var yii\web\View $this */
/** @var common\models\Usuario $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->token_reset_senha]);
?>

<div style="font-family: Arial, sans-serif; font-size: 15px; line-height: 1.6; color: #333;">
    <p>Olá <strong><?= Html::encode($user->nome) ?></strong>,</p>

    <p>Recebemos uma solicitação para redefinir sua senha no <strong><?= Html::encode(Yii::$app->name) ?></strong>.</p>

    <p>Clique no botão abaixo para criar uma nova senha:</p>

    <p style="margin: 30px 0;">
        <?= Html::a('Redefinir Senha', $resetLink, [
            'style' => '
                display: inline-block;
                background-color: #dc3545;
                color: #fff;
                padding: 12px 20px;
                text-decoration: none;
                border-radius: 5px;
                font-weight: bold;
            ',
        ]) ?>
    </p>

    <p>Se preferir, copie e cole o link abaixo no seu navegador:</p>

    <p style="color: #555;">
        <?= Html::encode($resetLink) ?>
    </p>

    <hr style="margin: 30px 0; border: none; border-top: 1px solid #ddd;">
    <p style="font-size: 13px; color: #999;">
        Se você não solicitou essa redefinição, apenas ignore este e-mail.
    </p>
</div>