<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;
use Cake\ORM\TableRegistry;
use App\Vendor\URLUtil;
use App\Vendor\Code\ShowFlg;

/**
 * Brands Model
 *
 * @method \App\Model\Entity\Brand get($primaryKey, $options = [])
 * @method \App\Model\Entity\Brand newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Brand[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Brand|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Brand patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Brand[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Brand findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class BrandsTable extends AppTable
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

        $this->setTable('brands');
        $this->setDisplayField('name');
        $this->setPrimaryKey('brand_id');

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
            ->integer('brand_id')
            ->allowEmpty('brand_id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 30)
            ->allowEmpty('name');

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

    public function validationEdit(Validator $validator) {
    	$validator
    	->scalar('name')
    	->maxLength('name', 30, "ブランド名は30文字以内で入力してください.")
    	->notEmpty('name', "ブランド名を入力してください.");

    	return $validator;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$conditions = array (
    			'brand_id'=> $id,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	// 脱毛部位
    	$this->belongsToMany('DepilationSites', [
    			'className'=> 'DepilationSites',
    			'joinTable'=> 'brand_depilation_sites',
    			'foreignKey'=> 'brand_id',
    			'targetForeignKey'=> 'depilation_site_id',
    			'conditions'=> [
    					parent::eq('DepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    			]
    	]);

    	// 関連URL
    	$this->hasMany('BrandUrls', [
    			'foreignKey' => 'brand_id',
    			'sort' => ['BrandUrls.priority' => 'ASC'],
    	]);

    	return $this->query()
    	->where($conditions)
    	->contain(['DepilationSites', 'BrandUrls'])
    	->first();
    }

    /**
     * 詳細ページ用データの取得
     */
    public function findForDitailById($id) {
    	$conditions = array (
    			'brand_id'=> $id,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	// 店舗
    	$this->hasMany('Shops', [
    			'foreignKey' => 'brand_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);

    	// 脱毛部位
    	$this->belongsToMany('DepilationSites', [
    			'className'=> 'DepilationSites',
    			'joinTable'=> 'brand_depilation_sites',
    			'foreignKey'=> 'brand_id',
    			'targetForeignKey'=> 'depilation_site_id',
    			'conditions'=> [
    					parent::eq('DepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    			]
    	]);

    	// 関連URL
    	$this->hasMany('BrandUrls', [
    			'foreignKey' => 'brand_id'
    			,'sort'=> ['BrandUrls.priority'=> 'ASC']
    	]);

    	return $this->query()
    	->where($conditions)
    	->contain(['Shops', 'DepilationSites', 'BrandUrls'])
    	->first();
    }

    /**
     * 未削除のデータを全件検索します.
     */
    public function findAllByDelFlg() {
    	$conditions = array (
    			'Brands.del_flg' => DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$selects = [
    			'Brands.brand_id',
    			'Brands.name',
    			'Brands.shop_type',
    			'Brands.japanese_syllabary',
    			'Brands.alphabet'
    	];

    	return $this->query()
    	->where($conditions)
    	->select($selects)
    	->all();
    }

    public function makeFindByDelFlgOrderById($wheres = null, $limit = null) {
    	$options = [
    			'fields' => [
    					'Brands.brand_id',
    					'Brands.name',
    					'Brands.shop_type',
    					'Brands.depilation_type',
    					'Brands.image_path',
    					'Brands.japanese_syllabary',
    					'Brands.alphabet',
    			],

    			'conditions'=>[
    					parent::eq('Brands.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'order'=> array('Brands.brand_id'=> 'desc')
    			,'limit'=> $limit
    			,'group'=> 'Brands.brand_id'
    			,'sortWhitelist'=> [
    					'Brands.brand_id',
    			]
    	];

    	if (!empty($wheres)) {
    		if (!empty($wheres['brand_id_from'])) {
    			array_push($options['conditions'], parent::ge('Brands.brand_id', mb_convert_kana($wheres['brand_id_from'], 'n')));
    		}
    		if (!empty($wheres['brand_id_to'])) {
    			array_push($options['conditions'], parent::le('Brands.brand_id', mb_convert_kana($wheres['brand_id_to'], 'n')));
    		}
    		if (!empty($wheres['name'])) {
    			array_push($options['conditions'], parent::likeContain('Brands.name', $wheres['name']));
    		}
    	}

    	return $options;
    }

    public function makeFindForFront($wheres = null, $limit = null) {

   		$monthRanking = null;
    	if (!empty($wheres[URLUtil::MONTH_RANKING_PARA])) {
    		$month = date("Y-m-d H:i:s",strtotime($wheres[URLUtil::MONTH_RANKING_PARA] . "-1 month"));
    		$monthRanking = "Review.post_date >= '{$month}'";
    	}

    	$this->hasMany('Shops', [
    			'foreignKey' => 'brand_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);

    	$options = [
    			'fields' => [
    					'Brands.brand_id',
    					'Brands.name',
    					'Brands.shop_type',
    					'Brands.affiliate_page_url',
    					'Brands.affiliate_banner_url',
    					'Brands.depilation_type',
    					'Brands.image_path',
    					'Brands.japanese_syllabary',
    					'Brands.alphabet',

    					'review_cnt'=> 'COUNT(Review.review_id)',
    					'star'=> 'AVG(Review.evaluation)',
    					'shop_cnt'=> '(SELECT COUNT(Shop.shop_id) FROM shops Shop WHERE Shop.brand_id = Brands.brand_id AND Shop.del_flg = '.DelFlg::$MI_SAKUJO[CodePattern::$CODE].' AND Shop.show_flg = '.ShowFlg::$SHOW[CodePattern::$CODE].')',
    			],

    			'conditions'=>[
    					parent::eq('Brands.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'order'=> ['Brands.star'=> 'desc', 'Brands.review_cnt'=> 'desc']
    			,'limit'=> $limit
    			,'group'=> 'Brands.brand_id'
    			,'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shops',
    							'alias'=> 'Shop',
    							'conditions'=> [
    									'Brands.brand_id = Shop.brand_id'
    									,parent::eq('Shop.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    					[
		    					'type'=> 'INNER',
		    					'table'=> 'reviews',
		    					'alias'=> 'Review',
		    					'conditions'=> [
		    							'Shop.shop_id = Review.shop_id',
		    							parent::eq('Review.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
		    							parent::eq('Review.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
		    							$monthRanking
		    					]
    					],
    			]
    			,'sortWhitelist'=> [
    					'Brands.brand_id',
    					'Brands.star',
    					'Brands.review_cnt'
    			]
    			,'contain'=> ['Shops']
    	];

    	if (!empty($wheres)) {
    		if (!empty($wheres['brand_id_from'])) {
    			array_push($options['conditions'], parent::ge('Brands.brand_id', mb_convert_kana($wheres['brand_id_from'], 'n')));
    		}
    		if (!empty($wheres['brand_id_to'])) {
    			array_push($options['conditions'], parent::le('Brands.brand_id', mb_convert_kana($wheres['brand_id_to'], 'n')));
    		}
    		if (!empty($wheres['name'])) {
    			array_push($options['conditions'], parent::likeContain('Brands.name', $wheres['name']));
    		}

            if (!empty($wheres['shop_type'])) {
                array_push($options['conditions'], parent::eq('Brands.shop_type', $wheres['shop_type']));
            }
    	}

    	return $options;
    }


    /**
     * ブランド名の昇順で未削除のエンティティを検索します.
     */
    public function findByDelFlgOrderByName() {
    	$options = array(
    			'conditions'=> array (
    					parent::eq('Brands.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'Brands.name'=> 'ASC'
    			)
    	);

    	return parent::find('all', $options);
    }

    public function deleteById($id) {
    	if (empty($id)) {
    		return false;
    	}
    	$data = array(
    			'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
    	);
    	$conditions = array(
    			'brand_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
