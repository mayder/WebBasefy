<?php

namespace common\models;

use Yii;
use yii\db\ActiveRecord;
use yii\web\IdentityInterface;

/**
 * This is the model class for table "usuario".
 *
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string|null $senha_hash
 * @property string|null $auth_key
 * @property string|null $token_verificacao_email
 * @property string|null $access_token
 * @property string|null $token_reset_senha
 * @property string|null $expira_token_reset
 * @property bool $status
 * @property bool $admin
 * @property string|null $ultimo_acesso
 * @property string $data_cadastro
 */
class Usuario extends ActiveRecord implements IdentityInterface
{
    public function init()
    {
        parent::init();
        if ($this->isNewRecord) {
            $this->status = true;
            $this->admin = false;
        }
    }

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['senha_hash', 'auth_key', 'access_token', 'token_reset_senha', 'expira_token_reset', 'ultimo_acesso'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['admin'], 'default', 'value' => 0],
            [['nome', 'email', 'data_cadastro'], 'required'],
            [['expira_token_reset', 'ultimo_acesso', 'data_cadastro'], 'safe'],
            [['status', 'admin'], 'boolean'],
            [['nome', 'email'], 'string', 'max' => 45],
            [['senha_hash', 'token_verificacao_email', 'access_token', 'token_reset_senha'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
        ];
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            // Se senha_hash estiver preenchida E ainda não for um hash (começa com $2y$), gera hash
            if (!empty($this->senha_hash) && strpos($this->senha_hash, '$2y$') !== 0) {
                $this->senha_hash = Yii::$app->security->generatePasswordHash($this->senha_hash);
            } elseif (!$this->isNewRecord && empty($this->senha_hash)) {
                // Em update, se senha vazia, mantém a atual
                $this->senha_hash = self::findOne($this->id)->senha_hash;
            }

            if ($this->isNewRecord) {
                $this->auth_key = Yii::$app->security->generateRandomString();
                $this->data_cadastro = date('Y-m-d H:i:s');
            }

            return true;
        }
        return false;
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'nome' => Yii::t('app', 'Nome'),
            'email' => Yii::t('app', 'Email'),
            'senha_hash' => Yii::t('app', 'Senha'),
            'auth_key' => Yii::t('app', 'Auth key'),
            'token_verificacao_email' => Yii::t('app', 'Token de verificação do email'),
            'access_token' => Yii::t('app', 'Access token'),
            'token_reset_senha' => Yii::t('app', 'Token de reset de senha'),
            'expira_token_reset' => Yii::t('app', 'Expiração do token de reset em'),
            'status' => Yii::t('app', 'Status'),
            'admin' => Yii::t('app', 'Super usuário?'),
            'ultimo_acesso' => Yii::t('app', 'Ultimo acesso em'),
            'data_cadastro' => Yii::t('app', 'Cadastrado em'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return UsuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new UsuarioQuery(get_called_class());
    }

    // Encontra identidade pelo ID (usado em sessões)
    public static function findIdentity($id)
    {
        return self::findOne(['id' => $id, 'status' => true, 'admin' => true]);
    }

    // Encontra identidade por access token (API futuramente)
    public static function findIdentityByAccessToken($token, $type = null)
    {
        return self::findOne(['access_token' => $token, 'status' => true, 'admin' => true]);
    }

    // Retorna o ID do usuário (obrigatório)
    public function getId()
    {
        return $this->id;
    }

    // Retorna a auth_key usada no rememberMe
    public function getAuthKey()
    {
        return $this->auth_key;
    }

    // Valida se a auth_key bate com a armazenada
    public function validateAuthKey($authKey)
    {
        return $this->auth_key === $authKey;
    }

    public static function findByEmail($email)
    {
        return self::findOne(['email' => $email, 'status' => true, 'admin' => true]);
    }

    public function validatePassword($senha)
    {
        return Yii::$app->security->validatePassword($senha, $this->senha_hash);
    }

    public function setSenha($senha)
    {
        $this->senha_hash = Yii::$app->security->generatePasswordHash($senha);
    }

    public function generateAuthKey()
    {
        $this->auth_key = Yii::$app->security->generateRandomString();
    }
}
