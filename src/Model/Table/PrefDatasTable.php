<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\ShopType;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\ShowFlg;

/**
 * PrefDatas Model
 *
 * @method \App\Model\Entity\PrefData get($primaryKey, $options = [])
 * @method \App\Model\Entity\PrefData newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PrefData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PrefData|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PrefData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PrefData[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PrefData findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class PrefDatasTable extends AppTable
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

        $this->setTable('pref_datas');
        $this->setDisplayField('pref_data_id');
        $this->setPrimaryKey('pref_data_id');

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
            ->integer('pref_data_id')
            ->allowEmpty('pref_data_id', 'create');

        $validator
            ->requirePresence('pref', 'create')
            ->notEmpty('pref');

        $validator
            ->scalar('html')
            ->allowEmpty('html');

        $validator
            ->scalar('search_text')
            ->allowEmpty('search_text');

        $validator
            ->scalar('url_text')
            ->allowEmpty('search_text');

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
    			'pref_data_id'=> $id,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByPref($pref) {
    	$conditions = array (
    			'pref'=> $pref,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
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

    public function findByDelFlgOrderByPref() {
    	$options = array(
    			'conditions'=> array (
    					parent::eq('PrefDatas.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'PrefDatas.pref'=> 'ASC'
    			),
    			'fields'=> [
    					'PrefDatas.pref',
    					'PrefDatas.url_text',
    					'salon_cnt'=> "(SELECT COUNT(*) FROM shops WHERE PrefDatas.pref = shops.pref AND shop_type = ".ShopType::$DEPILATION_SALON[CodePattern::$CODE]. ")",
    					'medical_cnt'=> "(SELECT COUNT(*) FROM shops WHERE PrefDatas.pref = shops.pref AND shop_type = ".ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$CODE]. ")"
    			]

    	);

    	return parent::find('all', $options);
    }

    public function findByShopTypeOrderByPref($shopType) {

    	$shopTable = TableRegistry::get('Shops');

    	$cntSqlWhere = "PrefDatas.pref = shops.pref AND shop_type IN (". implode(',', $shopType) .") AND shops.show_flg = ". ShowFlg::$SHOW[CodePattern::$CODE]. " AND shops.del_flg = ". DelFlg::$MI_SAKUJO[CodePattern::$CODE];
    	$options = array(
    			'conditions'=> array (
    					parent::eq('PrefDatas.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'PrefDatas.pref'=> 'ASC'
    			),
    			'fields'=> [
    					'PrefDatas.pref',
    					'PrefDatas.url_text',
    					'all_cnt'=> "(SELECT COUNT(*) FROM shops INNER JOIN shop_depilation_sites as SDS ON SDS.shop_id = shops.shop_id WHERE {$cntSqlWhere} AND SDS.depilation_site_id = 1)",
    					'parts_cnt'=> "(SELECT COUNT(DISTINCT shops.shop_id) FROM shops INNER JOIN shop_depilation_sites as SDS ON SDS.shop_id = shops.shop_id WHERE {$cntSqlWhere} AND SDS.depilation_site_id != 1)"
    			]
    	);

    	return parent::find('all', $options);
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findAllByDelFlg() {
    	$conditions = array (
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->all();
    }
}
