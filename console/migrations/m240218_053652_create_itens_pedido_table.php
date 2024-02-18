<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%itens_pedido}}`.
 */
class m240218_053652_create_itens_pedido_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%itens_pedido}}', [
            'id' => $this->primaryKey(),
            'nome_produto' => $this->string(255)->notNull(),
            'produto_id' => $this->integer(11)->notNull(),
            'preco_unitario' => $this->decimal(10,2)->notNull(),
            'pedido_id' => $this->integer(11)->notNull(),
            'quantidade' => $this->integer(2)->notNull(),
        ]);

        $this->createIndex(
            '{{%idx-itens_pedido-produto_id}}',
            '{{%itens_pedido}}',
            'produto_id'
        );

        // add foreign key for table `{{%produtos}}`
        $this->addForeignKey(
            '{{%fk-itens_pedido-produto_id}}',
            '{{%itens_pedido}}',
            'produto_id',
            '{{%produtos}}',
            'id',
            'CASCADE'
        );

        // creates index for column `pedido_id`
        $this->createIndex(
            '{{%idx-itens_pedido-pedido_id}}',
            '{{%itens_pedido}}',
            'pedido_id'
        );

        // add foreign key for table `{{%pedidos}}`
        $this->addForeignKey(
            '{{%fk-itens_pedido-pedido_id}}',
            '{{%itens_pedido}}',
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
            '{{%fk-itens_pedido-produto_id}}',
            '{{%itens_pedido}}'
        );

        // drops index for column `produto_id`
        $this->dropIndex(
            '{{%idx-itens_pedido-produto_id}}',
            '{{%itens_pedido}}'
        );

        // drops foreign key for table `{{%pedidos}}`
        $this->dropForeignKey(
            '{{%fk-itens_pedido-pedido_id}}',
            '{{%itens_pedido}}'
        );

        // drops index for column `pedido_id`
        $this->dropIndex(
            '{{%idx-itens_pedido-pedido_id}}',
            '{{%itens_pedido}}'
        );

        $this->dropTable('{{%itens_pedido}}');
    }
}
