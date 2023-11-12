<?php

declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class OrdersTableMigration extends AbstractMigration
{
    /**
     * Change Method.
     *
     * Write your reversible migrations using this method.
     *
     * More information on writing migrations is available here:
     * https://book.cakephp.org/phinx/0/en/migrations.html#the-change-method
     *
     * Remember to call "create()" or "update()" and NOT "save()" when working
     * with the Table class.
     */
    public function change(): void
    {
        $table = $this->table('orders');

        $table->addColumn('fullname', 'string')
            ->addColumn('phone', 'string')
            ->addColumn('email', 'string')
            ->addColumn('billing_address', 'string')
            ->addColumn('zipcode', 'string')
            ->addColumn('shipping_method_id', 'smallinteger')
            ->addColumn('total', 'decimal', ['precision' => 2, 'scale' => 5])
            ->addColumn('order_status', 'string')
            ->addTimestamps();

        $table->create();
    }
}
