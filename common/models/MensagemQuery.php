<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[Mensagem]].
 *
 * @see Mensagem
 */
class MensagemQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return Mensagem[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return Mensagem|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
