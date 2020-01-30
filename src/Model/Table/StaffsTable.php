<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\CodePattern;

/**
 * Staffs Model
 *
 * @property |\Cake\ORM\Association\BelongsTo $Shops
 *
 * @method \App\Model\Entity\Staff get($primaryKey, $options = [])
 * @method \App\Model\Entity\Staff newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Staff[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Staff|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Staff patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Staff[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Staff findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class StaffsTable extends AppTable
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

        $this->setTable('staffs');
        $this->setDisplayField('name');
        $this->setPrimaryKey('staff_id');

        $this->addBehavior('Timestamp');

//         $this->belongsTo('Shops', [
//             'foreignKey' => 'shop_id',
//             'joinType' => 'INNER'
//         ]);
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
            ->integer('staff_id')
            ->allowEmpty('staff_id', 'create');

        $validator
            ->scalar('name')
            ->maxLength('name', 30, 'スタッフ名は30文字以内で入力してください。')
            ->requirePresence('name', 'create')
            ->notEmpty('name', 'スタッフ名を入力してください。');

        $validator
            ->scalar('name_kana')
            ->maxLength('name_kana', 30, 'ふりがなは30文字以内で入力してください。')
            ->allowEmpty('name_kana');

        $validator
            ->scalar('instagram_account')
            ->maxLength('instagram_account', 256, 'Instagramアカウントは256文字以内で入力してください。')
            ->allowEmpty('instagram_account');

        $validator
            ->scalar('twitter_account')
            ->maxLength('twitter_account', 256, 'Twitterアカウントは256文字以内で入力してください。')
            ->allowEmpty('twitter_account');

        $validator
            ->scalar('facebook_account')
            ->maxLength('facebook_account', 256, 'Facebookアカウントは256文字以内で入力してください。')
            ->allowEmpty('facebook_account');

        $validator
            ->scalar('blog_account')
            ->maxLength('blog_account', 256, 'ブログアカウントは256文字以内で入力してください。')
            ->allowEmpty('blog_account');

        $validator
            ->scalar('description')
            ->maxLength('description', 1024, '説明は1024文字以内で入力してください。')
            ->allowEmpty('description');

        $validator
            ->scalar('image_path')
            ->maxLength('image_path', 256)
            ->allowEmpty('image_path');

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
//         $rules->add($rules->existsIn(['shop_id'], 'Shops'));

        return $rules;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$conditions = array (
    			'staff_id'=> $id,
    			'del_flg' => DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->first();
    }

    /**
     * 店舗名で未削除のデータを検索します.
     */
    public function findByShopId($shopId) {
    	$conditions = array (
    			'shop_id'=> $shopId,
    			'del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]
    	);

    	return $this->query()
    	->where($conditions)
    	->all();
    }

    public function deleteById($id) {
    	if (empty($id)) {
    		return false;
    	}
    	$data = array(
    			'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
    	);
    	$conditions = array(
    			'staff_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
