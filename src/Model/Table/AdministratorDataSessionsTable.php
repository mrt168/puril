<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Constants;

/**
 * AdministratorDataSessions Model
 *
 * @property \App\Model\Table\AdministratorsTable|\Cake\ORM\Association\BelongsTo $Administrators
 *
 * @method \App\Model\Entity\AdministratorDataSession get($primaryKey, $options = [])
 * @method \App\Model\Entity\AdministratorDataSession newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\AdministratorDataSession[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\AdministratorDataSession|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\AdministratorDataSession patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\AdministratorDataSession[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\AdministratorDataSession findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class AdministratorDataSessionsTable extends AppTable
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

        $this->setTable('administrator_data_sessions');

        $this->addBehavior('Timestamp');

        $this->primaryKey(['id']);

        $this->belongsTo('AdministratorDatas', [
            'foreignKey' => 'administrator_id',
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
            ->scalar('id')
            ->maxLength('id', 64)
            ->requirePresence('id', 'create')
            ->notEmpty('id');

        $validator
            ->integer('limit_time')
            ->allowEmpty('limit_time');

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
        $rules->add($rules->existsIn(['administrator_id'], 'AdministratorDatas'));

        return $rules;
    }

    /**
     * 識別子で未削除のデータを検索します.
     */
    public function findCountById($id) {
    	$conditions = array(
    			'conditions' =>
    			array(
    					parent::eq('AdministratorDataSessions.id', $id)
    			)
    	);

    	return parent::find('all', $conditions)->first();
    }

    public function findByIdForUpdate($id) {

    	/**
    	$dbo = $this->getDataSource();

    	$option = $dbo->buildStatement(
    			array(
    					'fields' => array(
    							'count(*)'
    					),
    					'table' => 'administrator_data_sessions',
    					'alias' => 'AdministratorDataSessions',
    					'conditions' =>
    					array(
    							parent::eq('AdministratorDataSessions.id', $id)
    					)
    			),
    			$this->AdministratorDataSessions
    	);

    	$option .= ' FOR UPDATE';

    	return parent::query($option);
    	**/

    	$conditions = array(
    			'conditions' =>
    			array(
    					parent::eq('AdministratorDataSessions.id', $id)
    			)
    	);

    	return parent::find('all', $conditions)->epilog('FOR UPDATE')->count();
    }

    /**
     * 引数に指定された識別番号に更新します.
     */
    public function updateById($oldId, $newId) {
    	$data = array(
				'id'=> $newId
    			,'limit_time'=> strtotime(Constants::SESSION_VALID_MINUTE.' minute '.date('Y-m-d H:i:s'))
    	);
    	$conditions = array(
    			'id' => $oldId,
    	);
    	return parent::updateAll($data, $conditions);
    }

    /**
     * 有効期限切れのセッションを削除.
     */
    public function deleteInValid() {
    	$conditions = array(
    			'AdministratorDataSessions.limit_time <= ' => strtotime(date('Y-m-d H:i:s')),
    	);
    	return parent::deleteAll($conditions);
    }
}
