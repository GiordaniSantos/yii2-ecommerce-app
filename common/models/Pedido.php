<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%pedidos}}".
 *
 * @property int $id
 * @property float $preco_total
 * @property int $status
 * @property string $primeiro_nome
 * @property string $ultimo_nome
 * @property string $email
 * @property string|null $transaction_id
 * @property int|null $data_criacao
 * @property int|null $criado_por
 *
 * @property User $criadoPor
 * @property EnderecoPedido $enderecoPedido
 * @property ItensPedido[] $itensPedidos
 */
class Pedido extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%pedidos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['preco_total', 'status', 'primeiro_nome', 'ultimo_nome', 'email'], 'required'],
            [['preco_total'], 'number'],
            [['status', 'data_criacao', 'criado_por'], 'integer'],
            [['primeiro_nome', 'ultimo_nome'], 'string', 'max' => 45],
            [['email', 'transaction_id'], 'string', 'max' => 255],
            [['criado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['criado_por' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'preco_total' => 'Preco Total',
            'status' => 'Status',
            'primeiro_nome' => 'Primeiro Nome',
            'ultimo_nome' => 'Ultimo Nome',
            'email' => 'Email',
            'transaction_id' => 'Transaction ID',
            'data_criacao' => 'Data Criacao',
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
     * Gets query for [[EnderecoPedido]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\EnderecoPedidoQuery
     */
    public function getEnderecoPedido()
    {
        return $this->hasOne(EnderecoPedido::class, ['pedido_id' => 'id']);
    }

    /**
     * Gets query for [[ItensPedidos]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ItensPedidoQuery
     */
    public function getItensPedidos()
    {
        return $this->hasMany(ItensPedido::class, ['pedido_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\PedidoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\PedidoQuery(get_called_class());
    }
}
