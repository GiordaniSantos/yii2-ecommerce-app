<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%produtos}}".
 *
 * @property int $id
 * @property string $nome
 * @property string|null $descricao
 * @property string|null $imagem
 * @property float $preco
 * @property int $status
 * @property int|null $data_criacao
 * @property int|null $data_modificacao
 * @property int|null $criado_por
 * @property int|null $atualizado_por
 *
 * @property User $atualizadoPor
 * @property User $criadoPor
 * @property ItensCarrinho[] $itensCarrinhos
 * @property ItensPedido[] $itensPedidos
 */
class Produto extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%produtos}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nome', 'preco', 'status'], 'required'],
            [['descricao'], 'string'],
            [['preco'], 'number'],
            [['status', 'data_criacao', 'data_modificacao', 'criado_por', 'atualizado_por'], 'integer'],
            [['nome'], 'string', 'max' => 255],
            [['imagem'], 'string', 'max' => 2000],
            [['atualizado_por'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['atualizado_por' => 'id']],
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
            'nome' => 'Nome',
            'descricao' => 'Descricao',
            'imagem' => 'Imagem',
            'preco' => 'Preco',
            'status' => 'Status',
            'data_criacao' => 'Data Criacao',
            'data_modificacao' => 'Data Modificacao',
            'criado_por' => 'Criado Por',
            'atualizado_por' => 'Atualizado Por',
        ];
    }

    /**
     * Gets query for [[AtualizadoPor]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getAtualizadoPor()
    {
        return $this->hasOne(User::class, ['id' => 'atualizado_por']);
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
     * Gets query for [[ItensCarrinhos]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ItensCarrinhoQuery
     */
    public function getItensCarrinhos()
    {
        return $this->hasMany(ItensCarrinho::class, ['produto_id' => 'id']);
    }

    /**
     * Gets query for [[ItensPedidos]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\ItensPedidoQuery
     */
    public function getItensPedidos()
    {
        return $this->hasMany(ItensPedido::class, ['produto_id' => 'id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\ProdutoQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\ProdutoQuery(get_called_class());
    }
}