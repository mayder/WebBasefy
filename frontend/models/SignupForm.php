<?php

namespace frontend\models;

use Yii;
use yii\base\Model;
use common\models\Usuario;

/**
 * Signup form
 */
class SignupForm extends Model
{
    public $nome;
    public $email;
    public $password;


    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'email', 'password'], 'required'],
            ['nome', 'string', 'min' => 2, 'max' => 100],

            ['email', 'email'],
            ['email', 'string', 'max' => 100],
            ['email', 'unique', 'targetClass' => '\common\models\Usuario', 'message' => 'Este e-mail já está em uso.'],

            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Signs user up.
     *
     * @return bool whether the creating new account was successful and email was sent
     */
    public function signup()
    {
        if (!$this->validate()) {
            return false;
        }

        $usuario = new Usuario();
        $usuario->nome = $this->nome;
        $usuario->email = $this->email;
        $usuario->senha_hash = Yii::$app->security->generatePasswordHash($this->password);
        $usuario->auth_key = Yii::$app->security->generateRandomString();
        $usuario->token_verificacao_email = Yii::$app->security->generateRandomString() . '_' . time();
        $usuario->status = false;
        $usuario->data_cadastro = date('Y-m-d H:i:s');

        // Se desejar já criar um cliente vinculado, podemos incluir isso aqui também

        if ($usuario->save()) {
            // Opcional: enviar e-mail de verificação
            // $this->sendEmail($usuario);

            return true;
        }

        return false;
    }

    /**
     * Envia o e-mail de verificação para o usuário
     * @param \common\models\Usuario $user
     * @return bool
     */
    protected function sendEmail($user)
    {
        return Yii::$app
            ->mailer
            ->compose(
                ['html' => 'emailVerify-html', 'text' => 'emailVerify-text'],
                ['user' => $user]
            )
            ->setFrom([Yii::$app->params['supportEmail'] => Yii::$app->name . ' robot'])
            ->setTo($this->email)
            ->setSubject('Confirmação de e-mail - ' . Yii::$app->name)
            ->send();
    }
}
