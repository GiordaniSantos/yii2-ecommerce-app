<?php

namespace common\models;

use Yii;

/**
 * This is the model class for table "{{%endereco_user}}".
 *
 * @property int $id
 * @property int $user_id
 * @property string $endereco
 * @property string $cidade
 * @property string $estado
 * @property string $pais
 * @property string|null $cep
 *
 * @property User $user
 */
class EnderecoUser extends \yii\db\ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return '{{%endereco_user}}';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['user_id', 'endereco', 'cidade', 'estado', 'pais'], 'required'],
            [['user_id'], 'integer'],
            [['endereco', 'cidade', 'estado', 'pais', 'cep'], 'string', 'max' => 255],
            [['user_id'], 'exist', 'skipOnError' => true, 'targetClass' => User::class, 'targetAttribute' => ['user_id' => 'id']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'user_id' => 'User ID',
            'endereco' => 'Endereco',
            'cidade' => 'Cidade',
            'estado' => 'Estado',
            'pais' => 'Pais',
            'cep' => 'Cep',
        ];
    }

    /**
     * Gets query for [[User]].
     *
     * @return \yii\db\ActiveQuery|\common\models\query\UserQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::class, ['id' => 'user_id']);
    }

    /**
     * {@inheritdoc}
     * @return \common\models\query\EnderecoUserQuery the active query used by this AR class.
     */
    public static function find()
    {
        return new \common\models\query\EnderecoUserQuery(get_called_class());
    }
}
