<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[PerfilFuncionalidade]].
 *
 * @see PerfilFuncionalidade
 */
class PerfilFuncionalidadeQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return PerfilFuncionalidade[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return PerfilFuncionalidade|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
