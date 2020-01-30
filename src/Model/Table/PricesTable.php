<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;
use Cake\ORM\TableRegistry;

/**
 * Prices Model
 *
 * @method \App\Model\Entity\Price get($primaryKey, $options = [])
 * @method \App\Model\Entity\Price newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Price[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Price|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Price patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Price[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Price findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PricesTable extends AppTable
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

        $this->setTable('prices');
        $this->setDisplayField('name');
        $this->setPrimaryKey('price_id');

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
            ->integer('price_id')
            ->allowEmpty('price_id', 'create');

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
            ->maxLength('url_text', 30)
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
    			'price_id'=> $id,
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
    					parent::eq('Prices.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'Prices.price_id'=> 'ASC'
    			),
    			'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_prices',
    							'alias'=> 'ShopPrice',
    							'conditions'=> [
    									'Prices.price_id = ShopPrice.price_id'
    									,parent::eq('ShopPrice.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					]
    			],
    			'fields'=> [
    					'Prices.price_id',
    					'Prices.name',
    					'Prices.url_text',
    					'cnt'=> 'COUNT(ShopPrice.price_id)'
    			],
    			'group'=> 'Prices.price_id'

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
    		return $exp->equalFields('Shops.shop_id', 'ShopPrice.shop_id');
    	});

    	$options = array(
    			'conditions'=> array (
    					parent::eq('Prices.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'Prices.price_id'=> 'ASC'
    			),
    			'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_prices',
    							'alias'=> 'ShopPrice',
    							'conditions'=> [
    									'Prices.price_id = ShopPrice.price_id'
    									,parent::eq('ShopPrice.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					]
    			],
    			'fields'=> [
    					'Prices.price_id',
    					'Prices.name',
    					'Prices.url_text',
    					'Prices.description',
    					'cnt'=> 'COUNT(ShopPrice.price_id)'
    			],
    			'group'=> 'Prices.price_id'

    	);

    	return $this->query()->find('all', $options)->where(function ($exp, $q) use ($subquery) {
    		return $exp->exists($subquery);
    	});
    }
}
