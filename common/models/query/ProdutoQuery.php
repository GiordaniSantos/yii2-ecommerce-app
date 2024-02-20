<?php

namespace common\models\query;

/**
 * This is the ActiveQuery class for [[\common\models\Produto]].
 *
 * @see \common\models\Produto
 */
class ProdutoQuery extends \yii\db\ActiveQuery
{
    /*public function active()
    {
        return $this->andWhere('[[status]]=1');
    }*/

    /**
     * {@inheritdoc}
     * @return \common\models\Produto[]|array
     */
    public function all($db = null)
    {
        return parent::all($db);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\Produto|array|null
     */
    public function one($db = null)
    {
        return parent::one($db);
    }

    public function ativos()
    {
        return $this->andWhere(['status' => 1]);
    }
}
