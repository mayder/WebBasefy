<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil".
 *
 * @property int $id
 * @property string $nome
 * @property string $sigla
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property ClienteUsuario[] $clienteUsuarios
 * @property Funcionalidade[] $funcionalidades
 * @property PerfilFuncionalidade[] $perfilFuncionalidades
 */
class Perfil extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['nome', 'sigla'], 'required'],
            [['status'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['nome'], 'string', 'max' => 45],
            [['sigla'], 'string', 'max' => 20],
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
            'sigla' => Yii::t('app', 'Sigla'),
            'status' => Yii::t('app', 'Status'),
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
        return $this->hasMany(ClienteUsuario::class, ['perfil_id' => 'id']);
    }

    /**
     * Gets query for [[Funcionalidades]].
     *
     * @return \yii\db\ActiveQuery|FuncionalidadeQuery
     */
    public function getFuncionalidades()
    {
        return $this->hasMany(Funcionalidade::class, ['id' => 'funcionalidade_id'])->viaTable('perfil_funcionalidade', ['perfil_id' => 'id']);
    }

    /**
     * Gets query for [[PerfilFuncionalidades]].
     *
     * @return \yii\db\ActiveQuery|PerfilFuncionalidadeQuery
     */
    public function getPerfilFuncionalidades()
    {
        return $this->hasMany(PerfilFuncionalidade::class, ['perfil_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PerfilQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PerfilQuery(get_called_class());
    }
}
