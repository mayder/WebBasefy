<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Usuario;

class ResendVerificationEmailForm extends Model
{
    /**
     * @var string
     */
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
                'filter' => ['status' => false],
                'message' => 'Não existe um usuário com este e-mail que precise de verificação.'
            ],
        ];
    }

    /**
     * Sends confirmation email to user
     *
     * @return bool whether the email was sent
     */
    public function sendEmail()
    {
        $usuario = \common\models\Usuario::findOne([
            'email' => $this->email,
            'status' => false
        ]);

        if ($usuario === null) {
            return false;
        }

        // Gera novo token, se necessário
        $usuario->token_verificacao_email = Yii::$app->security->generateRandomString() . '_' . time();

        if (!$usuario->save(false)) {
            return false;
        }

        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $usuario]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Confirmação de e-mail - ' . Yii::$app->name)
            ->send();
    }
}
