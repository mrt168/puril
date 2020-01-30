<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;


/**
 * MenuChildOrders Model
 *
 * @property \App\Model\Table\MenuChildrenTable|\Cake\ORM\Association\BelongsTo $MenuChildren
 * @property \App\Model\Table\AdministratorsTable|\Cake\ORM\Association\BelongsTo $Administrators
 *
 * @method \App\Model\Entity\MenuChildOrder get($primaryKey, $options = [])
 * @method \App\Model\Entity\MenuChildOrder newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MenuChildOrder[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuChildOrder|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MenuChildOrder patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MenuChildOrder[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuChildOrder findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MenuChildOrdersTable extends AppTable
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

        $this->setTable('menu_child_orders');
        $this->setDisplayField('child_order_id');
        $this->setPrimaryKey('child_order_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MenuChildrens', [
            'foreignKey' => 'menu_child_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('AdministratorDatas', [
            'foreignKey' => 'administrator_id',
            'joinType' => 'INNER'
        ]);
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
            ->integer('child_order_id')
            ->allowEmpty('child_order_id', 'create');

        $validator
            ->integer('order_no')
            ->requirePresence('order_no', 'create')
            ->notEmpty('order_no');

        $validator
            ->requirePresence('show_flg', 'create')
            ->notEmpty('show_flg');

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
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        $rules->add($rules->existsIn(['menu_child_id'], 'MenuChildrens'));
        $rules->add($rules->existsIn(['administrator_id'], 'AdministratorDatas'));

        return $rules;
    }

    /**
     * 子メニューIDと管理者IDでエンティティを検索します..
     */
    public function findByMenuChildIdAndAdministratorId($menuChildId, $administratorId) {
    	$options = array (
    			'conditions' => array (
    					parent::eq('MenuChildOrders.menu_child_id', $menuChildId),
    					parent::eq('MenuChildOrders.administrator_id', $administratorId),
    					parent::eq('MenuChildOrders.del_flg', DelFlg::$MI_SAKUJO [CodePattern::$CODE])
    			)
    	);

    	return parent::find('all', $options)->first();
    }
}
