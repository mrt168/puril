<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\CodePattern;

/**
 * ShopImages Model
 *
 * @property \App\Model\Table\ShopsTable|\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\ShopImage get($primaryKey, $options = [])
 * @method \App\Model\Entity\ShopImage newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ShopImage[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ShopImage|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ShopImage patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ShopImage[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ShopImage findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ShopImagesTable extends AppTable
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

        $this->setTable('shop_images');
        $this->setDisplayField('shop_image_id');
        $this->setPrimaryKey('shop_image_id');

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
            ->integer('shop_image_id')
            ->allowEmpty('shop_image_id', 'create');

        $validator
            ->scalar('image_path')
            ->maxLength('image_path', 256)
            ->requirePresence('image_path', 'create')
            ->notEmpty('image_path');

        $validator
            ->scalar('text')
            ->maxLength('text', 512, 'テキストは512文字以内で入力してください.')
            ->allowEmpty('text');

        $validator
            ->requirePresence('image_type', 'create')
            ->notEmpty('image_type');

        $validator
            ->integer('create_user')
            ->requirePresence('create_user', 'create')
            ->notEmpty('create_user');

        $validator
            ->integer('modify_user')
            ->allowEmpty('modify_user');

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
     * 店舗識別番号で未削除のデータを検索します.
     */
    public function findByShopId($shopId) {
    	$conditions = array (
    			'shop_id'=> $shopId,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->order(['priority'=> 'asc'])
    	->all();
    }

    public function countByShopIdAndImageType($shopId, $imageType) {
    	$conditions = array (
    			'shop_id'=> $shopId,
    			'image_type'=> $imageType,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->count();
    }

    public function deleteById($id) {
    	if (empty($id)) {
    		return false;
    	}
    	$data = array(
    			'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
    	);
    	$conditions = array(
    			'shop_image_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
