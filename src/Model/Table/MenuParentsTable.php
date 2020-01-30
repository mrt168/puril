<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\ShowFlg;

/**
 * MenuParents Model
 *
 * @method \App\Model\Entity\MenuParent get($primaryKey, $options = [])
 * @method \App\Model\Entity\MenuParent newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MenuParent[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuParent|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MenuParent patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MenuParent[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuParent findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MenuParentsTable extends AppTable
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('menu_parents');
        $this->setDisplayField('menu_parent_id');
        $this->setPrimaryKey('menu_parent_id');

        $this->addBehavior('Timestamp');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('menu_parent_id')
            ->allowEmpty('menu_parent_id', 'create');

        $validator
            ->scalar('menu_name')
            ->maxLength('menu_name', 20)
            ->requirePresence('menu_name', 'create')
            ->notEmpty('menu_name');

        $validator
            ->integer('create_user')
            ->requirePresence('create_user', 'create')
            ->notEmpty('create_user');

        $validator
            ->integer('modify_user')
            ->requirePresence('modify_user', 'create')
            ->notEmpty('modify_user');

        $validator
            ->requirePresence('del_flg', 'create')
            ->notEmpty('del_flg');

        return $validator;
    }

    /**
     * メニュー名でエンティティを検索します.
     */
    public function findByMenuName($menuName) {
    	$options = array(
    			'conditions'=> array (
    					parent::eq('MenuParents.menu_name', $menuName),
    					parent::eq('MenuParents.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			)
    	);

    	return parent::find('all', $options)->first();
    }

    /**
     * 管理者IDで管理画面に表示するメニューの件数を取得します.
     */
    public function isShowMenu($administratorId, $controllerName, $clickUrl) {
    	$options = $this->makeFineShowMenu($administratorId, $controllerName, $clickUrl);
    	$cnt = parent::find('all', $options)->count();
    	if ($cnt == 0) {
    		return false;
    	}
    	return true;
    }

    /**
     * 管理者IDで管理画面に表示するメニュー情報を取得します.
     */
    public function findShowMenu($administratorId) {
    	$options = $this->makeFineShowMenu($administratorId);
    	return $this->convert(parent::find ('all', $options));
    }

    /**
     * メニュー表示条件を生成します.
     */
    private function makeFineShowMenu($administratorId, $controllerName = null, $clickUrl = null) {
    	$options = array (
    			'fields' => array (
    					'MenuParents.menu_parent_id',
    					'MenuParents.menu_name',
    					'MenuChildren.menu_name',
    					'MenuChildren.controller_name',
    					'MenuChildren.action_name',
    					'MenuChildren.click_url'
    			),
    			'conditions'=> array(
    					parent::eq('MenuParents.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'join'=> array(
    					array(
    							'type'=> 'INNER',
    							'table'=> 'menu_parent_orders',
    							'alias'=> 'MenuParentOrder',
    							'conditions'=> array (
    									'MenuParentOrder.menu_parent_id = MenuParents.menu_parent_id',
    									parent::eq('MenuParentOrder.administrator_id', $administratorId),
    									parent::eq('MenuParentOrder.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
    									parent::eq('MenuParentOrder.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							)
    					),
    					array (
    							'type'=> 'INNER',
    							'table'=> 'menu_childrens',
    							'alias'=> 'MenuChildren',
    							'conditions'=> array(
    									'MenuChildren.menu_parent_id = MenuParents.menu_parent_id',
    									parent::eq('MenuChildren.controller_name', $controllerName),
    									parent::eq('MenuChildren.click_url', $clickUrl),
    									parent::eq('MenuChildren.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							)
    					),
    					array (
    							'type' => 'INNER',
    							'table'=> 'menu_child_orders',
    							'alias'=> 'MenuChildOrder',
    							'conditions' => array(
    									'MenuChildOrder.menu_child_id = MenuChildren.menu_child_id',
    									parent::eq('MenuChildOrder.administrator_id', $administratorId ),
    									parent::eq('MenuChildOrder.show_flg', ShowFlg::$SHOW [CodePattern::$CODE] ),
    									parent::eq('MenuChildOrder.del_flg', DelFlg::$MI_SAKUJO [CodePattern::$CODE] )
    							)
    					)
    			),
    			'order' => array (
    					'MenuParentOrder.order_no' => 'asc',
    					'MenuChildOrder.order_no' => 'asc'
    			)
    	);
    	return $options;
    }

    /**
     * 管理者IDでメニュー情報を取得します.
     */
    public function findByAdministratorId($administratorId) {
    	$options = array(
    			'fields'=> array (
    					'MenuParents.menu_parent_id',
    					'MenuParents.menu_name',

    					'MenuParentOrder.parent_order_id',
    					'MenuParentOrder.order_no',
    					'MenuParentOrder.show_flg',

    					'MenuChildren.menu_child_id',
    					'MenuChildren.menu_name',
    					'MenuChildren.controller_name',
    					'MenuChildren.action_name',
    					'MenuChildren.click_url',

    					'MenuChildOrder.child_order_id',
    					'MenuChildOrder.order_no',
    					'MenuChildOrder.show_flg'
    			),
    			'conditions'=> array(
    					parent::eq('MenuParents.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'join'=> array(
    					array(
    							'type'=> 'LEFT',
    							'table'=> 'menu_parent_orders',
    							'alias'=> 'MenuParentOrder',
    							'conditions'=> array (
    									'MenuParentOrder.menu_parent_id = MenuParents.menu_parent_id',
    									parent::eq('MenuParentOrder.administrator_id', $administratorId),
    									parent::eq('MenuParentOrder.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							)
    					),
    					array(
    							'type'=> 'INNER',
    							'table'=> 'menu_childrens',
    							'alias'=> 'MenuChildren',
    							'conditions'=> array (
    									'MenuChildren.menu_parent_id = MenuParents.menu_parent_id',
    									parent::eq('MenuChildren.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							)
    					),
    					array(
    							'type' => 'LEFT',
    							'table' => 'menu_child_orders',
    							'alias' => 'MenuChildOrder',
    							'conditions'=> array (
    									'MenuChildOrder.menu_child_id = MenuChildren.menu_child_id',
    									parent::eq('MenuChildOrder.administrator_id', $administratorId),
    									parent::eq('MenuChildOrder.del_flg', DelFlg::$MI_SAKUJO [CodePattern::$CODE])
    							)
    					)
    			),
    			'order'=> array(
    					'MenuParentOrder.order_no'=> 'asc',
    					'MenuChildOrder.order_no'=> 'asc'
    			)
    	);

    	return $this->convert(parent::find('all', $options));
    }

    /**
     * 使いやすいように検索結果を形成
     */
    public function convert($menuParents) {
    	$menuParents = $menuParents->toArray();

    	$returnValues = array();
    	foreach ($menuParents as $menuParent) {
    		$menuParentId = $menuParent['menu_parent_id'];
    		if (!isset($returnValues[$menuParentId])) {
    			$returnValues[$menuParentId]['menu_name'] = $menuParent['menu_name'];
    			$returnValues[$menuParentId]['menu_parent_id'] = $menuParent['menu_parent_id'];

    			if (!empty($menuParent['MenuParentOrder'])) {
    				$returnValues[$menuParentId]['parent_order_id'] = $menuParent['MenuParentOrder']['parent_order_id'];
    				$returnValues[$menuParentId]['show_flg'] = $menuParent['MenuParentOrder']['show_flg'];
    				$returnValues[$menuParentId]['order_no'] = $menuParent['MenuParentOrder']['order_no'];
    			}

    			$returnValues[$menuParentId]['MenuChildren'] = array();
    			$returnValues[$menuParentId]['MenuChildOrder'] = array();
    		}
    		if (!empty($menuParent['MenuChildOrder'])) {
    			$menuParent['MenuChildren']['menu_child_id'] = $menuParent['MenuChildren']['menu_child_id'];
    			if (!empty($menuParent['MenuChildOrder'])) {
    				$menuParent['MenuChildren']['child_order_id'] = $menuParent['MenuChildOrder']['child_order_id'];
    				$menuParent['MenuChildren']['show_flg'] = $menuParent['MenuChildOrder']['show_flg'];
    				$menuParent['MenuChildren']['order_no'] = $menuParent['MenuChildOrder']['order_no'];
    			}
    		}
    		array_push($returnValues[$menuParentId]['MenuChildren'], $menuParent['MenuChildren']);
    	}
    	return $returnValues;
    }
}
