<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "funcionalidade".
 *
 * @property int $id
 * @property string $nome
 * @property string $chave
 * @property int|null $modulo_id
 * @property string $data_cadastro
 *
 * @property Modulo $modulo
 * @property PerfilFuncionalidade[] $perfilFuncionalidades
 * @property Perfil[] $perfils
 */
class Funcionalidade extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'funcionalidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['modulo_id'], 'default', 'value' => null],
            [['nome', 'chave'], 'required'],
            [['modulo_id'], 'integer'],
            [['data_cadastro'], 'safe'],
            [['nome', 'chave'], 'string', 'max' => 45],
            [['modulo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modulo::class, 'targetAttribute' => ['modulo_id' => 'id']],
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
            'chave' => Yii::t('app', 'Chave'),
            'modulo_id' => Yii::t('app', 'Módulo'),
            'data_cadastro' => Yii::t('app', 'Cadastrado em'),
        ];
    }

    /**
     * Gets query for [[Modulo]].
     *
     * @return \yii\db\ActiveQuery|ModuloQuery
     */
    public function getModulo()
    {
        return $this->hasOne(Modulo::class, ['id' => 'modulo_id']);
    }

    /**
     * Gets query for [[PerfilFuncionalidades]].
     *
     * @return \yii\db\ActiveQuery|PerfilFuncionalidadeQuery
     */
    public function getPerfilFuncionalidades()
    {
        return $this->hasMany(PerfilFuncionalidade::class, ['funcionalidade_id' => 'id']);
    }

    /**
     * Gets query for [[Perfils]].
     *
     * @return \yii\db\ActiveQuery|PerfilQuery
     */
    public function getPerfils()
    {
        return $this->hasMany(Perfil::class, ['id' => 'perfil_id'])->viaTable('perfil_funcionalidade', ['funcionalidade_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return FuncionalidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new FuncionalidadeQuery(get_called_class());
    }
}
