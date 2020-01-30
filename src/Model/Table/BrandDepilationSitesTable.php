<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrandDepilationSites Model
 *
 * @property \App\Model\Table\BrandsTable|\Cake\ORM\Association\BelongsTo $Brands
 * @property \App\Model\Table\DepilationSitesTable|\Cake\ORM\Association\BelongsTo $DepilationSites
 *
 * @method \App\Model\Entity\BrandDepilationSite get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrandDepilationSite newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrandDepilationSite[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrandDepilationSite|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrandDepilationSite patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrandDepilationSite[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrandDepilationSite findOrCreate($search, callable $callback = null, $options = [])
 */
class BrandDepilationSitesTable extends AppTable
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

        $this->setTable('brand_depilation_sites');
        $this->setDisplayField('brand_depilation_site_id');
        $this->setPrimaryKey('brand_depilation_site_id');

        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id',
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
            ->integer('brand_depilation_site_id')
            ->allowEmpty('brand_depilation_site_id', 'create');

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
        $rules->add($rules->existsIn(['brand_id'], 'Brands'));
        $rules->add($rules->existsIn(['depilation_site_id'], 'DepilationSites'));

        return $rules;
    }

    public function deleteByBrandId($brandId) {
    	$conditions = array(
    			parent::eq('brand_id', $brandId)
    	);

    	return $this->deleteAll($conditions);
    }
}
