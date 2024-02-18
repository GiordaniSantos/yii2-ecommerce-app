<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%itens_carrinho}}`.
 */
class m240218_054558_create_itens_carrinho_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%itens_carrinho}}', [
            'id' => $this->primaryKey(),
            'produto_id' => $this->integer(11)->notNull(),
            'quantity' => $this->integer(2)->notNull(),
            'criado_por' => $this->integer(11)
        ]);

        $this->createIndex(
            '{{%idx-itens_carrinho-produto_id}}',
            '{{%itens_carrinho}}',
            'produto_id'
        );

        // add foreign key for table `{{%produtos}}`
        $this->addForeignKey(
            '{{%fk-itens_carrinho-produto_id}}',
            '{{%itens_carrinho}}',
            'produto_id',
            '{{%produtos}}',
            'id',
            'CASCADE'
        );


        // creates index for column `criado_por`
        $this->createIndex(
            '{{%idx-itens_carrinho-criado_por}}',
            '{{%itens_carrinho}}',
            'criado_por'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-itens_carrinho-criado_por}}',
            '{{%itens_carrinho}}',
            'criado_por',
            '{{%user}}',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `{{%produtos}}`
        $this->dropForeignKey(
            '{{%fk-itens_carrinho-produto_id}}',
            '{{%itens_carrinho}}'
        );

        // drops index for column `produto_id`
        $this->dropIndex(
            '{{%idx-itens_carrinho-produto_id}}',
            '{{%itens_carrinho}}'
        );

        // drops foreign key for table `{{%orders}}`
        $this->dropForeignKey(
            '{{%fk-itens_carrinho-criado_por}}',
            '{{%itens_carrinho}}'
        );

        // drops index for column `criado_por`
        $this->dropIndex(
            '{{%idx-itens_carrinho-criado_por}}',
            '{{%itens_carrinho}}'
        );

        $this->dropTable('{{%itens_carrinho}}');
    }
}
