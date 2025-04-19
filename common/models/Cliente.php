<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cliente".
 *
 * @property int $id
 * @property string $nome
 * @property int $plano_id
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property ClienteUsuario[] $clienteUsuarios
 * @property Plano $plano
 * @property Ticket[] $tickets
 * @property Usuario[] $usuarios
 */
class Cliente extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['nome', 'plano_id'], 'required'],
            [['plano_id'], 'integer'],
            [['status'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['nome'], 'string', 'max' => 45],
            [['plano_id'], 'exist', 'skipOnError' => true, 'targetClass' => Plano::class, 'targetAttribute' => ['plano_id' => 'id']],
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
            'plano_id' => Yii::t('app', 'Plano ID'),
            'status' => Yii::t('app', 'Status'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[ClienteUsuarios]].
     *
     * @return \yii\db\ActiveQuery|ClienteUsuarioQuery
     */
    public function getClienteUsuarios()
    {
        return $this->hasMany(ClienteUsuario::class, ['cliente_id' => 'id']);
    }

    /**
     * Gets query for [[Plano]].
     *
     * @return \yii\db\ActiveQuery|PlanoQuery
     */
    public function getPlano()
    {
        return $this->hasOne(Plano::class, ['id' => 'plano_id']);
    }

    /**
     * Gets query for [[Tickets]].
     *
     * @return \yii\db\ActiveQuery|TicketQuery
     */
    public function getTickets()
    {
        return $this->hasMany(Ticket::class, ['cliente_id' => 'id']);
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery|UsuarioQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::class, ['id' => 'usuario_id'])->viaTable('cliente_usuario', ['cliente_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ClienteQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClienteQuery(get_called_class());
    }

}
