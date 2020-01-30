<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuParentsTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuParentsTable Test Case
 */
class MenuParentsTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuParentsTable
     */
    public $MenuParents;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menu_parents'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MenuParents') ? [] : ['className' => MenuParentsTable::class];
        $this->MenuParents = TableRegistry::get('MenuParents', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuParents);

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
}
