<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuParentOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuParentOrdersTable Test Case
 */
class MenuParentOrdersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuParentOrdersTable
     */
    public $MenuParentOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menu_parent_orders',
        'app.menu_parents',
        'app.administrators'
    ];

    /**
     * setUp method
     *
     * @return void
     */
    public function setUp()
    {
        parent::setUp();
        $config = TableRegistry::exists('MenuParentOrders') ? [] : ['className' => MenuParentOrdersTable::class];
        $this->MenuParentOrders = TableRegistry::get('MenuParentOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuParentOrders);

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
