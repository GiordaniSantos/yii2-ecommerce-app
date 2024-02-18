<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%endereco_pedido}}`.
 */
class m240218_054121_create_endereco_pedido_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%endereco_pedido}}', [
            'pedido_id' => $this->integer()->notNull(),
            'endereco' => $this->string(255)->notNull(),
            'cidade' => $this->string(255)->notNull(),
            'estado' => $this->string(255)->notNull(),
            'pais' => $this->string(255)->notNull(),
            'cep' => $this->string(255),
        ]);

        $this->addPrimaryKey('PK_endereco_pedido', '{{%endereco_pedido}}', 'pedido_id');

        // creates index for column `pedido_id`
        $this->createIndex(
            '{{%idx-endereco_pedido-pedido_id}}',
            '{{%endereco_pedido}}',
            'pedido_id'
        );

        // add foreign key for table `{{%pedidos}}`
        $this->addForeignKey(
            '{{%fk-endereco_pedido-pedido_id}}',
            '{{%endereco_pedido}}',
            'pedido_id',
            '{{%pedidos}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropForeignKey(
            '{{%fk-endereco_pedido-pedido_id}}',
            '{{%endereco_pedido}}'
        );

        // drops index for column `pedido_id`
        $this->dropIndex(
            '{{%idx-endereco_pedido-pedido_id}}',
            '{{%endereco_pedido}}'
        );

        $this->dropTable('{{%endereco_pedido}}');
    }
}
