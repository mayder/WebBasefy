<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_voto".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $usuario_id
 * @property string $voto
 * @property string|null $observacao
 * @property string $data_cadastro
 *
 * @property Ticket $ticket
 * @property Usuario $usuario
 */
class TicketVoto extends \yii\db\ActiveRecord
{

    /**
     * ENUM field values
     */
    const VOTO_APROVA = 'aprova';
    const VOTO_REPROVA = 'reprova';

    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_voto';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['observacao'], 'default', 'value' => null],
            [['ticket_id', 'usuario_id', 'voto'], 'required'],
            [['ticket_id', 'usuario_id'], 'integer'],
            [['voto', 'observacao'], 'string'],
            [['data_cadastro'], 'safe'],
            ['voto', 'in', 'range' => array_keys(self::optsVoto())],
            [['ticket_id'], 'exist', 'skipOnError' => true, 'targetClass' => Ticket::class, 'targetAttribute' => ['ticket_id' => 'id']],
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
            'ticket_id' => Yii::t('app', 'Ticket ID'),
            'usuario_id' => Yii::t('app', 'Usuario ID'),
            'voto' => Yii::t('app', 'Voto'),
            'observacao' => Yii::t('app', 'Observacao'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[Ticket]].
     *
     * @return \yii\db\ActiveQuery|TicketQuery
     */
    public function getTicket()
    {
        return $this->hasOne(Ticket::class, ['id' => 'ticket_id']);
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
     * @return TicketVotoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketVotoQuery(get_called_class());
    }


    /**
     * column voto ENUM value labels
     * @return string[]
     */
    public static function optsVoto()
    {
        return [
            self::VOTO_APROVA => Yii::t('app', 'aprova'),
            self::VOTO_REPROVA => Yii::t('app', 'reprova'),
        ];
    }

    /**
     * @return string
     */
    public function displayVoto()
    {
        return self::optsVoto()[$this->voto];
    }

    /**
     * @return bool
     */
    public function isVotoAprova()
    {
        return $this->voto === self::VOTO_APROVA;
    }

    public function setVotoToAprova()
    {
        $this->voto = self::VOTO_APROVA;
    }

    /**
     * @return bool
     */
    public function isVotoReprova()
    {
        return $this->voto === self::VOTO_REPROVA;
    }

    public function setVotoToReprova()
    {
        $this->voto = self::VOTO_REPROVA;
    }
}
