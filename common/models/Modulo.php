<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "modulo".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $icone
 * @property int|null $ordem
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property Funcionalidade[] $funcionalidades
 * @property PlanoModulo[] $planoModulos
 * @property Plano[] $planos
 */
class Modulo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'modulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['icone', 'ordem'], 'default', 'value' => null],
            [['status'], 'default', 'value' => 1],
            [['nome'], 'required'],
            [['ordem'], 'integer'],
            [['status'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['nome', 'icone'], 'string', 'max' => 45],
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
            'icone' => Yii::t('app', 'Icone'),
            'ordem' => Yii::t('app', 'Ordem'),
            'status' => Yii::t('app', 'Status'),
            'data_cadastro' => Yii::t('app', 'Cadastrado em'),
        ];
    }

    /**
     * Gets query for [[Funcionalidades]].
     *
     * @return \yii\db\ActiveQuery|FuncionalidadeQuery
     */
    public function getFuncionalidades()
    {
        return $this->hasMany(Funcionalidade::class, ['modulo_id' => 'id']);
    }

    /**
     * Gets query for [[PlanoModulos]].
     *
     * @return \yii\db\ActiveQuery|PlanoModuloQuery
     */
    public function getPlanoModulos()
    {
        return $this->hasMany(PlanoModulo::class, ['modulo_id' => 'id']);
    }

    /**
     * Gets query for [[Planos]].
     *
     * @return \yii\db\ActiveQuery|PlanoQuery
     */
    public function getPlanos()
    {
        return $this->hasMany(Plano::class, ['id' => 'plano_id'])->viaTable('plano_modulo', ['modulo_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return ModuloQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new ModuloQuery(get_called_class());
    }
}
