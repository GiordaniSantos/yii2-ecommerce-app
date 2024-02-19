<?php

namespace common\models;

use Yii;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\FileHelper;

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
    public $imageFile;
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%produtos}}';
    }

    public function behaviors()
    {
        return [
            [
                'class' => TimestampBehavior::class,
                'createdAtAttribute' => 'data_criacao',
                'updatedAtAttribute' => 'data_modificacao',
            ],
            [
                'class' => BlameableBehavior::class,
                'createdByAttribute' => 'criado_por',
                'updatedByAttribute' => 'atualizado_por',
            ],
        ];
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
            [['imageFile'], 'image', 'extensions' => 'png, jpg, jpeg, webp', 'maxSize' => 10 * 1024 * 1024],
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
            'descricao' => 'Descrição',
            'imageFile' => 'Imagem',
            'imagem' => 'Imagem',
            'preco' => 'Preço',
            'status' => 'Ativo',
            'data_criacao' => 'Data de Criação',
            'data_modificacao' => 'Data de Modificação',
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

    public function save($runValidation = true, $attributeNames = null)
    {
        if ($this->imageFile) {
            $this->imagem = '/produtos/' . Yii::$app->security->generateRandomString() . '/' . $this->imageFile->name;
        }

        $transaction = Yii::$app->db->beginTransaction();
        $ok = parent::save($runValidation, $attributeNames);

        if ($ok && $this->imageFile) {
            $fullPath = Yii::getAlias('@frontend/web/storage'.$this->imagem);
            $dir = dirname($fullPath);

            $this->checkIfFileSaved($dir, $fullPath, $transaction);
        }

        $transaction->commit();

        return $ok;
    }

    public function checkIfFileSaved($dir, $fullPath, $transaction)
    {
        if (!FileHelper::createDirectory($dir) | !$this->imageFile->saveAs($fullPath)) {
            $transaction->rollBack();

            return false;
        }
    }

    public function getImageUrl()
    {
        return Yii::$app->params['frontendUrl'] .'/storage'.$this->imagem;
    }
}
