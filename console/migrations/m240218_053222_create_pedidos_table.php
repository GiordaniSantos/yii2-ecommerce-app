<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%pedidos}}`.
 */
class m240218_053222_create_pedidos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%pedidos}}', [
            'id' => $this->primaryKey(),
            'preco_total' => $this->decimal(10,2)->notNull(),
            'status' => $this->tinyInteger(1)->notNull(),
            'primeiro_nome' => $this->string(45)->notNull(),
            'ultimo_nome' => $this->string(45)->notNull(),
            'email' => $this->string(255)->notNull(),
            'transaction_id' => $this->string(255),
            'data_criacao' => $this->integer(11),
            'criado_por' => $this->integer(11),
        ]);

        // creates index for column `criado_por`
        $this->createIndex(
            '{{%idx-pedidos-criado_por}}',
            '{{%pedidos}}',
            'criado_por'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-pedidos-criado_por}}',
            '{{%pedidos}}',
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
        $this->dropForeignKey(
            '{{%fk-pedidos-criado_por}}',
            '{{%pedidos}}'
        );

        // drops index for column `criado_por`
        $this->dropIndex(
            '{{%idx-pedidos-criado_por}}',
            '{{%pedidos}}'
        );

        $this->dropTable('{{%pedidos}}');
    }
}
