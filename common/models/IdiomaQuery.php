<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Idioma]].
 *
 * @see Idioma
 */
class IdiomaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Idioma[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Idioma|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
