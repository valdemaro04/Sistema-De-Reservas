<?php
use Migrations\AbstractMigration;

class CreateRoutines extends AbstractMigration
{
    /**
     * Change Method.
     *
     * More information on this method is available here:
     * http://docs.phinx.org/en/latest/migrations.html#the-change-method
     * @return void
     */
    public function change()
    {
        $table = $this->table('routines');
        $table->addColumn('json', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
        $refTable = $this->table('routines');
        $refTable->addColumn('user_id', 'integer', array('signed' => 'disable'))
        ->addForeignKey('user_id', 'users', 'id', array('delete'=> 'CASCADE', 'update' => 'NO_ACTION'))
        ->update();
    }
}
