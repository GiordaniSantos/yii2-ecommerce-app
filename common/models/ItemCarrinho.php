<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%itens_carrinho}}".
 *
 * @property int $id
 * @property int $produto_id
 * @property int $quantity
 * @property int|null $criado_por
 *
 * @property User $criadoPor
 * @property Produtos $produto
 */
class ItemCarrinho extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%itens_carrinho}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['produto_id', 'quantity'], 'required'],
            [['produto_id', 'quantity', 'criado_por'], 'integer'],
            [['criado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['criado_por' => 'id']],
            [['produto_id'], 'exist', 'skipOnError' => true, 'targetClass' => Produtos::class, 'targetAttribute' => ['produto_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'produto_id' => 'Produto ID',
            'quantity' => 'Quantity',
            'criado_por' => 'Criado Por',
        ];
    }

    /**
     * Gets query for [[CriadoPor]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getCriadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'criado_por']);
    }

    /**
     * Gets query for [[Produto]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ProdutosQuery
     */
    public function getProduto()
    {
        return $this->hasOne(Produtos::class, ['id' => 'produto_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ItemCarrinhoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ItemCarrinhoQuery(get_called_class());
    }
}
