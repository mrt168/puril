<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;

/**
 * MenuChildrens Model
 *
 * @property \App\Model\Table\MenuParentsTable|\Cake\ORM\Association\BelongsTo $MenuParents
 *
 * @method \App\Model\Entity\MenuChildren get($primaryKey, $options = [])
 * @method \App\Model\Entity\MenuChildren newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\MenuChildren[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\MenuChildren|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\MenuChildren patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\MenuChildren[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\MenuChildren findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class MenuChildrensTable extends AppTable
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

        $this->setTable('menu_childrens');
        $this->setDisplayField('menu_child_id');
        $this->setPrimaryKey('menu_child_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('MenuParents', [
            'foreignKey' => 'menu_parent_id',
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
            ->integer('menu_child_id')
            ->allowEmpty('menu_child_id', 'create');

        $validator
            ->scalar('menu_name')
            ->maxLength('menu_name', 20)
            ->requirePresence('menu_name', 'create')
            ->notEmpty('menu_name');

        $validator
            ->scalar('controller_name')
            ->maxLength('controller_name', 20)
            ->requirePresence('controller_name', 'create')
            ->notEmpty('controller_name');

        $validator
            ->scalar('action_name')
            ->maxLength('action_name', 20)
            ->requirePresence('action_name', 'create')
            ->notEmpty('action_name');

        $validator
            ->scalar('click_url')
            ->maxLength('click_url', 20)
            ->requirePresence('click_url', 'create')
            ->notEmpty('click_url');

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
        $rules->add($rules->existsIn(['menu_parent_id'], 'MenuParents'));

        return $rules;
    }

    /**
     * メニュー名でエンティティを検索します.
     */
    public function findByParentIdAndMenuName($parentId, $menuName) {
    	$options = array(
    			'conditions'=> array(
    					parent::eq('MenuChildrens.menu_parent_id', $parentId),
    					parent::eq('MenuChildrens.menu_name', $menuName),
    					parent::eq('MenuChildrens.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			)
    	);

    	return parent::find('all', $options)->first();
    }
}
