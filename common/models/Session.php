<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "session".
 *
 * @property string $id
 * @property int|null $expire
 * @property resource|null $data
 */
class Session extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'session';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['expire', 'data'], 'default', 'value' => null],
            [['id'], 'required'],
            [['expire'], 'integer'],
            [['data'], 'string'],
            [['id'], 'string', 'max' => 40],
            [['id'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'expire' => Yii::t('app', 'Expire'),
            'data' => Yii::t('app', 'Data'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return SessionQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new SessionQuery(get_called_class());
    }
}
