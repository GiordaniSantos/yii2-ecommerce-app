<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\ItemPedido]].
 *
 * @see \common\models\ItemPedido
 */
class ItemPedidoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\ItemPedido[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\ItemPedido|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }
}
