<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "idioma".
 *
 * @property int $id
 * @property string $nome
 * @property string $sigla
 * @property bool $status
 * @property bool $padrao
 * @property string $data_cadastro
 *
 * @property Usuario[] $usuarios
 */
class Idioma extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'idioma';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['padrao'], 'default', 'value' => 0],
            [['nome', 'sigla'], 'required'],
            [['status', 'padrao'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['nome'], 'string', 'max' => 45],
            [['sigla'], 'string', 'max' => 10],
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
            'sigla' => Yii::t('app', 'Sigla'),
            'status' => Yii::t('app', 'Status'),
            'padrao' => Yii::t('app', 'Padrao'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
    }

    /**
     * Gets query for [[Usuarios]].
     *
     * @return \yii\db\ActiveQuery|UsuarioQuery
     */
    public function getUsuarios()
    {
        return $this->hasMany(Usuario::class, ['idioma_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return IdiomaQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new IdiomaQuery(get_called_class());
    }

}
