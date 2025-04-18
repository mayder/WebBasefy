<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Usuario;

/**
 * Password reset request form
 */
class PasswordResetRequestForm extends Model
{
    public $email;

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['email', 'trim'],
            ['email', 'required'],
            ['email', 'email'],
            [
                'email',
                'exist',
                'targetClass' => Usuario::class,
                'filter' => ['status' => true],
                'message' => 'Não existe um usuário ativo com este e-mail.'
            ],
        ];
    }

    /**
     * Envia o e-mail com o link de redefinição de senha
     *
     * @return bool
     */
    public function sendEmail()
    {
        $usuario = Usuario::findOne([
            'status' => true,
            'email' => $this->email,
        ]);

        if (!$usuario) {
            return false;
        }

        // Gera novo token com validade de 24h
        $usuario->token_reset_senha = Yii::$app->security->generateRandomString() . '_' . time();
        $usuario->expira_token_reset = date('Y-m-d H:i:s', strtotime('+24 hours'));

        if (!$usuario->save(false)) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'passwordResetToken-html', 'text' => 'passwordResetToken-text'],
                ['user' => $usuario]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Redefinição de senha - ' . Yii::$app->name)
            ->send();
    }
}
