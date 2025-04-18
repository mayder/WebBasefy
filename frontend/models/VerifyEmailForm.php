<?php

namespace frontend\models;

use yii\base\InvalidArgumentException;
use yii\base\Model;
use common\models\Usuario;

class VerifyEmailForm extends Model
{
    /**
     * @var string
     */
    public $token;

    /**
     * @var Usuario
     */
    private $_usuario;

    /**
     * Creates a form model with given token.
     *
     * @param string $token
     * @param array $config
     * @throws InvalidArgumentException if token is invalid
     */
    public function __construct($token, array $config = [])
    {
        if (empty($token) || !is_string($token)) {
            throw new InvalidArgumentException('O token de verificação não pode estar em branco.');
        }

        $this->_usuario = Usuario::findOne(['token_verificacao_email' => $token]);

        if (!$this->_usuario) {
            throw new InvalidArgumentException('Token de verificação inválido ou expirado.');
        }

        parent::__construct($config);
    }

    /**
     * Verifica e ativa o e-mail do usuário
     *
     * @return Usuario|null o usuário ativado ou null se falhar
     */
    public function verifyEmail()
    {
        $usuario = $this->_usuario;
        $usuario->status = true;
        $usuario->token_verificacao_email = null;

        return $usuario->save(false) ? $usuario : null;
    }
}
