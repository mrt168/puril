<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * BrandUrls Model
 *
 * @property \App\Model\Table\BrandsTable|\Cake\ORM\Association\BelongsTo $Brands
 *
 * @method \App\Model\Entity\BrandUrl get($primaryKey, $options = [])
 * @method \App\Model\Entity\BrandUrl newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\BrandUrl[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\BrandUrl|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\BrandUrl patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\BrandUrl[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\BrandUrl findOrCreate($search, callable $callback = null, $options = [])
 */
class BrandUrlsTable extends AppTable
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

        $this->setTable('brand_urls');
        $this->setDisplayField('brand_url_id');
        $this->setPrimaryKey('brand_url_id');

        $this->belongsTo('Brands', [
            'foreignKey' => 'brand_id',
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
            ->integer('brand_url_id')
            ->allowEmpty('brand_url_id', 'create');

        $validator
            ->scalar('url')
            ->maxLength('url', 256, 'URLは256文字以内で入力してください。')
            ->requirePresence('url', 'create')
            ->notEmpty('url', 'URLを入力してください。');

        $validator
            ->scalar('title')
            ->maxLength('title', 256, 'タイトルは256文字以内で入力してください。')
            ->requirePresence('title', 'create')
            ->notEmpty('title', 'タイトルを入力してください。');

        $validator
            ->integer('priority', '優先順位は数値で入力してください。')
            ->allowEmpty('priority');

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

        return $rules;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$conditions = array (
    			'brand_url_id'=> $id,
    	);

    	return $this->query()
	    	->where($conditions)
	    	->first();
    }

    /**
     * ブランド識別子で未削除のデータを検索します.
     */
    public function findByBrandId($brandId) {
    	$conditions = array (
    			'brand_id'=> $brandId,
    	);

    	return $this->query()
	    	->where($conditions)
	    	->order(['priority'=> 'asc'])
	    	->all();
    }
}
