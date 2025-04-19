<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "plano_modulo".
 *
 * @property int $id
 * @property int $plano_id
 * @property int $modulo_id
 * @property bool $status
 * @property string $data_cadastro
 *
 * @property Modulo $modulo
 * @property Plano $plano
 */
class PlanoModulo extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'plano_modulo';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['status'], 'default', 'value' => 1],
            [['plano_id', 'modulo_id'], 'required'],
            [['plano_id', 'modulo_id'], 'integer'],
            [['status'], 'boolean'],
            [['data_cadastro'], 'safe'],
            [['plano_id', 'modulo_id'], 'unique', 'targetAttribute' => ['plano_id', 'modulo_id']],
            [['modulo_id'], 'exist', 'skipOnError' => true, 'targetClass' => Modulo::class, 'targetAttribute' => ['modulo_id' => 'id']],
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
            'modulo_id' => Yii::t('app', 'Modulo ID'),
            'status' => Yii::t('app', 'Status'),
            'data_cadastro' => Yii::t('app', 'Data Cadastro'),
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
     * @return PlanoModuloQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new PlanoModuloQuery(get_called_class());
    }

}
