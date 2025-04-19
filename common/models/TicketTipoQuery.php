<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[TicketTipo]].
 *
 * @see TicketTipo
 */
class TicketTipoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return TicketTipo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return TicketTipo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
