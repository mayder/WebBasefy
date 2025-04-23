<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_status".
 *
 * @property int $id
 * @property string $nome
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property Ticket[] $tickets
 */
class TicketStatus extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_status';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['nome'], 'required'],
            [['status'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['nome'], 'string', 'max' => 45],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'nome' => Yii::t('app', 'Nome'),
            'status' => Yii::t('app', 'Status'),
            'data_cadastro' => Yii::t('app', 'Cadastrado em'),
        ];
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|TicketQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['status_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketStatusQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketStatusQuery(get_called_class());
    }
}
