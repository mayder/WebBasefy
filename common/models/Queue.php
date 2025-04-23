<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "queue".
 *
 * @property int $id
 * @property string $channel
 * @property resource $job
 * @property int|null $pushed_at
 * @property int|null $ttr
 * @property int|null $delay
 * @property int|null $priority
 * @property int|null $reserved_at
 * @property int|null $done_at
 */
class Queue extends \yii\db\ActiveRecord
{


    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'queue';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pushed_at', 'ttr', 'delay', 'priority', 'reserved_at', 'done_at'], 'default', 'value' => null],
            [['channel', 'job'], 'required'],
            [['job'], 'string'],
            [['pushed_at', 'ttr', 'delay', 'priority', 'reserved_at', 'done_at'], 'integer'],
            [['channel'], 'string', 'max' => 255],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'Id'),
            'channel' => Yii::t('app', 'Channel'),
            'job' => Yii::t('app', 'Job'),
            'pushed_at' => Yii::t('app', 'Pushed At'),
            'ttr' => Yii::t('app', 'Ttr'),
            'delay' => Yii::t('app', 'Delay'),
            'priority' => Yii::t('app', 'Priority'),
            'reserved_at' => Yii::t('app', 'Reserved At'),
            'done_at' => Yii::t('app', 'Done At'),
        ];
    }

    /**
     * {@inheritdoc}
     * @return QueueQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new QueueQuery(get_called_class());
    }
}
