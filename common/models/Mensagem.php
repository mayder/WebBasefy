<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "mensagem".
 *
 * @property int $id
 * @property string $tipo
 * @property int $usuario_id
 * @property string $titulo
 * @property string $conteudo
 * @property string $status_envio
 * @property int $tentativa
 * @property int $max_tentativa
 * @property string|null $data_agendada
 * @property string|null $data_envio
 * @property string|null $erro
 * @property int $usuario_id_cad
 * @property string $data_cadastro
 *
 * @property Usuario $usuario
 * @property Usuario $usuarioIdCad
 */
class Mensagem extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const TIPO_EMAIL = 'email';
    const TIPO_PUSH = 'push';
    const TIPO_SMS = 'sms';
    const TIPO_WEBHOOK = 'webhook';
    const TIPO_WHATSAPP = 'whatsapp';
    const STATUS_ENVIO_PENDENTE = 'pendente';
    const STATUS_ENVIO_ENVIADO = 'enviado';
    const STATUS_ENVIO_ERRO = 'erro';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'mensagem';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['data_agendada', 'data_envio', 'erro'], 'default', 'value' => null],
            [['status_envio'], 'default', 'value' => 'pendente'],
            [['tentativa'], 'default', 'value' => 0],
            [['max_tentativa'], 'default', 'value' => 5],
            [['tipo', 'usuario_id', 'titulo', 'conteudo', 'usuario_id_cad'], 'required'],
            [['tipo', 'conteudo', 'status_envio', 'erro'], 'string'],
            [['usuario_id', 'tentativa', 'max_tentativa', 'usuario_id_cad'], 'integer'],
            [['data_agendada', 'data_envio', 'data_cadastro'], 'safe'],
            [['titulo'], 'string', 'max' => 100],
            ['tipo', 'in', 'range' => array_keys(self::optsTipo())],
            ['status_envio', 'in', 'range' => array_keys(self::optsStatusEnvio())],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usuario_id' => 'id']],
            [['usuario_id_cad'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usuario_id_cad' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'tipo' => Yii::t('app', 'Tipo'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'titulo' => Yii::t('app', 'Titulo'),
            'conteudo' => Yii::t('app', 'Conteudo'),
            'status_envio' => Yii::t('app', 'Status Envio'),
            'tentativa' => Yii::t('app', 'Tentativa'),
            'max_tentativa' => Yii::t('app', 'Max Tentativa'),
            'data_agendada' => Yii::t('app', 'Data Agendada'),
            'data_envio' => Yii::t('app', 'Data Envio'),
            'erro' => Yii::t('app', 'Erro'),
            'usuario_id_cad' => Yii::t('app', 'Usuario Id Cad'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[Usuario]].
     *
     * @return \yii\db\ActiveQuery|UsuarioQuery
     */
    public function getUsuario()
    {
        return $this->hasOne(Usuario::class, ['id' => 'usuario_id']);
    }

    /**
     * Gets query for [[UsuarioIdCad]].
     *
     * @return \yii\db\ActiveQuery|UsuarioQuery
     */
    public function getUsuarioIdCad()
    {
        return $this->hasOne(Usuario::class, ['id' => 'usuario_id_cad']);
    }

    /**
     * {@inheritdoc}
     * @return MensagemQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new MensagemQuery(get_called_class());
    }


    /**
     * column tipo ENUM value labels
     * @return string[]
     */
    public static function optsTipo()
    {
        return [
            self::TIPO_EMAIL => Yii::t('app', 'email'),
            self::TIPO_PUSH => Yii::t('app', 'push'),
            self::TIPO_SMS => Yii::t('app', 'sms'),
            self::TIPO_WEBHOOK => Yii::t('app', 'webhook'),
            self::TIPO_WHATSAPP => Yii::t('app', 'whatsapp'),
        ];
    }

    /**
     * column status_envio ENUM value labels
     * @return string[]
     */
    public static function optsStatusEnvio()
    {
        return [
            self::STATUS_ENVIO_PENDENTE => Yii::t('app', 'pendente'),
            self::STATUS_ENVIO_ENVIADO => Yii::t('app', 'enviado'),
            self::STATUS_ENVIO_ERRO => Yii::t('app', 'erro'),
        ];
    }

    /**
     * @return string
     */
    public function displayTipo()
    {
        return self::optsTipo()[$this->tipo];
    }

    /**
     * @return bool
     */
    public function isTipoEmail()
    {
        return $this->tipo === self::TIPO_EMAIL;
    }

    public function setTipoToEmail()
    {
        $this->tipo = self::TIPO_EMAIL;
    }

    /**
     * @return bool
     */
    public function isTipoPush()
    {
        return $this->tipo === self::TIPO_PUSH;
    }

    public function setTipoToPush()
    {
        $this->tipo = self::TIPO_PUSH;
    }

    /**
     * @return bool
     */
    public function isTipoSms()
    {
        return $this->tipo === self::TIPO_SMS;
    }

    public function setTipoToSms()
    {
        $this->tipo = self::TIPO_SMS;
    }

    /**
     * @return bool
     */
    public function isTipoWebhook()
    {
        return $this->tipo === self::TIPO_WEBHOOK;
    }

    public function setTipoToWebhook()
    {
        $this->tipo = self::TIPO_WEBHOOK;
    }

    /**
     * @return bool
     */
    public function isTipoWhatsapp()
    {
        return $this->tipo === self::TIPO_WHATSAPP;
    }

    public function setTipoToWhatsapp()
    {
        $this->tipo = self::TIPO_WHATSAPP;
    }

    /**
     * @return string
     */
    public function displayStatusEnvio()
    {
        return self::optsStatusEnvio()[$this->status_envio];
    }

    /**
     * @return bool
     */
    public function isStatusEnvioPendente()
    {
        return $this->status_envio === self::STATUS_ENVIO_PENDENTE;
    }

    public function setStatusEnvioToPendente()
    {
        $this->status_envio = self::STATUS_ENVIO_PENDENTE;
    }

    /**
     * @return bool
     */
    public function isStatusEnvioEnviado()
    {
        return $this->status_envio === self::STATUS_ENVIO_ENVIADO;
    }

    public function setStatusEnvioToEnviado()
    {
        $this->status_envio = self::STATUS_ENVIO_ENVIADO;
    }

    /**
     * @return bool
     */
    public function isStatusEnvioErro()
    {
        return $this->status_envio === self::STATUS_ENVIO_ERRO;
    }

    public function setStatusEnvioToErro()
    {
        $this->status_envio = self::STATUS_ENVIO_ERRO;
    }
}
