<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\CodePattern;

/**
 * Blogs Model
 *
 * @property \App\Model\Table\ShopsTable|\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\Blog get($primaryKey, $options = [])
 * @method \App\Model\Entity\Blog newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Blog[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Blog|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Blog patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Blog[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Blog findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BlogsTable extends AppTable
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

        $this->setTable('blogs');
        $this->setDisplayField('title');
        $this->setPrimaryKey('blog_id');

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
            ->integer('blog_id')
            ->allowEmpty('blog_id', 'create');

        $validator
            ->scalar('title')
            ->maxLength('title', 256)
            ->requirePresence('title', 'create')
            ->notEmpty('title');

        $validator
            ->scalar('content')
            ->requirePresence('content', 'create')
            ->notEmpty('content');

        $validator
            ->dateTime('date')
            ->allowEmpty('date');

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
    			'Blogs.blog_id'=> $id,
    			'Blogs.del_flg' => DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$joins = [
    			'type'=> 'INNER',
    			'table'=> 'shops',
    			'alias'=> 'Shop',
    			'conditions'=> [
    					'Shop.shop_id = Blogs.shop_id'
    					,parent::eq('Shop.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	];

    	return $this->query()
    	->where($conditions)
    	->select($this)
    	->join($joins)
    	->first();
    }

    /**
     * 店舗名で未削除のデータを検索します.
     */
    public function findByShopId($shopId) {
    	$conditions = array (
    			'shop_id'=> $shopId,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->all();
    }

    public function makeFindByDelFlgOrderByDate($limit = null) {
    	$options = [
    			'fields' => [
    					'Blogs.blog_id',
    					'Blogs.shop_id',
    					'Blogs.title',
    					'Blogs.content',
    					'Blogs.date',
    					'Blogs.image_path',
    			],

    			'conditions'=>[
    					parent::eq('Blogs.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'order'=> array('Blogs.date'=> 'desc')
    			,'limit'=> $limit
    	];

    	return $options;
    }

    public function deleteById($id) {
    	if (empty($id)) {
    		return false;
    	}
    	$data = array(
    			'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
    	);
    	$conditions = array(
    			'blog_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
