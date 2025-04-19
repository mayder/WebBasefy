<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TicketResposta]].
 *
 * @see TicketResposta
 */
class TicketRespostaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TicketResposta[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TicketResposta|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
