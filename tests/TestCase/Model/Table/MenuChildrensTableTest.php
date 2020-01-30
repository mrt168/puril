<?php
namespace App\Test\TestCase\Model\Table;

use App\Model\Table\MenuChildrensTable;
use Cake\ORM\TableRegistry;
use Cake\TestSuite\TestCase;

/**
 * App\Model\Table\MenuChildrensTable Test Case
 */
class MenuChildrensTableTest extends TestCase
{

    /**
     * Test subject
     *
     * @var \App\Model\Table\MenuChildrensTable
     */
    public $MenuChildrens;

    /**
     * Fixtures
     *
     * @var array
     */
    public $fixtures = [
        'app.menu_childrens',
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
        $config = TableRegistry::exists('MenuChildrens') ? [] : ['className' => MenuChildrensTable::class];
        $this->MenuChildrens = TableRegistry::get('MenuChildrens', $config);
    }

    /**
     * tearDown method
     *
     * @return void
     */
    public function tearDown()
    {
        unset($this->MenuChildrens);

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
