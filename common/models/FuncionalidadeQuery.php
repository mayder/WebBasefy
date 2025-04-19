<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Funcionalidade]].
 *
 * @see Funcionalidade
 */
class FuncionalidadeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Funcionalidade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Funcionalidade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
