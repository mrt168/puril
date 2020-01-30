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
 * DepilationSites Model
 *
 * @method \App\Model\Entity\DepilationSite get($primaryKey, $options = [])
 * @method \App\Model\Entity\DepilationSite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\DepilationSite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\DepilationSite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\DepilationSite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\DepilationSite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\DepilationSite findOrCreate($search, callable $callback = null, $options = [])
 */
class DepilationSitesTable extends AppTable
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

        $this->setTable('depilation_sites');
        $this->setDisplayField('name');
        $this->setPrimaryKey('depilation_site_id');

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
            ->integer('depilation_site_id')
            ->allowEmpty('depilation_site_id', 'create');

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
    			'depilation_site_id'=> $id,
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
    					parent::eq('DepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'DepilationSites.depilation_site_id'=> 'ASC'
    			),
    			'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_depilation_sites',
    							'alias'=> 'ShopDepilationSite',
    							'conditions'=> [
    									'DepilationSites.depilation_site_id = ShopDepilationSite.depilation_site_id'
    									,parent::eq('ShopDepilationSite.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					]
    			],
    			'fields'=> [
    					'DepilationSites.depilation_site_id',
    					'DepilationSites.name',
    					'DepilationSites.url_text',
    					'cnt'=> 'COUNT(ShopDepilationSite.shop_depilation_site_id)'
    			],
    			'group'=> 'DepilationSites.depilation_site_id'

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
//     	$shopSQL = $shops->findForRankingFront($searchWheres);

    	if ($isRanking) {
    		$shopSQL = $shops->findForRankingFront($searchWheres);
    	} else {
    		$shopSQL = $shops->findForFront($searchWheres);
    	}

    	unset($shopSQL->group);
    	unset($shopSQL->order);

    	$subquery = $shopSQL->select('Shops.shop_id')->where(function ($exp, $q) {
	    		return $exp->equalFields('Shops.shop_id', 'ShopDepilationSite.shop_id');
	    	});

    	$options = array(
    			'conditions'=> array (
    					parent::eq('DepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'DepilationSites.depilation_site_id'=> 'ASC'
    			),
    			'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_depilation_sites',
    							'alias'=> 'ShopDepilationSite',
    							'conditions'=> [
    									'DepilationSites.depilation_site_id = ShopDepilationSite.depilation_site_id'
    									,parent::eq('ShopDepilationSite.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    			],
    			'fields'=> [
    					'DepilationSites.depilation_site_id',
    					'DepilationSites.name',
    					'DepilationSites.url_text',
    					'DepilationSites.description',
    					'cnt'=> 'COUNT(ShopDepilationSite.shop_depilation_site_id)'
    			],
    			'group'=> 'DepilationSites.depilation_site_id'

    	);

    	return $this->query()->find('all', $options)->where(function ($exp, $q) use ($subquery) {
    		return $exp->exists($subquery);
    	});
    }

}
