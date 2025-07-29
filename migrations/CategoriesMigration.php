<?php

use Phinx\Migration\AbstractMigration;

final class CategoriesMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('categories')
        ->addColumn('name', 'string', ['null' => false])
        ->addColumn('slug', 'string', ['null' => false])
        ->addColumn('created_at', 'datettime', ['null' => false])
        ->addColumn('updated_at', 'datettime', ['null' => false])
        ->create();
    }
}