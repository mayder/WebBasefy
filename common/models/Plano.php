<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plano".
 *
 * @property int $id
 * @property string $nome
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property Cliente[] $clientes
 * @property Modulo[] $modulos
 * @property PlanoModulo[] $planoModulos
 * @property PlanoRestricao[] $planoRestricaos
 */
class Plano extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plano';
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
            'id' => Yii::t('app', 'ID'),
            'nome' => Yii::t('app', 'Nome'),
            'status' => Yii::t('app', 'Status'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[Clientes]].
     *
     * @return \yii\db\ActiveQuery|ClienteQuery
     */
    public function getClientes()
    {
        return $this->hasMany(Cliente::class, ['plano_id' => 'id']);
    }

    /**
     * Gets query for [[Modulos]].
     *
     * @return \yii\db\ActiveQuery|ModuloQuery
     */
    public function getModulos()
    {
        return $this->hasMany(Modulo::class, ['id' => 'modulo_id'])->viaTable('plano_modulo', ['plano_id' => 'id']);
    }

    /**
     * Gets query for [[PlanoModulos]].
     *
     * @return \yii\db\ActiveQuery|PlanoModuloQuery
     */
    public function getPlanoModulos()
    {
        return $this->hasMany(PlanoModulo::class, ['plano_id' => 'id']);
    }

    /**
     * Gets query for [[PlanoRestricaos]].
     *
     * @return \yii\db\ActiveQuery|PlanoRestricaoQuery
     */
    public function getPlanoRestricaos()
    {
        return $this->hasMany(PlanoRestricao::class, ['plano_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return PlanoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanoQuery(get_called_class());
    }

}
