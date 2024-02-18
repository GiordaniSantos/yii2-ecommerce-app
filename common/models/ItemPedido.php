<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%itens_pedido}}".
 *
 * @property int $id
 * @property string $nome_produto
 * @property int $produto_id
 * @property float $preco_unitario
 * @property int $pedido_id
 * @property int $quantidade
 *
 * @property Pedidos $pedido
 * @property Produtos $produto
 */
class ItemPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%itens_pedido}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome_produto', 'produto_id', 'preco_unitario', 'pedido_id', 'quantidade'], 'required'],
            [['produto_id', 'pedido_id', 'quantidade'], 'integer'],
            [['preco_unitario'], 'number'],
            [['nome_produto'], 'string', 'max' => 255],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::class, 'targetAttribute' => ['pedido_id' => 'id']],
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
            'nome_produto' => 'Nome Produto',
            'produto_id' => 'Produto ID',
            'preco_unitario' => 'Preco Unitario',
            'pedido_id' => 'Pedido ID',
            'quantidade' => 'Quantidade',
        ];
    }

    /**
     * Gets query for [[Pedido]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\PedidosQuery
     */
    public function getPedido()
    {
        return $this->hasOne(Pedidos::class, ['id' => 'pedido_id']);
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
     * @return \common\models\query\ItemPedidoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ItemPedidoQuery(get_called_class());
    }
}
