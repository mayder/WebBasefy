<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PlanoModulo]].
 *
 * @see PlanoModulo
 */
class PlanoModuloQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PlanoModulo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PlanoModulo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
