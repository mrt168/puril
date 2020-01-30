<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuChildOrdersTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuChildOrdersTable Test Case
 */
class MenuChildOrdersTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuChildOrdersTable
     */
    public $MenuChildOrders;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menu_child_orders',
        'app.menu_children',
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
        $config = TableRegistry::exists('MenuChildOrders') ? [] : ['className' => MenuChildOrdersTable::class];
        $this->MenuChildOrders = TableRegistry::get('MenuChildOrders', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuChildOrders);

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
