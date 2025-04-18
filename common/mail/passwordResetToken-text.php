<?php

/** @var yii\web\View $this */
/** @var common\models\Usuario $user */

$resetLink = Yii::$app->urlManager->createAbsoluteUrl(['site/reset-password', 'token' => $user->token_reset_senha]);
?>

Olá <?= $user->nome ?>,

Recebemos uma solicitação para redefinir sua senha no sistema <?= Yii::$app->name ?>.

Para criar uma nova senha, acesse o link abaixo:

<?= $resetLink ?>


Se você não solicitou essa redefinição, apenas ignore este e-mail.