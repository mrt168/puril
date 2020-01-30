<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\AreaType;

/**
 * ShopStations Model
 *
 * @property \App\Model\Table\ShopsTable|\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\ShopStation get($primaryKey, $options = [])
 * @method \App\Model\Entity\ShopStation newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ShopStation[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ShopStation|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ShopStation patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ShopStation[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ShopStation findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopStationsTable extends AppTable
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

        $this->setTable('shop_stations');
        $this->setDisplayField('shop_station_id');
        $this->setPrimaryKey('shop_station_id');

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
            ->integer('shop_station_id')
            ->allowEmpty('shop_station_id', 'create');

        $validator
            ->scalar('station_cd')
            ->maxLength('station_cd', 16)
            ->requirePresence('station_cd', 'create')
            ->notEmpty('station_cd');

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
        $rules->add($rules->existsIn(['shop_id'], 'Shops'));

        return $rules;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByShopId($shopId) {
    	$conditions = array (
    			'ShopStations.shop_id'=> $shopId,
    			'ShopStations.del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	$joins=[
    			[
    				'table' => 'stations',
    				'alias' => 'Station',
    				'type' => 'LEFT',
    				'conditions' => 'Station.station_cd = ShopStations.station_cd'
    			],
    			[
	    			'table' => 'station_lines',
	    			'alias' => 'StationLine',
	    			'type' => 'LEFT',
	    			'conditions' => 'StationLine.line_cd = Station.line_cd'
    			],
//     			[
// 	    			'table' => 'station_companies',
// 	    			'alias' => 'StationCompany',
// 	    			'type' => 'LEFT',
// 	    			'conditions' => 'StationCompany.company_cd = StationLine.company_cd'
//     			],
				[
					'table' => 'areas',
					'alias' => 'Area',
					'type' => 'LEFT',
					'conditions' => [
							"Station.address LIKE concat('%',Area.name,'%')",
							"Station.pref_cd = Area.pref",
							parent::eq('Area.area_type', AreaType::$NORMAL[CodePattern::$CODE])
					]
				]

    	];

    	$selects = [
    			'Station.station_cd',
    			'Station.station_g_cd',
    			'Station.station_name',
    			'StationLine.line_name',
//     			'StationCompany.company_name'
    			'Area.area_id'
    	];

    	return $this->query()
    	->join($joins)
    	->select($this)
    	->select($selects)
    	->where($conditions)
    	->all();
    }

    public function deleteByShopId($shopId) {
    	$conditions = array(
    			parent::eq('shop_id', $shopId)
    	);

    	return $this->deleteAll($conditions);
    }
}
