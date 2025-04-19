<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[ClienteUsuario]].
 *
 * @see ClienteUsuario
 */
class ClienteUsuarioQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return ClienteUsuario[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return ClienteUsuario|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
