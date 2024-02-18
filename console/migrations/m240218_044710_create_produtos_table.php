<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%produtos}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 * - `{{%user}}`
 */
class m240218_044710_create_produtos_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%produtos}}', [
            'id' => $this->primaryKey(),
            'nome' => $this->string(255)->notNull(),
            'descricao' => $this->text(),
            'imagem' => $this->string(2000),
            'preco' => $this->decimal(10,2)->notNull(),
            'status' => $this->tinyInteger(2)->notNull(),
            'data_criacao' => $this->integer(11),
            'data_modificacao' => $this->integer(11),
            'criado_por' => $this->integer(11),
            'atualizado_por' => $this->integer(11),
        ]);

        // creates index for column `criado_por`
        $this->createIndex(
            '{{%idx-produtos-criado_por}}',
            '{{%produtos}}',
            'criado_por'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-produtos-criado_por}}',
            '{{%produtos}}',
            'criado_por',
            '{{%user}}',
            'id',
            'CASCADE'
        );

        // creates index for column `atualizado_por`
        $this->createIndex(
            '{{%idx-produtos-atualizado_por}}',
            '{{%produtos}}',
            'atualizado_por'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-produtos-atualizado_por}}',
            '{{%produtos}}',
            'atualizado_por',
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
        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-produtos-criado_por}}',
            '{{%produtos}}'
        );

        // drops index for column `criado_por`
        $this->dropIndex(
            '{{%idx-produtos-criado_por}}',
            '{{%produtos}}'
        );

        // drops foreign key for table `{{%user}}`
        $this->dropForeignKey(
            '{{%fk-produtos-atualizado_por}}',
            '{{%produtos}}'
        );

        // drops index for column `atualizado_por`
        $this->dropIndex(
            '{{%idx-produtos-atualizado_por}}',
            '{{%produtos}}'
        );

        $this->dropTable('{{%produtos}}');
    }
}
