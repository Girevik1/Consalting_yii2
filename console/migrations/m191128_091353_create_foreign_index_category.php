<?php

use yii\db\Migration;

/**
 * Class m191128_091353_create_foreign_index_category
 */
class m191128_091353_create_foreign_index_category extends Migration
{
    /**
     * {@inheritdoc}
     */
    public function safeUp()
    {
        $this->addForeignKey(
            'fk-product-category_id-category-id',
            'product',
            'category_id',
            'category',
            'id',
            'CASCADE'
        );
    }

    /**
     * {@inheritdoc}
     */
    public function safeDown()
    {
        // drops foreign key for table `category`
        $this->dropForeignKey(
            'fk-product-category_id-category-id',
            'product'
        );
    }
}
