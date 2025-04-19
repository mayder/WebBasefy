<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TicketVoto]].
 *
 * @see TicketVoto
 */
class TicketVotoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TicketVoto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TicketVoto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
