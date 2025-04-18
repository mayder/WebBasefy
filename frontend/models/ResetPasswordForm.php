<?php

namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use Yii;
use common\models\Usuario;

/**
 * Password reset form
 */
class ResetPasswordForm extends Model
{
    public $password;

    /**
     * @var \common\models\Usuario
     */
    private $_usuario;


    /**
     * Construtor baseado no token de reset
     *
     * @param string $token
     * @param array $config
     * @throws InvalidArgumentException
     */
    public function __construct($token, $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('O token de redefinição de senha não pode estar em branco.');
        }

        $this->_usuario = Usuario::findOne(['token_reset_senha' => $token]);

        if (!$this->_usuario) {
            throw new InvalidArgumentException('Token de redefinição inválido ou expirado.');
        }

        parent::__construct($config);
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            ['password', 'required'],
            ['password', 'string', 'min' => Yii::$app->params['user.passwordMinLength']],
        ];
    }

    /**
     * Redefine a senha do usuário
     *
     * @return bool
     */
    public function resetPassword()
    {
        $usuario = $this->_usuario;
        $usuario->senha_hash = Yii::$app->security->generatePasswordHash($this->password);
        $usuario->token_reset_senha = null;
        $usuario->expira_token_reset = null;
        $usuario->auth_key = Yii::$app->security->generateRandomString();

        return $usuario->save(false);
    }
}
