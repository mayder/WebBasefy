<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket".
 *
 * @property int $id
 * @property int $usuario_id
 * @property int|null $cliente_id
 * @property string $titulo
 * @property string|null $descricao
 * @property int $tipo_id
 * @property int $status_id
 * @property bool $publico
 * @property string|null $prioridade
 * @property int|null $voto
 * @property string|null $data_resposta
 * @property string $data_cadastro
 *
 * @property Cliente $cliente
 * @property TicketStatus $status
 * @property TicketResposta[] $ticketRespostas
 * @property TicketVoto[] $ticketVotos
 * @property TicketTipo $tipo
 * @property Usuario $usuario
 */
class Ticket extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const PRIORIDADE_BAIXA = 'baixa';
    const PRIORIDADE_MEDIA = 'media';
    const PRIORIDADE_ALTA = 'alta';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['cliente_id', 'descricao', 'prioridade', 'data_resposta'], 'default', 'value' => null],
            [['voto'], 'default', 'value' => 0],
            [['usuario_id', 'titulo', 'tipo_id', 'status_id'], 'required'],
            [['usuario_id', 'cliente_id', 'tipo_id', 'status_id', 'voto'], 'integer'],
            [['descricao', 'prioridade'], 'string'],
            [['publico'], 'boolean'],
            [['data_resposta', 'data_cadastro'], 'safe'],
            [['titulo'], 'string', 'max' => 100],
            ['prioridade', 'in', 'range' => array_keys(self::optsPrioridade())],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['status_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketStatus::class, 'targetAttribute' => ['status_id' => 'id']],
            [['tipo_id'], 'exist', 'skipOnError' => true, 'targetClass' => TicketTipo::class, 'targetAttribute' => ['tipo_id' => 'id']],
            [['usuario_id'], 'exist', 'skipOnError' => true, 'targetClass' => Usuario::class, 'targetAttribute' => ['usuario_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'cliente_id' => Yii::t('app', 'Cliente ID'),
            'titulo' => Yii::t('app', 'Titulo'),
            'descricao' => Yii::t('app', 'Descricao'),
            'tipo_id' => Yii::t('app', 'Tipo ID'),
            'status_id' => Yii::t('app', 'Status ID'),
            'publico' => Yii::t('app', 'Publico'),
            'prioridade' => Yii::t('app', 'Prioridade'),
            'voto' => Yii::t('app', 'Voto'),
            'data_resposta' => Yii::t('app', 'Data Resposta'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[Cliente]].
     *
     * @return \yii\db\ActiveQuery|ClienteQuery
     */
    public function getCliente()
    {
        return $this->hasOne(Cliente::class, ['id' => 'cliente_id']);
    }

    /**
     * Gets query for [[Status]].
     *
     * @return \yii\db\ActiveQuery|TicketStatusQuery
     */
    public function getStatus()
    {
        return $this->hasOne(TicketStatus::class, ['id' => 'status_id']);
    }

    /**
     * Gets query for [[TicketRespostas]].
     *
     * @return \yii\db\ActiveQuery|TicketRespostaQuery
     */
    public function getTicketRespostas()
    {
        return $this->hasMany(TicketResposta::class, ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[TicketVotos]].
     *
     * @return \yii\db\ActiveQuery|TicketVotoQuery
     */
    public function getTicketVotos()
    {
        return $this->hasMany(TicketVoto::class, ['ticket_id' => 'id']);
    }

    /**
     * Gets query for [[Tipo]].
     *
     * @return \yii\db\ActiveQuery|TicketTipoQuery
     */
    public function getTipo()
    {
        return $this->hasOne(TicketTipo::class, ['id' => 'tipo_id']);
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
     * {@inheritdoc}
     * @return TicketQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketQuery(get_called_class());
    }


    /**
     * column prioridade ENUM value labels
     * @return string[]
     */
    public static function optsPrioridade()
    {
        return [
            self::PRIORIDADE_BAIXA => Yii::t('app', 'baixa'),
            self::PRIORIDADE_MEDIA => Yii::t('app', 'media'),
            self::PRIORIDADE_ALTA => Yii::t('app', 'alta'),
        ];
    }

    /**
     * @return string
     */
    public function displayPrioridade()
    {
        return self::optsPrioridade()[$this->prioridade];
    }

    /**
     * @return bool
     */
    public function isPrioridadeBaixa()
    {
        return $this->prioridade === self::PRIORIDADE_BAIXA;
    }

    public function setPrioridadeToBaixa()
    {
        $this->prioridade = self::PRIORIDADE_BAIXA;
    }

    /**
     * @return bool
     */
    public function isPrioridadeMedia()
    {
        return $this->prioridade === self::PRIORIDADE_MEDIA;
    }

    public function setPrioridadeToMedia()
    {
        $this->prioridade = self::PRIORIDADE_MEDIA;
    }

    /**
     * @return bool
     */
    public function isPrioridadeAlta()
    {
        return $this->prioridade === self::PRIORIDADE_ALTA;
    }

    public function setPrioridadeToAlta()
    {
        $this->prioridade = self::PRIORIDADE_ALTA;
    }
}
