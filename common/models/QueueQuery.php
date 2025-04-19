<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Queue]].
 *
 * @see Queue
 */
class QueueQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Queue[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Queue|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
