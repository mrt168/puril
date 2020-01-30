<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use Cake\Event\Event;
use Cake\Datasource\EntityInterface;
use App\Vendor\Code\DelFlg;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Crypt;
use App\Vendor\Code\CodePattern;
use App\Vendor\ValidationUtil;

/**
 * AdministratorDatas Model
 *
 * @property \App\Model\Table\LoginsTable|\Cake\ORM\Association\BelongsTo $Logins
 *
 * @method \App\Model\Entity\AdministratorData get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdministratorData newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdministratorData[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdministratorData|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdministratorData patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdministratorData[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdministratorData findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdministratorDatasTable extends AppTable{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('administrator_datas');
        $this->setDisplayField('name');
        $this->setPrimaryKey('administrator_id');

        $this->addBehavior('Timestamp');

    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator){
    	$validator
	    	->notEmpty('name', __("管理者名を入力してください。"))
	    	->add('name', 'maxLength', [
	    			'rule' => ['maxLength', 30],
	    			'message' => __("管理者名は30文字以内で入力してください。")]);

	    $validator
	    	->notEmpty('login_id', __("ログインIDを入力して下さい。"))
	    	->add('login_id', 'maxLength', [
	    			'rule' => ['maxLength', ValidationUtil::SYSTEM_USER_LOGIN_ID_MAX_LEN],
	    			'message' => __("ログインIDは32文字以内で入力してください。")])
	    	->add('login_id', 'minLength', [
	    			'rule' => ['minLength', ValidationUtil::SYSTEM_USER_LOGIN_ID_MIN_LEN],
	    			'message' => __("ログインIDは5文字以上で入力してください。")])
    		->add('login_id', 'alphanumeric', [
    				'rule' => function ($value) {
    					return preg_match(ValidationUtil::CHECK_PASSWORD, $value) === 1;},
    				'message' => __("ログインIDは英数字で入力して下さい。")]);

    	$validator
    		->notEmpty('login_pass', __("ログインパスワードを入力して下さい。"))
    		->add('login_pass', 'maxLength', [
	    			'rule' => ['maxLength', ValidationUtil::SYSTEM_USER_LOGIN_PASS_MAX_LEN],
	    			'message' => __("ログインパスワードは32文字以内で入力してください。")])
	    	->add('login_pass', 'minLength', [
	    			'rule' => ['minLength', ValidationUtil::SYSTEM_USER_LOGIN_PASS_MIN_LEN],
	    			'message' => __("ログインパスワードは5文字以上で入力してください。")])
    		->add('login_pass', 'alphanumeric', [
    				'rule' => function ($value) {
    					return preg_match(ValidationUtil::CHECK_PASSWORD, $value) === 1;},
    				'message' => __("ログインパスワードは英数字で入力して下さい。")]);

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules) {
//         $rules->add($rules->existsIn(['login_id'], 'Logins'));

        return $rules;
    }

    /**
     * 管理者名の昇順で未削除のエンティティを検索します.
     */
    public function findByDelFlgOrderByName() {
    	$options = array(
    			'conditions'=> array (
    					parent::eq('AdministratorDatas.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			),
    			'order'=> array(
    					'AdministratorDatas.name'=> 'ASC'
    			)
    	);

    	return parent::find('all', $options);
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findByIdAndDelFlg($id) {
    	$options = array (
    			'conditions' => array (
    					parent::eq('AdministratorDatas.administrator_id', $id),
    					parent::eq('AdministratorDatas.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			)
    	);

    	return parent::find('all', $options)->first();
    }

	public function findByLoginIdAndPass($loginId, $loginPass, $decryptKey) {
		$options = array(
				'conditions' =>
					array(
						parent::hash_eq('AdministratorDatas.login_pass', $loginPass),
						parent::eq('AdministratorDatas.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
					)
		);

		$datas = parent::find('all', $options);
		if (!empty($datas)) {
			$result = array();
			foreach ($datas as $data) {
				$id = Crypt::decrypt($data->login_id, $decryptKey);
				if ($loginId != $id) {
					continue ;
				}
				$result = $data;
			}
			return $result;
		}
	}


	/**
	 * 管理者名の昇順で未削除のエンティティを検索します.
	 */
	public function findByDelFlgOrderById() {
		$options = array(
				'conditions'=> array (
						parent::eq('AdministratorDatas.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
				),
				'order'=> array(
						'AdministratorDatas.administrator_id'=> 'ASC'
				)
		);

		return parent::find('all', $options);
	}

	/**
	 * session情報を結合して管理者情報を取得します.
	 */
	public function findBySessionId($sessionId) {
		if (empty($sessionId)) {
			return null;
		}
		$options = array(
				'conditions' =>
				array(
						parent::eq('AdministratorDatas.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
				)
				,'join'=> array(
						array(
								'type'=> 'INNER'
								,'table'=> 'administrator_data_sessions'
								,'alias'=> 'AdministratorDataSessions'
								,'conditions'=> array(
										'AdministratorDataSessions.administrator_id = AdministratorDatas.administrator_id'
										,parent::ge('AdministratorDataSessions.limit_time', strtotime(date('Y-m-d H:i:s')))
										,parent::eq('AdministratorDataSessions.id', $sessionId)
								)
						)
				)
		);

		return parent::find('all', $options)->first();
	}

	public function save(EntityInterface $entity, $options = array()) {

		$data = array();
		$data['login_id'] = $entity->login_id;
		$data['login_pass'] = $entity->login_pass;

		ConvertItems::convertValue($data)
			->encryptConverter(Crypt::SYSTEM_LOGIN_ID_KEY_NAME, 'login_id', true)
			->hashConverter('login_pass');

		$entity->login_id = $data['login_id'];
		$entity->login_pass = $data['login_pass'];

		return parent::save($entity, $options = array());
	}

	public function deleteById($id) {
		if (empty($id)) {
			return false;
		}
		$data = array(
				'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
		);
		$conditions = array(
				'administrator_id'=> $id
		);
		return parent::updateAll($data, $conditions);
	}
}
