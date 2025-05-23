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
 * @property string|null $foto_perfil 
 * @property int|null $idioma_id 
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
 * 
 * @property ClienteUsuario[] $clienteUsuarios 
 * @property Cliente[] $clientes 
 * @property Idioma $idioma 
 * @property Mensagem[] $mensagems 
 * @property Mensagem[] $mensagems0 
 * @property NotificacaoSistema[] $notificacaoSistemas 
 * @property TicketResposta[] $ticketRespostas 
 * @property TicketVoto[] $ticketVotos 
 * @property Ticket[] $tickets 
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
            [['foto_perfil', 'idioma_id', 'senha_hash', 'auth_key', 'token_verificacao_email', 'access_token', 'token_reset_senha', 'expira_token_reset', 'ultimo_acesso'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['admin'], 'default', 'value' => 0],
            [['nome', 'email', 'data_cadastro'], 'required'],
            [['idioma_id'], 'integer'],
            [['expira_token_reset', 'ultimo_acesso', 'data_cadastro'], 'safe'],
            [['status', 'admin'], 'boolean'],
            [['nome', 'email', 'foto_perfil'], 'string', 'max' => 45],
            [['senha_hash', 'token_verificacao_email', 'access_token', 'token_reset_senha'], 'string', 'max' => 255],
            [['auth_key'], 'string', 'max' => 32],
            [['idioma_id'], 'exist', 'skipOnError' => true, 'targetClass' => Idioma::class, 'targetAttribute' => ['idioma_id' => 'id']],
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
            'foto_perfil' => Yii::t('app', 'Foto de perfil'),
            'idioma_id' => Yii::t('app', 'Idioma'),
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
     * Gets query for [[ClienteUsuarios]].
     *
     * @return \yii\db\ActiveQuery|ClienteUsuarioQuery
     */
    public function getClienteUsuarios()
    {
        return $this->hasMany(ClienteUsuario::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Clientes]].
     *
     * @return \yii\db\ActiveQuery|ClienteQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::class, ['id' => 'cliente_id'])->viaTable('cliente_usuario', ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Idioma]].
     *
     * @return \yii\db\ActiveQuery|IdiomaQuery
     */
    public function getIdioma()
    {
        return $this->hasOne(Idioma::class, ['id' => 'idioma_id']);
    }

    /**
     * Gets query for [[Mensagems]].
     *
     * @return \yii\db\ActiveQuery|MensagemQuery
     */
    public function getMensagems()
    {
        return $this->hasMany(Mensagem::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Mensagems0]].
     *
     * @return \yii\db\ActiveQuery|MensagemQuery
     */
    public function getMensagems0()
    {
        return $this->hasMany(Mensagem::class, ['usuario_id_cad' => 'id']);
    }

    /**
     * Gets query for [[NotificacaoSistemas]].
     *
     * @return \yii\db\ActiveQuery|NotificacaoSistemaQuery
     */
    public function getNotificacaoSistemas()
    {
        return $this->hasMany(NotificacaoSistema::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[TicketRespostas]].
     *
     * @return \yii\db\ActiveQuery|TicketRespostaQuery
     */
    public function getTicketRespostas()
    {
        return $this->hasMany(TicketResposta::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[TicketVotos]].
     *
     * @return \yii\db\ActiveQuery|TicketVotoQuery
     */
    public function getTicketVotos()
    {
        return $this->hasMany(TicketVoto::class, ['usuario_id' => 'id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|TicketQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['usuario_id' => 'id']);
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
        $query = self::find()->where(['id' => $id, 'status' => true]);

        if (Yii::$app->id === 'app-backend') {
            $query->andWhere(['admin' => true]);
        }

        return $query->one();
    }

    // Encontra identidade por access token (API futuramente)
    public static function findIdentityByAccessToken($token, $type = null)
    {
        $query = self::find()->where(['access_token' => $token, 'status' => true]);

        if (Yii::$app->id === 'app-backend') {
            $query->andWhere(['admin' => true]);
        }

        return $query->one();
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
        $query = self::find()->where(['email' => $email, 'status' => true]);

        if (Yii::$app->id === 'app-backend') {
            $query->andWhere(['admin' => true]);
        }

        return $query->one();
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
