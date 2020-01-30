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
 * Areas Model
 *
 * @method \App\Model\Entity\Area get($primaryKey, $options = [])
 * @method \App\Model\Entity\Area newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Area[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Area|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Area patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Area[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Area findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AreasTable extends AppTable
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

        $this->setTable('areas');
        $this->setDisplayField('name');
        $this->setPrimaryKey('area_id');

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
            ->integer('area_id')
            ->allowEmpty('area_id', 'create');

        $validator
            ->requirePresence('pref', 'create')
            ->notEmpty('pref');

        $validator
            ->scalar('name')
            ->maxLength('name', 512)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->requirePresence('area_type', 'create')
            ->notEmpty('area_type');

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
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$conditions = array (
    			'area_id'=> $id,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByPref($pref, $isRanking = false) {
    	$conditions = array (
    			'Areas.pref'=> $pref,
    			'Areas.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$joins=[
    			[
    					'table' => 'shops',
    					'alias' => 'Shop',
    					'type' => 'LEFT',
    					'conditions' => [
    							'Shop.area_id = Areas.area_id',
    							parent::eq('Shop.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
    							parent::eq('Shop.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    					]
    			],
    	];

    	if ($isRanking) {
    		array_push($joins, [
		    			'table' => 'reviews',
		    			'alias' => 'Review',
		    			'type' => 'INNER',
		    			'conditions' => [
		    					'Review.shop_id = Shop.shop_id',
		    					parent::eq('Review.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
		    					parent::eq('Review.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
		    			]
    			]);
    	}

    	$selects = [
    			'cnt'=> 'COUNT(Shop.shop_id)'
    	];

    	return $this->query()
    	->join($joins)
    	->select($this)
    	->select($selects)
    	->where($conditions)
    	->group(['Areas.area_id'])
    	->all();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByName($name) {
    	$conditions = array (
    			parent::likeContain('name', $name),
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->all();
    }

    public function findByPrefAndName($pref, $name) {
    	$conditions = array (
    			parent::eq('pref', $pref),
    			parent::eq('name', $name),
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }
}
