<?php

/** @var yii\web\View $this */
/** @var common\models\Usuario $user */

$verifyLink = Yii::$app->urlManager->createAbsoluteUrl(['site/verify-email', 'token' => $user->token_verificacao_email]);
?>

Olá <?= $user->nome ?>,

Obrigado por se cadastrar no sistema <?= Yii::$app->name ?>.

Para confirmar seu e-mail e ativar sua conta, acesse o link abaixo:

<?= $verifyLink ?>


Se você não realizou este cadastro, ignore esta mensagem.