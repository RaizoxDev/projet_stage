<?php

use Phinx\Migration\AbstractMigration;

final class UserMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('members')
        ->addColumn('name', 'string', ['null' => false])
        ->addColumn('status', 'string', ['null' => false])
        ->addColumn('branch', 'string', ['null' => false])
        ->create();
    }
}