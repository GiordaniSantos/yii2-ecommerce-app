<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%user}}`.
 */
class m240220_000118_add_primeiro_nome_ultimo_nome_columns_to_user_table extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn('{{%user}}', 'primeiro_nome', $this->string(255)->notNull()->after('id'));
        $this->addColumn('{{%user}}', 'ultimo_nome', $this->string(255)->notNull()->after('primeiro_nome'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn('{{%user}}', 'primeiro_nome');
        $this->dropColumn('{{%user}}', 'ultimo_nome');
    }
}
