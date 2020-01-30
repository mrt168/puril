<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\CodePattern;

/**
 * Interviews Model
 *
 * @property \App\Model\Table\ShopsTable|\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\Interview get($primaryKey, $options = [])
 * @method \App\Model\Entity\Interview newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Interview[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Interview|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Interview patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Interview[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Interview findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class InterviewsTable extends AppTable
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

        $this->setTable('interviews');
        $this->setDisplayField('title');
        $this->setPrimaryKey('interview_id');

        $this->addBehavior('Timestamp');

//         $this->belongsTo('Shops', [
//             'foreignKey' => 'shop_id',
//             'joinType' => 'INNER'
//         ]);
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
            ->integer('interview_id')
            ->allowEmpty('interview_id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 256, 'タイトルは256文字以内で入力してください。')
            ->requirePresence('title', 'create')
            ->notEmpty('title', 'タイトルを入力してください。');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmpty('content', '本文を入力してください。');

        $validator
            ->scalar('image_path')
            ->maxLength('image_path', 256)
            ->allowEmpty('image_path');

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
//         $rules->add($rules->existsIn(['shop_id'], 'Shops'));

        return $rules;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$conditions = array (
    			'interview_id'=> $id,
    			'del_flg' => DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    public function findByShopId($shopId) {
    	$conditions = array (
    			parent::eq('Interviews.shop_id', $shopId),
    			'Interviews.del_flg' => DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->all();
    }

    public function findByShopIds($shopIds) {
    	$conditions = array (
    			parent::in('Interviews.shop_id', $shopIds),
    			'Interviews.del_flg' => DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$joins=[
    			[
    					'table' => 'shops',
    					'alias' => 'Shop',
    					'type' => 'LEFT',
    					'conditions' => 'Shop.shop_id = Interviews.shop_id'
    			]
    	];

    	$selects = [
    			'Interviews.interview_id',
    			'Interviews.title',
    			'Interviews.image_path',

    			'Shop.shop_id',
    			'Shop.name',
    			'Shop.pref',
    	];

    	return $this->query()
    	->join($joins)
    	->select($selects)
    	->where($conditions)
    	->all();
    }

    public function deleteById($id) {
    	if (empty($id)) {
    		return false;
    	}
    	$data = array(
    			'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
    	);
    	$conditions = array(
    			'interview_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
