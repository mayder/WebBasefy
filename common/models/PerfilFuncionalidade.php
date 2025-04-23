<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "perfil_funcionalidade".
 *
 * @property int $id
 * @property int $perfil_id
 * @property int $funcionalidade_id
 * @property string $data_cadastro
 *
 * @property Funcionalidade $funcionalidade
 * @property Perfil $perfil
 */
class PerfilFuncionalidade extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'perfil_funcionalidade';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['perfil_id', 'funcionalidade_id'], 'required'],
            [['perfil_id', 'funcionalidade_id'], 'integer'],
            [['data_cadastro'], 'safe'],
            [['perfil_id', 'funcionalidade_id'], 'unique', 'targetAttribute' => ['perfil_id', 'funcionalidade_id']],
            [['funcionalidade_id'], 'exist', 'skipOnError' => true, 'targetClass' => Funcionalidade::class, 'targetAttribute' => ['funcionalidade_id' => 'id']],
            [['perfil_id'], 'exist', 'skipOnError' => true, 'targetClass' => Perfil::class, 'targetAttribute' => ['perfil_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'perfil_id' => Yii::t('app', 'Perfil'),
            'funcionalidade_id' => Yii::t('app', 'Funcionalidade'),
            'data_cadastro' => Yii::t('app', 'Cadastrado em'),
        ];
    }

    /**
     * Gets query for [[Funcionalidade]].
     *
     * @return \yii\db\ActiveQuery|FuncionalidadeQuery
     */
    public function getFuncionalidade()
    {
        return $this->hasOne(Funcionalidade::class, ['id' => 'funcionalidade_id']);
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
     * {@inheritdoc}
     * @return PerfilFuncionalidadeQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PerfilFuncionalidadeQuery(get_called_class());
    }
}
