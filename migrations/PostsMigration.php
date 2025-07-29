<?php

use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Migration\AbstractMigration;

final class PostMigration extends AbstractMigration
{
    public function change(): void
    {
        $this->table('post')
        ->addColumn('name', 'string', ['null' => false])
        ->addColumn('slug', 'string', ['null' => false])
        ->addColumn('image', 'string', ['null' => false])
        ->addColumn('description', 'text', [
            'limit' => MysqlAdapter::TEXT_LONG,
            'null' => false
            ])
        ->addColumn('download', 'string', ['null' => true])
        ->addColumn('page', 'string', ['null' => false])
        ->addColumn('created_at', 'datetime', ['null' => false])
        ->addColumn('updated_at', 'datetime', ['null' => true])
        ->create();
    }
}