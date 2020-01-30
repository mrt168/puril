<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShowFlg;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\ImageType;
use App\Vendor\URLUtil;

/**
 * Shops Model
 *
 * @property \App\Model\Table\AreasTable|\Cake\ORM\Association\BelongsTo $Areas
 *
 * @method \App\Model\Entity\Shop get($primaryKey, $options = [])
 * @method \App\Model\Entity\Shop newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Shop[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Shop|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Shop patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Shop[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Shop findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopsTable extends AppTable
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

        $this->setTable('shops');
        $this->setDisplayField('name');
        $this->setPrimaryKey('shop_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Areas', [
            'foreignKey' => 'area_id',
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
            ->integer('shop_id')
            ->allowEmpty('shop_id', 'create');

        $validator
            ->allowEmpty('pref');

        $validator
            ->scalar('address')
            ->maxLength('address', 1024)
            ->allowEmpty('address');

        $validator
            ->scalar('name')
            ->maxLength('name', 256)
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        $validator
            ->scalar('access')
            ->maxLength('access', 1024)
            ->allowEmpty('access');

        $validator
            ->scalar('business_hours')
            ->maxLength('business_hours', 1024)
            ->allowEmpty('business_hours');

        $validator
            ->scalar('holiday')
            ->maxLength('holiday', 1024)
            ->allowEmpty('holiday');

        $validator
            ->scalar('credit_card')
            ->maxLength('credit_card', 1024)
            ->allowEmpty('credit_card');

        $validator
            ->scalar('facility')
            ->maxLength('facility', 1024)
            ->allowEmpty('facility');

        $validator
            ->scalar('staff')
            ->maxLength('staff', 1024)
            ->allowEmpty('staff');

        $validator
            ->scalar('parking')
            ->maxLength('parking', 1024)
            ->allowEmpty('parking');

        $validator
            ->scalar('conditions')
            ->maxLength('conditions', 2048)
            ->allowEmpty('conditions');

        $validator
            ->scalar('memo')
            ->maxLength('memo', 2048)
            ->allowEmpty('memo');

        $validator
            ->scalar('station')
            ->maxLength('station', 1024)
            ->allowEmpty('station');

        $validator
            ->scalar('scraping_url')
            ->maxLength('scraping_url', 512)
            ->allowEmpty('scraping_url');

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

    public function validationEdit(Validator $validator) {
    	$validator
    	->allowEmpty('pref', "都道府県を選択してください.");

    	$validator
    	->scalar('address')
    	->maxLength('address', 1024, "住所は1024文字以内で入力してください.")
    	->allowEmpty('address', '住所を入力してください.');

    	$validator
    	->scalar('name')
    	->maxLength('name', 256, '店舗名は256文字以内で入力してください.')
    	->requirePresence('name', 'create')
    	->notEmpty('name', '店舗名を入力してください.');

    	$validator
    	->scalar('access')
    	->maxLength('access', 1024, 'アクセス/道案内は1024文字以内で入力してください.')
    	->allowEmpty('access');

    	$validator
    	->scalar('business_hours')
    	->maxLength('business_hours', 1024, '営業時間は1024文字以内で入力してください.')
    	->allowEmpty('business_hours');

    	$validator
    	->scalar('holiday')
    	->maxLength('holiday', 1024, '定休日は1024文字以内で入力してください.')
    	->allowEmpty('holiday');

    	$validator
    	->scalar('credit_card')
    	->maxLength('credit_card', 1024, 'クレジットカードは1024文字以内で入力してください.')
    	->allowEmpty('credit_card');

    	$validator
    	->scalar('facility')
    	->maxLength('facility', 1024, '設備は1024文字以内で入力してください.')
    	->allowEmpty('facility');

    	$validator
    	->scalar('staff')
    	->maxLength('staff', 1024, 'スタッフ数は1024文字以内で入力してください.')
    	->allowEmpty('staff');

    	$validator
    	->scalar('parking')
    	->maxLength('parking', 1024, '駐車場は1024文字以内で入力してください.')
    	->allowEmpty('parking');

    	$validator
    	->scalar('conditions')
    	->maxLength('conditions', 2048, 'こだわり条件は2048文字以内で入力してください.')
    	->allowEmpty('conditions');

    	$validator
    	->scalar('memo')
    	->maxLength('memo', 2048, '備考は2048文字以内で入力してください.')
    	->allowEmpty('memo');

    	$validator
    	->scalar('station')
    	->maxLength('station', 1024, '最寄駅は1024文字以内で入力してください.')
    	->allowEmpty('station');

    	$validator
    	->scalar('scraping_url')
    	->maxLength('scraping_url', 512, 'スクレイピングURLは512文字以内で入力してください.')
    	->allowEmpty('scraping_url');

    	$validator
    	->scalar('word')
    	->maxLength('word', 512, '店舗からのひとことは512文字以内で入力してください.')
    	->allowEmpty('word');

    	$validator
    	->scalar('interview_video_url')
    	->maxLength('interview_video_url', 512, '店舗からのひとことは512文字以内で入力してください.')
    	->allowEmpty('interview_video_url');

    	$validator
    	->requirePresence('show_flg', 'create')
    	->notEmpty('show_flg', '表示フラグを選択してください.');

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
//         $rules->add($rules->existsIn(['area_id'], 'Areas'));

        return $rules;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findById($id) {
    	$conditions = array (
    			'shop_id'=> $id,
    			'del_flg' => DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 店舗名で未削除のデータを検索します.
     */
    public function countByDelFlg() {
    	$conditions = array (
    			'Shops.show_flg'=> ShowFlg::$SHOW[CodePattern::$CODE],
    			'Shops.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->count();
    }

    public function findByPrefAndShopName($pref, $shopName) {
    	$conditions = array (
    			'name'=> $shopName,
    			'pref' => $pref
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 店舗名で未削除のデータを検索します.
     */
    public function findByShopName($shopName) {
    	$conditions = array (
    			'name like'=> "%{$shopName}%",
    	);

    	return $this->query()
    	->where($conditions)
    	->all();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$conditions = array (
    			'Shops.shop_id'=> $id,
    			'Shops.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	// 脱毛部位
    	$this->belongsToMany('DepilationSites', [
    			'className'=> 'DepilationSites',
    			'joinTable'=> 'shop_depilation_sites',
    			'foreignKey'=> 'shop_id',
//     			'associationForeignKey'=> 'depilation_site_id',
    			'targetForeignKey'=> 'depilation_site_id',
    			'conditions'=> [
    					parent::eq('DepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopDepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// 支払方法
    	$this->belongsToMany('Payments', [
    			'className'=> 'Payments',
    			'joinTable'=> 'shop_payments',
    			'foreignKey'=> 'shop_id',
//     			'associationForeignKey'=> 'payment_id',
    			'targetForeignKey'=> 'payment_id',
    			'conditions'=> [
    					parent::eq('Payments.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopPayments.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// 特典・割引
    	$this->belongsToMany('Discounts', [
    			'className'=> 'Discounts',
    			'joinTable'=> 'shop_discounts',
    			'foreignKey'=> 'shop_id',
//     			'associationForeignKey'=> 'discount_id',
    			'targetForeignKey'=> 'discount_id',
    			'conditions'=> [
    					parent::eq('Discounts.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopDiscounts.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// その他こだわり条件
    	$this->belongsToMany('OtherConditions', [
    			'className'=> 'OtherConditions',
    			'joinTable'=> 'shop_other_conditions',
    			'foreignKey'=> 'shop_id',
//     			'associationForeignKey'=> 'other_condition_id',
    			'targetForeignKey'=> 'other_condition_id',
    			'conditions'=> [
    					parent::eq('OtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopOtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// 価格
    	$this->belongsToMany('Prices', [
    			'className'=> 'Prices',
    			'joinTable'=> 'shop_prices',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'price_id',
    			'conditions'=> [
    					parent::eq('Prices.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopPrices.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);

    	// 店舗登録画像
    	$this->hasMany('ShopImages', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('image_type', ImageType::$MAIN[CodePattern::$CODE]),
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'sort'=> ['priority'=> 'asc']
    	]);

    	// 道順画像
    	$this->hasMany('ShopAccessImages', [
    			'className'=> 'ShopImages',
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('image_type', ImageType::$ACCESS[CodePattern::$CODE]),
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'sort'=> ['priority'=> 'asc']
    	]);

    	// 口コミ
    	$this->hasMany('Reviews', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			],
    			'sort'=>['post_date'=> 'desc']
    	]);

    	// スタッフ
    	$this->hasMany('Staffs', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);

    	// インタビュー
    	$this->hasMany('Interviews', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);

    	// お知らせ
    	$this->hasMany('Infos', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			],
    			'sort'=>['date'=> 'desc']
    	]);

    	// ブログ
    	$this->hasMany('Blogs', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			],
    			'sort'=>['date'=> 'desc']
    	]);

    	$joins=[
    			[
    					'table' => 'brands',
    					'alias' => 'Brand',
    					'type' => 'LEFT',
    					'conditions' => 'Brand.brand_id = Shops.brand_id'
    			],
    			[
	    			'table' => 'reviews',
	    			'alias' => 'Review',
	    			'type' => 'LEFT',
	    			'conditions' => [
	    					'Review.shop_id = Shops.shop_id',
	    					parent::eq('Review.show_flg', ShowFlg::$SHOW[CodePattern::$CODE])
	    			]
    			],
    			[
	    			'table' => 'pref_datas',
	    			'alias' => 'PrefData',
	    			'type' => 'LEFT',
	    			'conditions' => 'PrefData.pref = Shops.pref'
    			],
    			[
	    			'table' => 'areas',
	    			'alias' => 'Area',
	    			'type' => 'LEFT',
	    			'conditions' => 'Area.area_id = Shops.area_id'
    			],
    	];

    	$selects = [
    			'Brand.name',
    			'PrefData.url_text',
    			'Area.area_id',
    			'Area.name',

    			'star'=> 'AVG(Review.evaluation)',
    			'review_cnt'=> 'COUNT(Review.review_id)'
    	];

    	return $this->query()
    	->join($joins)
    	->select($this)
    	->select($selects)
    	->where($conditions)
    	->contain(['DepilationSites','Payments','Discounts','OtherConditions','Prices', 'ShopImages', 'ShopAccessImages', 'Reviews', 'Staffs', 'Interviews', 'Infos', 'Blogs'])
    	->first();
    }

    public function findByShopIds($shopIds) {

    	$conditions = array (
    			parent::in('Shops.shop_id', $shopIds),
    			'Shops.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$joins=[
    			[
    					'table' => 'reviews',
    					'alias' => 'Review',
    					'type' => 'LEFT',
    					'conditions' => [
    							'Review.shop_id = Shops.shop_id',
    							parent::eq('Review.show_flg', ShowFlg::$SHOW[CodePattern::$CODE])
    					]
    			]
    	];

    	$selects = [
    			'star'=> 'AVG(Review.evaluation)',
    			'review_cnt'=> 'COUNT(Review.review_id)'
    	];

    	return $this->query()
    	->join($joins)
    	->select($selects)
    	->where($conditions)
    	->first();


    }

    public function findByDelFlgOrderById($wheres = null, $limit = null) {
    	$options = $this->makeFindByDelFlgOrderById($wheres, $limit);

    	// 脱毛部位
    	$this->belongsToMany('DepilationSites', [
    			'className'=> 'DepilationSites',
    			'joinTable'=> 'shop_depilation_sites',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'depilation_site_id',
    			'conditions'=> [
    					parent::eq('DepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopDepilationSites.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// 支払方法
    	$this->belongsToMany('Payments', [
    			'className'=> 'Payments',
    			'joinTable'=> 'shop_payments',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'payment_id',
    			'conditions'=> [
    					parent::eq('Payments.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopPayments.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// 特典・割引
    	$this->belongsToMany('Discounts', [
    			'className'=> 'Discounts',
    			'joinTable'=> 'shop_discounts',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'discount_id',
    			'conditions'=> [
    					parent::eq('Discounts.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopDiscounts.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// その他こだわり条件
    	$this->belongsToMany('OtherConditions', [
    			'className'=> 'OtherConditions',
    			'joinTable'=> 'shop_other_conditions',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'other_condition_id',
    			'conditions'=> [
    					parent::eq('OtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopOtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	// 価格
    	$this->belongsToMany('Prices', [
    			'className'=> 'Prices',
    			'joinTable'=> 'shop_prices',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'price_id',
    			'conditions'=> [
    					parent::eq('Prices.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopPrices.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);

    	$options['contain'] = ['DepilationSites','Payments','Discounts','OtherConditions','Prices'];

    	$joins = [
    			'type'=> 'LEFT',
    			'table'=> 'brands',
    			'alias'=> 'Brand',
    			'conditions'=> [
    					'Brand.brand_id = Shops.brand_id'
    					,parent::eq('Brand.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	];

    	$fields = [
    			'Shops.affiliate_page_url'
    	];

    	array_push($options['join'],[
    			'type'=> 'LEFT',
    			'table'=> 'brands',
    			'alias'=> 'Brand',
    			'conditions'=> [
    					'Brand.brand_id = Shops.brand_id'
    					,parent::eq('Brand.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);
    	array_push($options['join'],[
    			'type'=> 'LEFT',
    			'table'=> 'shop_stations',
    			'alias'=> 'ShopStation',
    			'conditions'=> [
    					'ShopStation.shop_id = Shops.shop_id'
    					,parent::eq('ShopStation.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);


    	$options['fields'] = [];
    	$options['fields'] = [
    			'Shops.shop_id',
    			'Shops.name',
    			'Shops.shop_type',
    			'Shops.pref',
    			'Shops.address',
    			'Shops.access',
    			'Shops.business_hours',
    			'Shops.holiday',
    			'Shops.credit_card',
    			'Shops.facility',
    			'Shops.staff',
    			'Shops.parking',
    			'Shops.conditions',
    			'Shops.memo',
    			'Shops.station',
    			'Shops.price_plan_html',
    			'Shops.word',
    			'Shops.interview_video_url',
    			'Shops.scraping_url',
    			'Shops.description_subject',
    			'Shops.description_content',
    			'Shops.affiliate_page_url',
    			'Shops.affiliate_banner_url',
    			'Shops.show_flg',

    			'Area.name',
    			'Brand.name',
    			'station_cnt'=> 'COUNT(ShopStation.shop_station_id)'
    	];

    	$options['order'] = ['Shops.shop_id'=> 'asc'];

    	return parent::find('all', $options);

    }

    public function makeFindByDelFlgOrderById($wheres = null, $limit = null) {
    	$options = [
    			'fields' => [
    					'Shops.shop_id',
    					'Shops.name',
    					'Shops.pref',
    					'Shops.address',
    					'Shops.shop_type',
    					'Shops.show_flg',
    					'Shops.modified',

    					'Area.name',
    					'ShopOtherCondition.other_condition_id',

    					'imgCnt'=> 'COUNT(ShopImage.shop_image_id)',
    					'imgModified'=> 'MAX(ShopImage.modified)',

    					'staffCnt'=> '(SELECT COUNT(Staff.staff_id) FROM staffs Staff WHERE Staff.shop_id = Shops.shop_id AND Staff.del_flg = '. DelFlg::$MI_SAKUJO[CodePattern::$CODE]. ')',
    					'infoCnt'=> '(SELECT COUNT(Info.info_id) FROM infos Info WHERE Info.shop_id = Shops.shop_id AND Info.del_flg = '. DelFlg::$MI_SAKUJO[CodePattern::$CODE]. ')',
    					'blogCnt'=> '(SELECT COUNT(Blog.blog_id) FROM blogs Blog WHERE Blog.shop_id = Shops.shop_id AND Blog.del_flg = '. DelFlg::$MI_SAKUJO[CodePattern::$CODE]. ')',
    					'interviewCnt'=> '(SELECT COUNT(Interview.interview_id) FROM interviews Interview WHERE Interview.shop_id = Shops.shop_id AND Interview.del_flg = '. DelFlg::$MI_SAKUJO[CodePattern::$CODE]. ')',
    			],

    			'conditions'=>[
    					parent::eq('Shops.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'order'=> array('Shops.shop_id'=> 'desc')
    			,'limit'=> $limit
    			,'group'=> 'Shops.shop_id'
    			,'join'=> [
    					[
    						'type'=> 'LEFT',
    						'table'=> 'areas',
    						'alias'=> 'Area',
    						'conditions'=> [
    								'Area.area_id = Shops.area_id'
    								,parent::eq('Area.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    						]
    					],
    					[
	    					'type'=> 'LEFT',
	    					'table'=> 'shop_images',
	    					'alias'=> 'ShopImage',
	    					'conditions'=> [
	    							'ShopImage.shop_id = Shops.shop_id'
	    							,parent::eq('ShopImage.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
	    					]
    					],
    					[
	    					'type'=> 'LEFT',
	    					'table'=> 'shop_other_conditions',
	    					'alias'=> 'ShopOtherCondition',
	    					'conditions'=> [
	    							'ShopOtherCondition.shop_id = Shops.shop_id',
	    							'ShopOtherCondition.other_condition_id = 1'
	    							,parent::eq('ShopOtherCondition.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    						]
    					],
    			]
    			,'sortWhitelist'=> [
	    				'Shops.shop_id',
    					'Shops.modified',
    			]
    	];

    	if (!empty($wheres)) {
    		if (!empty($wheres['shop_id_from'])) {
    			array_push($options['conditions'], parent::ge('Shops.shop_id', mb_convert_kana($wheres['shop_id_from'], 'n')));
    		}
    		if (!empty($wheres['shop_id_to'])) {
    			array_push($options['conditions'], parent::le('Shops.shop_id', mb_convert_kana($wheres['shop_id_to'], 'n')));
    		}
    		if (!empty($wheres['name'])) {
    			array_push($options['conditions'], parent::likeContain('Shops.name', $wheres['name']));
    		}
    		if (!empty($wheres['pref'])) {
    			array_push($options['conditions'], parent::eq('Shops.pref', $wheres['pref']));
    		}
    		if (!empty($wheres['area_id'])) {
    			array_push($options['conditions'], parent::eq('Shops.area_id', $wheres['area_id']));
    		}
    		if (!empty($wheres['address'])) {
    			array_push($options['conditions'], parent::likeContain('Shops.address', $wheres['address']));
    		}
    		if (!empty($wheres['shop_type'])) {
    			array_push($options['conditions'], parent::in('Shops.shop_type', $wheres['shop_type']));
    		}
    		if (!empty($wheres['show_flg'])) {
    			array_push($options['conditions'], parent::in('Shops.show_flg', $wheres['show_flg']));
    		}

    		// 店舗名アンド検索用
    		if (!empty($wheres['names'])) {
    			foreach ($wheres['names'] as $shopName) {
    				array_push($options['conditions'], parent::likeContain('Shops.name', $shopName));
    			}
    		}

    		// メンズ脱毛
    		if (!empty($wheres['mens'])) {
    			array_push($options['conditions'], parent::eq('ShopOtherCondition.other_condition_id', $wheres['mens']));
    		}

    		// フリーワード検索
    		if (!empty($wheres['free_word'])) {
    			$options['conditions']['or'] = array();
    			array_push($options['conditions']['or'], parent::likeContain('Shops.name', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.address', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.access', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.business_hours', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.holiday', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.credit_card', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.facility', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.staff', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.parking', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.conditions', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.memo', $wheres['free_word']));
    			array_push($options['conditions']['or'], parent::likeContain('Shops.station', $wheres['free_word']));
    		}
    	}

    	return $options;
    }

    /**
     * 検索結果が20件未満時の不足分取得用
     */
    public function findRandForFront($wheres = null, $limit = null, $isShopDetail = false) {
    	$options = $this->makeFindForFront($wheres, $limit);

    	if (!empty($wheres['shop_id'])) {
	    	$shopId = ['NOT' => ['Shops.shop_id IN' => $wheres['shop_id']]];
	    	array_push($options['conditions'], $shopId);
    	}

    	$options['order'] = [];
//     	array_unshift($options['order'], 'rand()');
    	$options['order']['Shops.affiliate_page_url'] = "desc";
    	array_push($options['order'], 'rand()' );

    	if ($isShopDetail) {
	    	if (!empty($wheres['station_cd'])) {
	    		array_push($options['conditions']['or'], parent::in('ShopStation.station_cd', $wheres['station_cd']));
	    	}
	    	if (!empty($wheres['area_id'])) {
	    		array_push($options['conditions']['or'], parent::eq('Shops.area_id', $wheres['area_id']));
	    	}
	    	if (!empty($wheres['pref'])) {
	    		array_push($options['conditions']['or'], parent::eq('Shops.pref', $wheres['pref']));
	    	}
    	}

    	return parent::find('all', $options);
    }

    /**
     * ランキング検索結果が20件未満時の不足分取得用
     */
    public function findRandForRankingFront($wheres = null, $limit = null) {
    	$options = $this->makeFindForRankingFront($wheres, $limit);

    	if (!empty($wheres['shop_id'])) {
    		$shopId = ['NOT' => ['Shops.shop_id IN' => $wheres['shop_id']]];
    		array_push($options['conditions'], $shopId);
    	}

    	$options['order'] = [];
    	$options['order']['Shops.affiliate_page_url'] = "desc";
    	array_push($options['order'], 'rand()' );

    	return parent::find('all', $options);
    }

    public function countForFront($wheres = null, $limit = null) {
		$options = $this->makeFindForFront($wheres, $limit);

		$options['fields'] = 'Shops.shop_id';

		return parent::find('all', $options)->count();
    }

    public function countForRankingFront($wheres = null, $limit = null) {
    	$options = $this->makeFindForRankingFront($wheres, $limit);

    	$options['fields'] = 'Shops.shop_id';

    	return parent::find('all', $options)->count();
    }

    /**
     * フリーワード検索
     */
    public function makeFindForFrontByFreeWord($wheres = null, $limit = null) {
    	$options = $this->makeFindForFront(null, $limit);

    	$options['order'] = ['Shops.affiliate_page_url'=> 'desc'];

    	if (!empty($wheres)) {
    		if (!empty($wheres['shop_type'])) {
    			array_push($options['conditions']['or'], parent::in('Shops.shop_type', $wheres['shop_type']));
    		}
    		if (!empty($wheres['pref'])) {
    			array_push($options['conditions']['or'], parent::in('Shops.pref', $wheres['pref']));
    		}
    		if (!empty($wheres['area_id'])) {
    			array_push($options['conditions']['or'], parent::in('Shops.area_id', $wheres['area_id']));
    		}
    		if (!empty($wheres['depilation_site_id'])) {
    			array_push($options['join'], [
    					'type'=> 'INNER',
    					'table'=> 'shop_depilation_sites',
    					'alias'=> 'ShopDepilationSite',
    					'conditions'=> [
    							'ShopDepilationSite.shop_id = Shops.shop_id'
    							,parent::eq('ShopDepilationSite.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    					]
    			]);
    			array_push($options['conditions']['or'], parent::in('ShopDepilationSite.depilation_site_id', $wheres['depilation_site_id']));
    		}
    		if (!empty($wheres['price_id'])) {
    			array_push($options['join'], [
    					'type'=> 'INNER',
    					'table'=> 'shop_prices',
    					'alias'=> 'ShopPrice',
    					'conditions'=> [
    							'ShopPrice.shop_id = Shops.shop_id'
    							,parent::eq('ShopPrice.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    					]
    			]);
    			array_push($options['conditions']['or'], parent::in('ShopPrice.price_id', $wheres['price_id']));
    		}
    		if (!empty($wheres['payment_id'])) {
    			array_push($options['join'], [
    					'type'=> 'INNER',
    					'table'=> 'shop_payments',
    					'alias'=> 'ShopPayment',
    					'conditions'=> [
    							'ShopPayment.shop_id = Shops.shop_id'
    							,parent::eq('ShopPayment.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    					]
    			]);
    			array_push($options['conditions']['or'], parent::in('ShopPayment.payment_id', $wheres['payment_id']));
    		}
    		if (!empty($wheres['discount_id'])) {
    			array_push($options['join'], [
    					'type'=> 'INNER',
    					'table'=> 'shop_discounts',
    					'alias'=> 'ShopDiscount',
    					'conditions'=> [
    							'ShopDiscount.shop_id = Shops.shop_id'
    							,parent::eq('ShopDiscount.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    					]
    			]);
    			array_push($options['conditions']['or'], parent::in('ShopDiscount.discount_id', $wheres['discount_id']));
    		}
    		if (!empty($wheres['other_condition_id'])) {
    			array_push($options['join'], [
    					'type'=> 'INNER',
    					'table'=> 'shop_other_conditions',
    					'alias'=> 'ShopOtherCondition',
    					'conditions'=> [
    							'ShopOtherCondition.shop_id = Shops.shop_id'
    							,parent::eq('ShopOtherCondition.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    					]
    			]);
    			array_push($options['conditions']['or'], parent::in('ShopOtherCondition.other_condition_id', $wheres['other_condition_id']));
    		}

    		if ($wheres['free_word']) {
				foreach ($wheres['free_word'] as $freeWord) {
					array_push($options['conditions'], parent::likeContain('Shops.name', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.name', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.address', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.access', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.business_hours', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.holiday', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.credit_card', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.staff', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.parking', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.conditions', $freeWord));
					array_push($options['conditions']['or'], parent::likeContain('Shops.station', $freeWord));
				}
    		}
    	}

    	return $options;
    }

    public function findForFront($wheres = null, $limit = null) {

    	$option = $this->makeFindForFront($wheres, $limit);
    	$option['order'] = [];

    	return $this->query()->find('all', $option);
    }

    public function makeFindForRankingFront($wheres = null, $limit = null) {
    	$options = $this->makeFindForFront($wheres, $limit);

    	array_push($options['join'],
    			[
    					'type'=> 'INNER',
    					'table'=> 'reviews',
    					'alias'=> 'Review',
    					'conditions'=> [
    							'Review.shop_id = Shops.shop_id',
    							parent::eq('Review.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
    							parent::eq('Review.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    					]
    			]);

    	$options['fields']['review_cnt'] = 'COUNT(Review.review_id)';
    	$options['fields']['star'] = 'AVG(Review.evaluation)';

    	$options['order'] = ['Shops.star'=> 'desc', 'Shops.review_cnt'=> 'desc'];

    	return $options;
    }
    
    public function makeFindForReviewCount($wheres = null, $limit = null) {
        $options = $this->makeFindForFront($wheres, $limit);

        array_push($options['join'],
            [
                'type'=> 'INNER',
                'table'=> 'reviews',
                'alias'=> 'Review',
                'conditions'=> [
                    'Review.shop_id = Shops.shop_id',
                    parent::eq('Review.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
                    parent::eq('Review.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
                ]
            ]);

        $options['fields']['review_cnt'] = 'COUNT(Review.review_id)';
        $options['fields']['star'] = 'AVG(Review.evaluation)';

        $options['order'] = ['Shops.star'=> 'desc', 'Shops.review_cnt'=> 'desc'];
        
    	$options['group'] = ['Review.review_id'];

        return $options;
    }

    public function findForRankingFront($wheres = null, $limit = null) {

    	$options = $this->makeFindForRankingFront($wheres, $limit);
    	$options['order'] = null;

    	return $this->query()->find('all', $options);
    }

    public function makeFindForFront($wheres = null, $limit = null) {

    	$monthRanking = null;
    	if (!empty($wheres[URLUtil::MONTH_RANKING_PARA])) {
    		$month = date("Y-m-d H:i:s",strtotime($wheres[URLUtil::MONTH_RANKING_PARA] . "-1 month"));
    		$monthRanking = "post_date >= '{$month}'";
    	}

    	$reviewTable= TableRegistry::get('Reviews');
    	$reviewQuery = $reviewTable->query()->where(['shop_id = Shops.shop_id', 'show_flg'=> ShowFlg::$SHOW[CodePattern::$CODE], 'del_flg = '. DelFlg::$MI_SAKUJO[CodePattern::$CODE], $monthRanking]);
    	$reviewCntQuery = $reviewQuery->select(['review_cnt'=> 'COUNT(review_id)'])->sql();

    	$starQuery = $reviewQuery->select(['review_cnt'=> 'AVG(evaluation)'])->sql();

    	// その他こだわり条件
    	$this->belongsToMany('OtherConditions', [
    			'className'=> 'OtherConditions',
    			'joinTable'=> 'shop_other_conditions',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'other_condition_id',
    			'conditions'=> [
    					parent::eq('OtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopOtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);

    	// 店舗登録画像
    	$this->hasMany('ShopImages', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'sort'=> ['priority'=> 'asc']
    	]);

    	$options = [
    			'fields' => [
    					'Shops.shop_id',
    					'Shops.name',
    					'Shops.pref',
    					'Shops.area_id',
    					'Shops.address',
    					'Shops.shop_type',
    					'Shops.show_flg',
    					'Shops.description_subject',
    					'Shops.description_content',
    					'Shops.affiliate_page_url',
    					'Shops.affiliate_banner_url',

    					'Area.name',
    					'Area.area_id',

    					'PrefData.search_text',
    					'PrefData.pref',
    					'PrefData.url_text',

    					'review_cnt'=> "({$reviewCntQuery})",
    					'star'=> "({$starQuery})",
    			],

    			'conditions'=>[
    					parent::eq('Shops.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
    					parent::eq('Shops.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    			]
    			,'order'=> ['Shops.star'=> 'desc', 'Shops.affiliate_page_url'=> 'desc', 'Shops.shop_id'=> 'desc']
    			,'limit'=> $limit
    			,'group'=> ['Shops.shop_id']
    			,'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'areas',
    							'alias'=> 'Area',
    							'conditions'=> [
    									'Area.area_id = Shops.area_id'
    									,parent::eq('Area.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    					[
	    					'type'=> 'LEFT',
	    					'table'=> 'pref_datas',
	    					'alias'=> 'PrefData',
	    					'conditions'=> [
	    							'PrefData.pref = Shops.pref'
	    							,parent::eq('PrefData.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
	    					]
    					]
    			]
    			,'sortWhitelist'=> [
    					'Shops.shop_id',
    					'Shops.created',
    					'Shops.modified',
    					'Shops.star',
    					'Shops.review_cnt',
    					'Shops.affiliate_page_url'
    			]
    			,'contain'=> ['OtherConditions', 'ShopImages']
    	];

    	$options['conditions']['or'] = [];
    	if (!empty($wheres)) {
    		if (!empty($wheres['shop_type'])) {
    			array_push($options['conditions'], parent::in('Shops.shop_type', $wheres['shop_type']));
    		}
    		if (!empty($wheres['pref']) && empty($wheres['station_g_cd'])) {
    			array_push($options['conditions'], parent::in('Shops.pref', $wheres['pref']));
    		}
    		if (!empty($wheres['area_id']) && empty($wheres['station_g_cd'])) {
    			array_push($options['conditions'], parent::in('Shops.area_id', $wheres['area_id']));
    		}
    		if (!empty($wheres['depilation_site_id'])) {
    			array_push($options['join'], [
		    					'type'=> 'INNER',
		    					'table'=> 'shop_depilation_sites',
		    					'alias'=> 'ShopDepilationSite',
		    					'conditions'=> [
		    							'ShopDepilationSite.shop_id = Shops.shop_id'
		    							,parent::eq('ShopDepilationSite.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
		    					]
    					]);

    			array_push($options['conditions'], parent::in('ShopDepilationSite.depilation_site_id', $wheres['depilation_site_id']));
    		}
    		if (!empty($wheres['price_id'])) {
    			array_push($options['join'], [
		    					'type'=> 'INNER',
		    					'table'=> 'shop_prices',
		    					'alias'=> 'ShopPrice',
		    					'conditions'=> [
		    							'ShopPrice.shop_id = Shops.shop_id'
		    							,parent::eq('ShopPrice.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
		    					]
    					]);

    			array_push($options['conditions'], parent::in('ShopPrice.price_id', $wheres['price_id']));
    		}
    		if (!empty($wheres['payment_id'])) {
    			array_push($options['join'], [
		    					'type'=> 'INNER',
		    					'table'=> 'shop_payments',
		    					'alias'=> 'ShopPayment',
		    					'conditions'=> [
		    							'ShopPayment.shop_id = Shops.shop_id'
		    							,parent::eq('ShopPayment.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
		    					]
    					]);

    			array_push($options['conditions'], parent::in('ShopPayment.payment_id', $wheres['payment_id']));
    		}
    		if (!empty($wheres['discount_id'])) {
    			array_push($options['join'], [
		    					'type'=> 'INNER',
		    					'table'=> 'shop_discounts',
		    					'alias'=> 'ShopDiscount',
		    					'conditions'=> [
		    							'ShopDiscount.shop_id = Shops.shop_id'
		    							,parent::eq('ShopDiscount.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
		    					]
    					]);

    			array_push($options['conditions'], parent::in('ShopDiscount.discount_id', $wheres['discount_id']));
    		}
    		if (!empty($wheres['other_condition_id'])) {
    			array_push($options['join'], [
		    					'type'=> 'INNER',
		    					'table'=> 'shop_other_conditions',
		    					'alias'=> 'ShopOtherCondition',
		    					'conditions'=> [
		    							'ShopOtherCondition.shop_id = Shops.shop_id'
		    							,parent::eq('ShopOtherCondition.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
		    					]
    					]);

    			array_push($options['conditions'], parent::in('ShopOtherCondition.other_condition_id', $wheres['other_condition_id']));
    		}
    		if (!empty($wheres['station_g_cd']) || !empty($wheres['station_cd'])) {

    			$stationCd = [];
    			if (!empty($wheres['station_g_cd'])) {
					$stationCd = $wheres['station_g_cd'];
    			} else if (!empty($wheres['station_cd'])) {
    				$stationCd = $wheres['station_cd'];
    			}

    			array_push($options['join'], [
	    					'type'=> 'INNER',
	    					'table'=> 'shop_stations',
	    					'alias'=> 'ShopStation',
	    					'conditions'=> [
	    							'ShopStation.shop_id = Shops.shop_id'
	    							,parent::eq('ShopStation.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
	    					]
    					]);
    			array_push($options['join'], [
    							'type'=> 'INNER',
    							'table'=> 'stations',
    							'alias'=> 'Station',
    							'conditions'=> [
    									'Station.station_cd = ShopStation.station_cd'
    							]
    					]);


    			array_push($options['conditions'], parent::in('ShopStation.station_cd', $stationCd));
    		}
    	}

    	return $options;
    }

    public function makePickupByPrefNotnullAffPageUrl($prefCode, $limit = null) {
    	$reviewTable= TableRegistry::get('Reviews');
    	$reviewQuery = $reviewTable->query()->where(['shop_id = Shops.shop_id', 'del_flg = '. DelFlg::$MI_SAKUJO[CodePattern::$CODE]]);
    	$reviewCntQuery = $reviewQuery->select(['review_cnt'=> 'COUNT(review_id)'])->sql();

    	$starQuery = $reviewQuery->select(['review_cnt'=> 'AVG(evaluation)'])->sql();

    	// その他こだわり条件
    	$this->belongsToMany('OtherConditions', [
    			'className'=> 'OtherConditions',
    			'joinTable'=> 'shop_other_conditions',
    			'foreignKey'=> 'shop_id',
    			'targetForeignKey'=> 'other_condition_id',
    			'conditions'=> [
    					parent::eq('OtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('ShopOtherConditions.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    	]);


    	// 店舗登録画像
    	$this->hasMany('ShopImages', [
    			'foreignKey' => 'shop_id'
    			,'conditions'=> [
    					parent::eq('del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'sort'=> ['priority'=> 'asc']
    	]);

    	$options = [
    			'fields' => [
    					'Shops.shop_id',
    					'Shops.name',
    					'Shops.pref',
    					'Shops.area_id',
    					'Shops.address',
    					'Shops.shop_type',
    					'Shops.show_flg',
    					'Shops.description_subject',
    					'Shops.description_content',
    					'Shops.affiliate_page_url',
    					'Shops.affiliate_banner_url',

    					'Area.name',
    					'Area.area_id',

    					'PrefData.search_text',
    					'PrefData.pref',
    					'PrefData.url_text',

    					'Station.station_cd',
    					'Station.station_g_cd',
    					'Station.station_name',

    					'review_cnt'=> "({$reviewCntQuery})",
    					'star'=> "({$starQuery})",
    					],

    			'conditions'=>[
    					parent::eq('Shops.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
    					parent::eq('Shops.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE]),
    					parent::eq('Shops.pref', $prefCode)
    			]
    			,'order'=> 'rand()'
    			,'limit'=> 3
    			,'group'=> ['Shops.shop_id']
    			,'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'areas',
    							'alias'=> 'Area',
    							'conditions'=> [
    									'Area.area_id = Shops.area_id'
    									,parent::eq('Area.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    						],
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_other_conditions',
    							'alias'=> 'ShopOtherCondition',
    							'conditions'=> [
    									'ShopOtherCondition.shop_id = Shops.shop_id'
    									,parent::eq('ShopOtherCondition.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    					[
    							'type'=> 'LEFT',
    							'table'=> 'pref_datas',
    							'alias'=> 'PrefData',
    							'conditions'=> [
    									'PrefData.pref = Shops.pref'
    									,parent::eq('PrefData.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shop_stations',
    							'alias'=> 'ShopStation',
    							'conditions'=> [
    									'ShopStation.shop_id = Shops.shop_id'
    									,parent::eq('ShopStation.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    					[
    							'type'=> 'LEFT',
    							'table'=> 'stations',
    							'alias'=> 'Station',
    							'conditions'=> [
    									'Station.station_cd = ShopStation.station_cd'
    							]
    					]
    			]
    			,'contain'=> ['OtherConditions', 'ShopImages']
    	];
    	return $options;
    }

    public function findPickupByPrefNotnullAffPageUrl($prefCode, $areaId = null, $shopTypes = null, $limit = null) {
    	$options = $this->makePickupByPrefNotnullAffPageUrl($prefCode);
     	array_push($options['conditions'], 'Shops.affiliate_page_url is not null');

    	if (!empty($areaId)) {
    		array_push($options['conditions'], parent::eq('Shops.area_id', $areaId));
    	}

    	if (!empty($shopTypes)) {
    		array_push($options['conditions'], parent::in('Shops.shop_type', $shopTypes));
    	}

//     	$options['order'] = ['Shops.affiliate_page_url'=> 'desc', 'rand()'];
    	$options['order'] = ['star'=> 'desc', 'Shops.affiliate_page_url'=> 'desc', 'rand()'];

    	return parent::find('all', $options)->limit($limit)->all();
    }

    public function findPickupByPref($prefCode, $areaId = null, $limit = null) {
    	$options = $this->makePickupByPrefNotnullAffPageUrl($prefCode);
    	return parent::find('all', $options)->limit($limit);

    }

    public function findByPrefAndStationCd($pref, $stationCd) {
    	$conditions = array (
    			'Shops.pref' => $pref
    	);

    	$joins = [
    			'type'=> 'INNER',
    			'table'=> 'shop_stations',
    			'alias'=> 'ShopStation',
    			'conditions'=> [
    					'ShopStation.shop_id = Shops.shop_id',
    					"ShopStation.station_cd = {$stationCd}"
    			]
    	];

    	$selects = [
				'Shops.area_id'
    	];

    	return $this->query()
    	->where($conditions)
    	->join($joins)
    	->select($selects)
    	->first();
    }

    public function deleteById($id) {
    	if (empty($id)) {
    		return false;
    	}
    	$data = array(
    			'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
    	);
    	$conditions = array(
    			'shop_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
