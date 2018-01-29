<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\FormsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\FormsTable Test Case
 */
class FormsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\FormsTable
     */
    public $Forms;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.forms',
        'app.users',
        'app.category',
        'app.subcategory',
        'app.date',
        'app.directory',
        'app.profile',
        'app.routines'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('Forms') ? [] : ['className' => FormsTable::class];
        $this->Forms = TableRegistry::get('Forms', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Forms);

        parent::tearDown();
    }

    /**
     * Test initialize method
     *
     * @return void
     */
    public function testInitialize()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test validationDefault method
     *
     * @return void
     */
    public function testValidationDefault()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }

    /**
     * Test buildRules method
     *
     * @return void
     */
    public function testBuildRules()
    {
        $this->markTestIncomplete('Not implemented yet.');
    }
}
