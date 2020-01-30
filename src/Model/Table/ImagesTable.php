<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DelFlg;

/**
 * Images Model
 *
 * @method \App\Model\Entity\Image get($primaryKey, $options = [])
 * @method \App\Model\Entity\Image newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Image[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Image|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Image patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Image[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Image findOrCreate($search, callable $callback = null, $options = [])
 *
 * @mixin \Cake\ORM\Behavior\TimestampBehavior
 */
class ImagesTable extends AppTable
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

        $this->setTable('images');
        $this->setDisplayField('image_id');
        $this->setPrimaryKey('image_id');

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
            ->integer('image_id')
            ->allowEmpty('image_id', 'create');

        $validator
            ->scalar('image_path')
            ->maxLength('image_path', 256)
            ->requirePresence('image_path', 'create')
            ->notEmpty('image_path');

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

    public function makeFindByDelFlgOrderById($limit = null) {
    	$options = [
    			'fields' => [
    					'Images.image_id',
    					'Images.image_path',
    					'Images.created',
    			],

    			'conditions'=>[
    					parent::eq('Images.del_flg', DelFlg::$MI_SAKUJO[CodePattern::$CODE])
    			]
    			,'order'=> array('Images.image_id'=> 'desc')
    			,'limit'=> $limit
    			,'group'=> 'Images.image_id'
    	];

    	return $options;
    }

    public function deleteById($id) {
    	if (empty($id)) {
    		return false;
    	}
    	$data = array(
    			'del_flg'=> DelFlg::$SAKUJO_ZUMI[CodePattern::$CODE]
    	);
    	$conditions = array(
    			'image_id'=> $id
    	);
    	return parent::updateAll($data, $conditions);
    }
}
