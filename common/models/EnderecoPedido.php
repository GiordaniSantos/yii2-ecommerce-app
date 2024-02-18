<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%endereco_pedido}}".
 *
 * @property int $pedido_id
 * @property string $endereco
 * @property string $cidade
 * @property string $estado
 * @property string $pais
 * @property string|null $cep
 *
 * @property Pedidos $pedido
 */
class EnderecoPedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%endereco_pedido}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['pedido_id', 'endereco', 'cidade', 'estado', 'pais'], 'required'],
            [['pedido_id'], 'integer'],
            [['endereco', 'cidade', 'estado', 'pais', 'cep'], 'string', 'max' => 255],
            [['pedido_id'], 'unique'],
            [['pedido_id'], 'exist', 'skipOnError' => true, 'targetClass' => Pedidos::class, 'targetAttribute' => ['pedido_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'pedido_id' => 'Pedido ID',
            'endereco' => 'Endereco',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'pais' => 'Pais',
            'cep' => 'Cep',
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
     * {@inheritdoc}
     * @return \common\models\query\EnderecoPedidoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\EnderecoPedidoQuery(get_called_class());
    }
}
