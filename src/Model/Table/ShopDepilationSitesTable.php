<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ShopDepilationSites Model
 *
 * @property \App\Model\Table\ShopsTable|\Cake\ORM\Association\BelongsTo $Shops
 * @property \App\Model\Table\DepilationSitesTable|\Cake\ORM\Association\BelongsTo $DepilationSites
 *
 * @method \App\Model\Entity\ShopDepilationSite get($primaryKey, $options = [])
 * @method \App\Model\Entity\ShopDepilationSite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ShopDepilationSite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ShopDepilationSite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ShopDepilationSite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ShopDepilationSite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ShopDepilationSite findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopDepilationSitesTable extends AppTable
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

        $this->setTable('shop_depilation_sites');
        $this->setDisplayField('shop_depilation_site_id');
        $this->setPrimaryKey('shop_depilation_site_id');

        $this->addBehavior('Timestamp');

        $this->belongsTo('Shops', [
            'foreignKey' => 'shop_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('DepilationSites', [
            'foreignKey' => 'depilation_site_id',
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
            ->integer('shop_depilation_site_id')
            ->allowEmpty('shop_depilation_site_id', 'create');

        $validator
            ->integer('create_user')
            ->requirePresence('create_user', 'create')
            ->notEmpty('create_user');

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
        $rules->add($rules->existsIn(['depilation_site_id'], 'DepilationSites'));

        return $rules;
    }

    public function deleteByShopId($shopId) {
    	$conditions = array(
    			parent::eq('shop_id', $shopId)
    	);

    	return $this->deleteAll($conditions);
    }
}
