<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\AreaType;

/**
 * Stations Model
 *
 * @method \App\Model\Entity\Station get($primaryKey, $options = [])
 * @method \App\Model\Entity\Station newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Station[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Station|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Station patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Station[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Station findOrCreate($search, callable $callback = null, $options = [])
 */
class StationsTable extends AppTable
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

        $this->setTable('stations');
        $this->setDisplayField('station_cd');
        $this->setPrimaryKey('station_cd');
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
            ->scalar('station_cd')
            ->maxLength('station_cd', 16)
            ->allowEmpty('station_cd', 'create');

        $validator
            ->scalar('station_g_cd')
            ->maxLength('station_g_cd', 16)
            ->requirePresence('station_g_cd', 'create')
            ->notEmpty('station_g_cd');

        $validator
            ->scalar('station_name')
            ->maxLength('station_name', 256)
            ->requirePresence('station_name', 'create')
            ->notEmpty('station_name');

        $validator
            ->scalar('station_name_k')
            ->maxLength('station_name_k', 256)
            ->allowEmpty('station_name_k');

        $validator
            ->scalar('station_name_r')
            ->maxLength('station_name_r', 16)
            ->allowEmpty('station_name_r');

        $validator
            ->scalar('line_cd')
            ->maxLength('line_cd', 16)
            ->requirePresence('line_cd', 'create')
            ->notEmpty('line_cd');

        $validator
            ->scalar('pref_cd')
            ->maxLength('pref_cd', 16)
            ->requirePresence('pref_cd', 'create')
            ->notEmpty('pref_cd');

        $validator
            ->scalar('post')
            ->maxLength('post', 256)
            ->requirePresence('post', 'create')
            ->notEmpty('post');

        $validator
            ->scalar('address')
            ->maxLength('address', 256)
            ->requirePresence('address', 'create')
            ->notEmpty('address');

        $validator
            ->scalar('lon')
            ->maxLength('lon', 32)
            ->allowEmpty('lon');

        $validator
            ->scalar('lat')
            ->maxLength('lat', 32)
            ->allowEmpty('lat');

        $validator
            ->scalar('open_ymd')
            ->maxLength('open_ymd', 32)
            ->allowEmpty('open_ymd');

        $validator
            ->scalar('close_ymd')
            ->maxLength('close_ymd', 32)
            ->allowEmpty('close_ymd');

        $validator
            ->scalar('e_status')
            ->maxLength('e_status', 16)
            ->allowEmpty('e_status');

        $validator
            ->scalar('e_sort')
            ->maxLength('e_sort', 16)
            ->allowEmpty('e_sort');

        return $validator;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findById($id) {
    	$conditions = array (
    			'station_cd'=> $id
    	);

    	$joins=[

    			[
    					'table' => 'station_lines',
    					'alias' => 'Line',
    					'type' => 'LEFT',
    					'conditions' => 'Line.line_cd = Stations.line_cd'
    			],
    			[
    					'table' => 'station_companies',
    					'alias' => 'Company',
    					'type' => 'LEFT',
    					'conditions' => 'Company.company_cd = Line.company_cd'
    			],

    			// 駅のある市区町村
    			[
		    			'table' => 'areas',
		    			'alias' => 'Area',
		    			'type' => 'LEFT',
    					'conditions' => [
    							"Stations.address LIKE concat('%',Area.name,'%')",
    							"Stations.pref_cd = Area.pref",
    							parent::eq('Area.area_type', AreaType::$NORMAL[CodePattern::$CODE])
    							]
    			],
    			[
		    			'table' => 'pref_datas',
		    			'alias' => 'PrefData',
		    			'type' => 'LEFT',
		    			'conditions' => [
		    					"PrefData.pref = Area.pref",
		    					parent::eq('PrefData.del_flg', AreaType::$NORMAL[CodePattern::$CODE])
		    			]
    			],

    	];

    	$selects=[
    			"Line.line_name",
    			"Company.company_name",

    			'Area.area_id',
    			'Area.pref',
    			'PrefData.url_text'
    	];

    	return $this->query()
    	->join($joins)
    	->select($selects)
    	->select($this)
    	->where($conditions)
    	->first();
    }

    /**
     * グループ識別子で未削除のデータを検索します.
     */
    public function findByStationGCd($stationGCd) {
    	$conditions = array (
    			'station_g_cd'=> $stationGCd
    	);

    	$joins=[
    			// 駅のある市区町村
    			[
    					'table' => 'areas',
    					'alias' => 'Area',
    					'type' => 'LEFT',
    					'conditions' => [
    							"Stations.address LIKE concat('%',Area.name,'%')",
    							"Stations.pref_cd = Area.pref",
    							parent::eq('Area.area_type', AreaType::$NORMAL[CodePattern::$CODE])
    					]
    			],
    	];

    	return $this->query()
    	->join($joins)
    	->select($this)
    	->select(['Area.area_id'])
    	->where($conditions)
    	->all();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByAll() {
        $joins=[
            [
                'table' => 'shop_stations',
                'alias' => 'ShopStation',
                'type' => 'LEFT',
                'conditions' => 'ShopStation.station_cd = Stations.station_cd'
            ],
        ];

        $selects=[
            'cnt'=> 'COUNT(ShopStation.shop_station_id)',
        ];

        return $this->query()
            ->join($joins)
            ->select($selects)
            ->select($this)
            ->group(['Stations.station_g_cd'])
            ->all();
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByPref($pref) {
    	$conditions = array (
    			'Stations.pref_cd'=> $pref
    	);

    	$joins=[
    			[
	    			'table' => 'shop_stations',
	    			'alias' => 'ShopStation',
	    			'type' => 'LEFT',
	    			'conditions' => 'ShopStation.station_cd = Stations.station_cd'
    			],
    	];

    	$selects=[
    			'cnt'=> 'COUNT(ShopStation.shop_station_id)'
    	];

    	return $this->query()
    	->join($joins)
    	->select($selects)
    	->select($this)
    	->where($conditions)
    	->group(['Stations.station_g_cd'])
    	->all();
    }

    public function findByPrefAndName($pref, $name) {
    	$conditions = array (
    			'Stations.pref_cd'=> $pref,
    			'Stations.station_name'=> $name
    	);

    	return $this->query()
    	->select($this)
    	->where($conditions)
    	->first();
    }

    public function makeFindByDelFlgOrderById($wheres = null, $limit = null) {
    	$options = [
    			'fields' => [
    					'Stations.station_name',
    					'Stations.station_cd',
    					'Stations.pref_cd',

    					'Line.line_name',
    					'Company.company_name'
    			],

    			'conditions'=>[],
    			'order'=> array('Stations.station_cd'=> 'desc'),
    			'limit'=> $limit,
    			'group'=> 'Stations.station_cd',
    			'join'=> [
    					[
		    					'table' => 'station_lines',
		    					'alias' => 'Line',
		    					'type' => 'LEFT',
		    					'conditions' => 'Line.line_cd = Stations.line_cd'
		    			],
		    			[
		    					'table' => 'station_companies',
		    					'alias' => 'Company',
		    					'type' => 'LEFT',
		    					'conditions' => 'Company.company_cd = Line.company_cd'
		    			],
    			]
    	];

    	if (!empty($wheres)) {
    		if (!empty($wheres['station_name'])) {
    			array_push($options['conditions'], parent::likeContain('Stations.station_name', $wheres['station_name']));
    		}

    		if (!empty($wheres['shop_id'])) {
    			array_push($options['join'], [
    					'type'=> 'LEFT',
    					'table'=> 'shop_stations',
    					'alias'=> 'ShopStation',
    					'conditions'=> [
    							'ShopStation.station_cd = Stations.station_cd',
    							"ShopStation.shop_id = {$wheres['shop_id']}"
    					]
    			]);

    			array_push($options['fields'], "ShopStation.station_cd");
    		}
    	}

    	return $options;
    }
}
