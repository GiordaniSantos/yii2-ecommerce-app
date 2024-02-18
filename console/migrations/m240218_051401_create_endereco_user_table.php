<?php

use yii\db\Migration;

/**
 * Handles the creation of table `{{%endereco_user}}`.
 * Has foreign keys to the tables:
 *
 * - `{{%user}}`
 */
class m240218_051401_create_endereco_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->createTable('{{%endereco_user}}', [
            'id' => $this->primaryKey(),
            'user_id' => $this->integer(11)->notNull(),
            'endereco' => $this->string(255)->notNull(),
            'cidade' => $this->string(255)->notNull(),
            'estado' => $this->string(255)->notNull(),
            'pais' => $this->string(255)->notNull(),
            'cep' => $this->string(255),
        ]);

        // creates index for column `user_id`
        $this->createIndex(
            '{{%idx-endereco_user-user_id}}',
            '{{%endereco_user}}',
            'user_id'
        );

        // add foreign key for table `{{%user}}`
        $this->addForeignKey(
            '{{%fk-endereco_user-user_id}}',
            '{{%endereco_user}}',
            'user_id',
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
            '{{%fk-endereco_user-user_id}}',
            '{{%endereco_user}}'
        );

        // drops index for column `user_id`
        $this->dropIndex(
            '{{%idx-endereco_user-user_id}}',
            '{{%endereco_user}}'
        );

        $this->dropTable('{{%endereco_user}}');
    }
}
