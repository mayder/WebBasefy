<?php

namespace common\models;

/**
 * This is the ActiveQuery class for [[NotificacaoSistema]].
 *
 * @see NotificacaoSistema
 */
class NotificacaoSistemaQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return NotificacaoSistema[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return NotificacaoSistema|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
