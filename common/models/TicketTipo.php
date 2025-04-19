<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "ticket_tipo".
 *
 * @property int $id
 * @property string $nome
 * @property bool $publico
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property Ticket[] $tickets
 */
class TicketTipo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'ticket_tipo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['publico'], 'default', 'value' => 0],
            [['status'], 'default', 'value' => 1],
            [['nome'], 'required'],
            [['publico', 'status'], 'boolean'],
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
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'publico' => Yii::t('app', 'Publico'),
            'status' => Yii::t('app', 'Status'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|TicketQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['tipo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return TicketTipoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new TicketTipoQuery(get_called_class());
    }

}
