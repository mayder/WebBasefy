<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plano_restricao".
 *
 * @property int $id
 * @property int $plano_id
 * @property string $chave
 * @property string $valor
 * @property string $tipo
 * @property string $data_cadastro
 *
 * @property Plano $plano
 */
class PlanoRestricao extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plano_restricao';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['plano_id', 'chave', 'valor', 'tipo'], 'required'],
            [['plano_id'], 'integer'],
            [['data_cadastro'], 'safe'],
            [['chave', 'valor'], 'string', 'max' => 45],
            [['tipo'], 'string', 'max' => 20],
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
            'plano_id' => Yii::t('app', 'Plano ID'),
            'chave' => Yii::t('app', 'Chave'),
            'valor' => Yii::t('app', 'Valor'),
            'tipo' => Yii::t('app', 'Tipo'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
        ];
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
     * {@inheritdoc}
     * @return PlanoRestricaoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanoRestricaoQuery(get_called_class());
    }

}
