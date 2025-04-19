<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Perfil]].
 *
 * @see Perfil
 */
class PerfilQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Perfil[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Perfil|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
