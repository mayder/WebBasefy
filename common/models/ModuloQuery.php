<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Modulo]].
 *
 * @see Modulo
 */
class ModuloQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Modulo[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Modulo|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
