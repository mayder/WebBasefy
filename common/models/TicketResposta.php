<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_resposta".
 *
 * @property int $id
 * @property int $ticket_id
 * @property int $usuario_id
 * @property string $conteudo
 * @property bool $publico
 * @property string $data_cadastro
 *
 * @property Ticket $ticket
 * @property Usuario $usuario
 */
class TicketResposta extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_resposta';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publico'], 'default', 'value' => 0],
            [['ticket_id', 'usuario_id', 'conteudo'], 'required'],
            [['ticket_id', 'usuario_id'], 'integer'],
            [['conteudo'], 'string'],
            [['publico'], 'boolean'],
            [['data_cadastro'], 'safe'],
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
            'id' => Yii::t('app', 'Id'),
            'ticket_id' => Yii::t('app', 'Ticket'),
            'usuario_id' => Yii::t('app', 'Usuário'),
            'conteudo' => Yii::t('app', 'Conteúdo'),
            'publico' => Yii::t('app', 'Público'),
            'data_cadastro' => Yii::t('app', 'Cadastrado em'),
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
     * @return TicketRespostaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketRespostaQuery(get_called_class());
    }
}
