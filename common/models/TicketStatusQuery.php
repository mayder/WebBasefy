<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TicketStatus]].
 *
 * @see TicketStatus
 */
class TicketStatusQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TicketStatus[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TicketStatus|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
