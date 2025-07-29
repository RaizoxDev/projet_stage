<?php

use Phinx\Migration\AbstractMigration;

final class UserMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('user')
        ->addColumn('role', 'json', ['null' => false])
        ->addColumn('email', 'string', ['null' => false])
        ->addIndex(['email'], ['unique' => true])
        ->addColumn('password', 'string', ['null' => false])
        ->create();
    }
}