<?php
use Migrations\AbstractMigration;

class CreateDate extends AbstractMigration
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
        $table = $this->table('date');
        $table->addColumn('json', 'text', [
            'default' => null,
            'null' => false,
        ]);
        $table->create();
        $refTable = $this->table('date');
        $refTable->addColumn('user_id', 'integer', array('signed' => 'disable'))
        ->addForeignKey('user_id', 'users', 'id', array('delete'=> 'CASCADE', 'update' => 'NO_ACTION'))
        ->update();
    }

}
