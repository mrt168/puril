<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\CodePattern;
use Cake\ORM\TableRegistry;

/**
 * Payments Model
 *
 * @method \App\Model\Entity\Payment get($primaryKey, $options = [])
 * @method \App\Model\Entity\Payment newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Payment[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Payment|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Payment patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Payment[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Payment findOrCreate($search, callable $callback = null, $options = [])
 */
class PaymentsTable extends AppTable
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

        $this->setTable('payments');
        $this->setDisplayField('name');
        $this->setPrimaryKey('payment_id');

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
            ->integer('payment_id')
            ->allowEmpty('payment_id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 30)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('search_text')
            ->allowEmpty('search_text');

        $validator
            ->scalar('url_text')
            ->allowEmpty('url_text');

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
    			'payment_id'=> $id,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 名前で未削除のデータを検索します.
     */
    public function findByName($name) {
    	$conditions = array (
    			'name'=> $name
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByUrlText($urlText) {
    	$conditions = array (
    			'url_text'=> $urlText,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findBySearchText($searchText) {
    	$conditions = array (
    			parent::likeContain('search_text', $searchText),
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->all();
    }

    /**
     * 識別番号の昇順で未削除のエンティティを検索します.
     */
    public function findByDelFlgOrderById() {
    	$options = array(
    			'conditions'=> array (
    					parent::eq('Payments.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'Payments.payment_id'=> 'ASC'
    			),
    			'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_payments',
    							'alias'=> 'ShopPayment',
    							'conditions'=> [
    									'Payments.payment_id = ShopPayment.payment_id'
    									,parent::eq('ShopPayment.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					]
    			],
    			'fields'=> [
    					'Payments.payment_id',
    					'Payments.name',
    					'Payments.url_text',
    					'cnt'=> 'COUNT(ShopPayment.payment_id)'
    			],
    			'group'=> 'Payments.payment_id'

    	);

    	return parent::find('all', $options);
    }

    /**
     * さらに絞り込むよう
     */
    public function findByMoreNarrow($searchWheres, $isRanking = false) {
    	$shops = TableRegistry::get('Shops');
    	$this->recursive = 0;
    	$shops->belongsToMany = null;
    	$shops->hasMany = null;
//     	$shopSQL = $shops->findForFront($searchWheres);

    	if ($isRanking) {
    		$shopSQL = $shops->findForRankingFront($searchWheres);
    	} else {
    		$shopSQL = $shops->findForFront($searchWheres);
    	}

    	unset($shopSQL->group);
    	unset($shopSQL->order);

    	$subquery = $shopSQL->select('Shops.shop_id')->where(function ($exp, $q) {
    		return $exp->equalFields('Shops.shop_id', 'ShopPayment.shop_id');
    	});

    	$options = array(
    			'conditions'=> array (
    					parent::eq('Payments.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'Payments.payment_id'=> 'ASC'
    			),
    			'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_payments',
    							'alias'=> 'ShopPayment',
    							'conditions'=> [
    									'Payments.payment_id = ShopPayment.payment_id'
    									,parent::eq('ShopPayment.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					]
    			],
    			'fields'=> [
    					'Payments.payment_id',
    					'Payments.name',
    					'Payments.url_text',
    					'Payments.description',
    					'cnt'=> 'COUNT(ShopPayment.payment_id)'
    			],
    			'group'=> 'Payments.payment_id'

    	);
    	return $this->query()->find('all', $options)->where(function ($exp, $q) use ($subquery) {
   			return $exp->exists($subquery);
    	});
    }
}
