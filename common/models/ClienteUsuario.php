<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "cliente_usuario".
 *
 * @property int $id
 * @property int $cliente_id
 * @property int $usuario_id
 * @property int $perfil_id
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property Cliente $cliente
 * @property Perfil $perfil
 * @property Usuario $usuario
 */
class ClienteUsuario extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'cliente_usuario';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['cliente_id', 'usuario_id', 'perfil_id'], 'required'],
            [['cliente_id', 'usuario_id', 'perfil_id'], 'integer'],
            [['status'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['cliente_id', 'usuario_id'], 'unique', 'targetAttribute' => ['cliente_id', 'usuario_id']],
            [['cliente_id'], 'exist', 'skipOnError' => true, 'targetClass' => Cliente::class, 'targetAttribute' => ['cliente_id' => 'id']],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::class, 'targetAttribute' => ['perfil_id' => 'id']],
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
            'cliente_id' => Yii::t('app', 'Cliente'),
            'usuario_id' => Yii::t('app', 'Usuário'),
            'perfil_id' => Yii::t('app', 'Perfil'),
            'status' => Yii::t('app', 'Status'),
            'data_cadastro' => Yii::t('app', 'Cadastrado em'),
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
     * Gets query for [[Perfil]].
     *
     * @return \yii\db\ActiveQuery|PerfilQuery
     */
    public function getPerfil()
    {
        return $this->hasOne(Perfil::class, ['id' => 'perfil_id']);
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
     * @return ClienteUsuarioQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ClienteUsuarioQuery(get_called_class());
    }
}
