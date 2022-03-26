<?php
declare(strict_types=1);

use Phinx\Migration\AbstractMigration;

final class CreateUserMigration extends AbstractMigration
{

    /**
     * Migrate Up.
     */
    public function up()
    {
    }

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
        // create the table
        $users = $this->table('resty_user');
        $users->addColumn('email', 'string', ['limit' => 20])
            ->addColumn('mobile', 'string', ['limit' => 40])
            ->addColumn('username', 'string', ['limit' => 40])
            ->addColumn('password', 'string', ['limit' => 100])
            ->addColumn('avatar', 'string', ['limit' => 30])
            ->addColumn('website_name', 'string', ['limit' => 128])
            ->addColumn('website_url', 'string', ['limit' => 128])
            ->addColumn('is_enabled', 'integer', ['limit' => 4])
            ->addColumn('create_time', 'integer')
            ->addColumn('update_time', 'integer', ['null' => true])
            ->addColumn('delete_time', 'integer', ['null' => true])
            ->addIndex(['username', 'email'], ['unique' => true])
            ->create();
    }

    /**
     * Migrate Down.
     */
    public function down()
    {

    }
}
