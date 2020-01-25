<?php

use yii\db\Migration;

/**
 * Handles adding columns to table `{{%rating}}`.
 */
class m191126_160623_add_customer_name_column_to_rating_table extends Migration
{
    public $tableName = '{{%rating}}';
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addColumn($this->tableName, 'customer_name', $this->string()->after('iin'));
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        $this->dropColumn($this->tableName, 'customer_name');
    }
}
