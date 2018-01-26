<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\UsersDoctorsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\UsersDoctorsTable Test Case
 */
class UsersDoctorsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\UsersDoctorsTable
     */
    public $UsersDoctors;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.users_doctors'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('UsersDoctors') ? [] : ['className' => UsersDoctorsTable::class];
        $this->UsersDoctors = TableRegistry::get('UsersDoctors', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->UsersDoctors);

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
