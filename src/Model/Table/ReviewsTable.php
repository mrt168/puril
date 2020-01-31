<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ShowFlg;

/**
 * Reviews Model
 *
 * @property \App\Model\Table\ShopsTable|\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\Review get($primaryKey, $options = [])
 * @method \App\Model\Entity\Review newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Review[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Review|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Review patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Review[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Review findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ReviewsTable extends AppTable
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

        $this->setTable('reviews');
        $this->setDisplayField('title');
        $this->setPrimaryKey('review_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
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
            ->integer('review_id')
            ->allowEmpty('review_id', 'create');

        $validator
            ->decimal('evaluation')
            ->requirePresence('evaluation', 'create')
            ->notEmpty('evaluation');

        $validator
            ->allowEmpty('question1');

        $validator
            ->allowEmpty('question2');

        $validator
            ->allowEmpty('question3');

        $validator
            ->allowEmpty('question4');

        $validator
            ->allowEmpty('question5');

        $validator
            ->allowEmpty('question6');

        $validator
            ->scalar('nickname')
            ->maxLength('nickname', 30)
            ->requirePresence('nickname', 'create')
            ->notEmpty('nickname');

        $validator
            ->integer('age')
            ->requirePresence('age', 'create')
            ->notEmpty('age');

        $validator
            ->requirePresence('sex', 'create')
            ->notEmpty('sex');

        $validator
            ->scalar('instagram_account')
            ->maxLength('instagram_account', 256)
            ->allowEmpty('instagram_account');

        $validator
            ->scalar('twitter_account')
            ->maxLength('twitter_account', 256)
            ->allowEmpty('twitter_account');

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
    		->notEmpty('shop_id', '店舗を選択してください.');

    	$validator
	    	->decimal('evaluation', null, "評価は数値で入力してください.")
	    	->requirePresence('evaluation', 'create')
	    	->notEmpty('evaluation', "評価を入力してください.")
    		->range('evaluation', [0.5,5], "評価は0.5～5の数値で入力してください.");

    	$validator
    		->allowEmpty('question1');

    	$validator
    		->allowEmpty('question2');

    	$validator
    		->allowEmpty('question3');

    	$validator
    		->allowEmpty('question4');

    	$validator
    		->allowEmpty('question5');

    	$validator
    		->allowEmpty('question6');

    	$validator
	    	->scalar('nickname')
	    	->maxLength('nickname', 30, "氏名(ニックネーム)は30文字以内で入力してください.")
	    	->requirePresence('nickname', 'create')
	    	->notEmpty('nickname', "氏名(ニックネーム)を入力してください.");

    	$validator
	    	->integer('age', "年齢は数値で入力してください.")
	    	->requirePresence('age', 'create')
	    	->notEmpty('age', "年齢を入力してください.");

    	$validator
    		->integer('sex', "性別は数値で入力してください.")
	    	->requirePresence('sex', 'create')
	    	->notEmpty('sex', "性別を入力してください.");

    	$validator
	    	->scalar('instagram_account')
	    	->maxLength('instagram_account', 256, "Instagramアカウントは256文字以内で入力してください.")
	    	->allowEmpty('instagram_account');

    	$validator
	    	->scalar('twitter_account')
	    	->maxLength('twitter_account', 256, "Twitterアカウントは256文字以内で入力してください.")
	    	->allowEmpty('twitter_account');

    	$validator
	    	->scalar('title')
	    	->maxLength('title', 256, "口コミ タイトルは256文字以内で入力してください.")
	    	->requirePresence('title', 'create')
	    	->notEmpty('title', "口コミ タイトルを入力してください.");

    	$validator
	    	->scalar('content')
	    	->requirePresence('content', 'create')
	    	->notEmpty('content', "口コミ 本文を入力してください.");

	    $validator
	    	->requirePresence('show_flg', 'create')
	    	->notEmpty('show_flg');

    	return $validator;
    }

    public function validationFront(Validator $validator) {
    	$validator
	    	->decimal('evaluation', null, "評価は数値で入力してください.")
	    	->requirePresence('evaluation', 'create')
	    	->notEmpty('evaluation', "評価を入力してください.")
	    	->range('evaluation', [0.5,5], "評価は0.5～5の数値で入力してください.");

    	$validator
	    	->scalar('nickname')
	    	->maxLength('nickname', 30, "氏名(ニックネーム)は30文字以内で入力してください.")
	    	->requirePresence('nickname', 'create')
	    	->notEmpty('nickname', "氏名(ニックネーム)を入力してください.");

    	$validator
	    	->scalar('instagram_account')
	    	->maxLength('instagram_account', 256, "Instagramアカウントは256文字以内で入力してください.")
	    	->allowEmpty('instagram_account');

    	$validator
	    	->scalar('twitter_account')
	    	->maxLength('twitter_account', 256, "Twitterアカウントは256文字以内で入力してください.")
	    	->allowEmpty('twitter_account');

    	$validator
	    	->scalar('title')
	    	->maxLength('title', 256, "口コミ タイトルは256文字以内で入力してください.")
	    	->requirePresence('title', 'create')
	    	->notEmpty('title', "口コミ タイトルを入力してください.");

    	$validator
	    	->scalar('content')
	    	->requirePresence('content', 'create')
	    	->notEmpty('content', "口コミ 本文を入力してください.");

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
        $rules->add($rules->existsIn(['shop_id'], 'Shops'));

        return $rules;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$conditions = array (
    			'Reviews.review_id'=> $id,
    			'Reviews.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$joins=[
    			[
    					'table' => 'shops',
    					'alias' => 'Shop',
    					'type' => 'LEFT',
    					'conditions' => 'Shop.shop_id = Reviews.shop_id'
    			]
    	];

    	$selects = [
    			'Shop.name'
    	];

    	return $this->query()
    	->join($joins)
    	->select($this)
    	->select($selects)
    	->where($conditions)
    	->first();
    }

    public function findByShopIdAndIpAddressOrderByCreated($shopId , $ipAddress) {

    	$conditions = array (
    			'Reviews.shop_id'=> $shopId,
    			'Reviews.ip_address'=> $ipAddress,
    			'Reviews.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->order(['Reviews.created'=> 'DESC'])
    	->first();
    }

    public function findByShopIds($shopIds, $limit = null) {

    	$conditions = array (
    			parent::in('Reviews.shop_id', $shopIds),
    			'Reviews.show_flg'=> ShowFlg::$SHOW[CodePattern::$CODE],
    			'Reviews.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$joins=[
    			[
    					'table' => 'shops',
    					'alias' => 'Shop',
    					'type' => 'LEFT',
    					'conditions' => 'Shop.shop_id = Reviews.shop_id'
    			],
    			[
		    			'table' => 'shop_images',
		    			'alias' => 'ShopImage',
		    			'type' => 'LEFT',
		    			'conditions' => [
		    					'ShopImage.shop_id = Shop.shop_id',
		    					'ShopImage.priority <= 1',
		    					'ShopImage.image_type = '. ImageType::$MAIN[CodePattern::$CODE]
		    			]
    			]
    	];

    	$selects = [
    			'Reviews.review_id',
    			'Reviews.evaluation',
    			'Reviews.title',
    			'Reviews.content',
    			'Reviews.evaluation',
    			'Reviews.question1',
    			'Reviews.question2',
    			'Reviews.question3',
    			'Reviews.question4',
    			'Reviews.question5',
    			'Reviews.question6',
    			'Reviews.nickname',
    			'Reviews.sex',
    			'Reviews.instagram_account',
    			'Reviews.twitter_account',
    			'Reviews.post_date',
    			'Reviews.visit_date',

    			'Shop.shop_id',
    			'Shop.name',
    			'Shop.pref',
    			'Shop.affiliate_page_url',

    			'ShopImage.shop_image_id'
    	];

    	return $this->query()
    	->join($joins)
    	->select($selects)
    	->where($conditions)
    	->limit($limit)
    	->order(['post_date'=> 'desc'])
    	->all();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByShopTypeOrdeByPostDate($shopType, $limit = null) {
        if($shopType == null) {
            $conditions = array (
                'Reviews.show_flg'=> ShowFlg::$SHOW[CodePattern::$CODE],
                'Reviews.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
            );
        } else {
            $conditions = array (
                'Shop.shop_type'=> $shopType,
                'Reviews.show_flg'=> ShowFlg::$SHOW[CodePattern::$CODE],
                'Reviews.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
            );
        }

    	$joins=[
    			[
    					'table' => 'shops',
    					'alias' => 'Shop',
    					'type' => 'LEFT',
    					'conditions' => [
    							'Shop.shop_id = Reviews.shop_id',
    							'Shop.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    					]
    			],
    			[
	    			'table' => 'shop_images',
	    			'alias' => 'ShopImg',
	    			'type' => 'LEFT',
	    			'conditions' => [
	    					'ShopImg.shop_id = Shop.shop_id',
	    					'ShopImg.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE],
	    					'ShopImg.image_type = '. ImageType::$MAIN[CodePattern::$CODE]
	    			]
    			]
    	];

    	$selects = [
            'Reviews.title',
    			'Reviews.content',
    			'Reviews.post_date',
    			'Reviews.evaluation',

    			'Shop.shop_id',
    			'Shop.name',
    			'Shop.affiliate_page_url',

    			'ShopImg.shop_image_id'
    	];

    	return $this->query()
    	->join($joins)
    	->select($selects)
    	->where($conditions)
    	->order(['Reviews.post_date' => 'desc'])
    	->limit($limit)
    	->group('Reviews.review_id')
    	->all();
    }

    public function findByDelFlgOrderById($wheres = null, $limit = null) {
    	$options = $this->makeFindByDelFlgOrderById($wheres, $limit);

    	$options['fields'] = [
    			'Reviews.review_id',
    			'Reviews.evaluation',
    			'Reviews.question1',
    			'Reviews.question2',
    			'Reviews.question3',
    			'Reviews.question4',
    			'Reviews.question5',
    			'Reviews.question6',
    			'Reviews.nickname',
    			'Reviews.age',
    			'Reviews.sex',
    			'Reviews.instagram_account',
    			'Reviews.twitter_account',
    			'Reviews.post_date',
    			'Reviews.visit_date',
    			'Reviews.title',
    			'Reviews.content',
    			'Reviews.show_flg',

    			'Shop.shop_id',
    			'Shop.name'
    	];

    	$options['order'] = ['Reviews.review_id'=> 'asc'];

    	return parent::find('all', $options);
    }

    public function makeFindForFront($shopIds = null, $limit = null) {
    	$options = [
    			'fields' => [
    					'Reviews.review_id',
    					'Reviews.evaluation',
    					'Reviews.post_date',
    					'Reviews.visit_date',
    					'Reviews.modified',
    					'Reviews.question1',
    					'Reviews.question2',
    					'Reviews.question3',
    					'Reviews.question4',
    					'Reviews.question5',
    					'Reviews.question6',
    					'Reviews.nickname',
    					'Reviews.sex',
    					'Reviews.instagram_account',
    					'Reviews.twitter_account',
    					'Reviews.title',
    					'Reviews.content',

    					'Shop.shop_id',
    					'Shop.name',
    					'Shop.pref',
    					'Shop.affiliate_page_url',
    					'ShopImage.shop_image_id'
    			],

    			'conditions'=>[
    					parent::in('Reviews.shop_id', $shopIds),
    					parent::eq('Reviews.show_flg', ShowFlg::$SHOW[CodePattern::$CODE]),
    					parent::eq('Reviews.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'order'=> array('Reviews.post_date'=> 'desc')
    			,'limit'=> $limit
    			,'group'=> 'Reviews.review_id'
    			,'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shops',
    							'alias'=> 'Shop',
    							'conditions'=> [
    									'Shop.shop_id = Reviews.shop_id'
    									,parent::eq('Shop.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    					[
		    					'type'=> 'LEFT',
		    					'table'=> 'shop_images',
		    					'alias'=> 'ShopImage',
		    					'conditions'=> [
		    							'ShopImage.shop_id = Shop.shop_id',
		    							'ShopImage.priority <= 1',
		    							parent::eq('ShopImage.image_type', ImageType::$MAIN[CodePattern::$CODE]),
		    							parent::eq('ShopImage.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
		    					]
    					],
    			]
    	];

    	return $options;
    }

    public function makeFindByDelFlgOrderById($wheres = null, $limit = null) {
    	$options = [
    			'fields' => [
    					'Reviews.review_id',
    					'Reviews.evaluation',
    					'Reviews.post_date',
    					'Reviews.visit_date',
    					'Reviews.show_flg',
    					'Reviews.modified',

    					'Shop.name'
    			],

    			'conditions'=>[
    					parent::eq('Reviews.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'order'=> array('Reviews.review_id'=> 'desc')
    			,'limit'=> $limit
    			,'group'=> 'Reviews.review_id'
    			,'join'=> [
    					[
    							'type'=> 'LEFT',
    							'table'=> 'shops',
    							'alias'=> 'Shop',
    							'conditions'=> [
    									'Shop.shop_id = Reviews.shop_id'
    									,parent::eq('Shop.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    							]
    					],
    			]
    			,'sortWhitelist'=> [
    					'Reviews.review_id',
    			]
    	];
    	if (!empty($wheres)) {
    		if (!empty($wheres['review_id_from'])) {
    			array_push($options['conditions'], parent::ge('Reviews.review_id', mb_convert_kana($wheres['review_id_from'], 'n')));
    		}
    		if (!empty($wheres['review_id_to'])) {
    			array_push($options['conditions'], parent::le('Reviews.review_id', mb_convert_kana($wheres['review_id_to'], 'n')));
    		}
    		if (!empty($wheres['shop_name'])) {
    			foreach ($wheres['shop_name'] as $shopName) {
    				array_push($options['conditions'], parent::likeContain('Shop.name', $shopName));
    			}
    		}
    	}

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
    			'review_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
