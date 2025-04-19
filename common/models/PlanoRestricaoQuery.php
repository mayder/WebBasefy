<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PlanoRestricao]].
 *
 * @see PlanoRestricao
 */
class PlanoRestricaoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlanoRestricao[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlanoRestricao|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
