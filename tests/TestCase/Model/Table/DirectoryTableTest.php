<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\DirectoryTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\DirectoryTable Test Case
 */
class DirectoryTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\DirectoryTable
     */
    public $Directory;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.directory',
        'app.users',
        'app.category',
        'app.subcategory',
        'app.date',
        'app.forms',
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
        $config = TableRegistry::exists('Directory') ? [] : ['className' => DirectoryTable::class];
        $this->Directory = TableRegistry::get('Directory', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->Directory);

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
