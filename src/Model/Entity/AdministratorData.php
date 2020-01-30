<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;
use App\Vendor\Crypt;

/**
 * AdministratorData Entity
 *
 * @property int $administrator_id
 * @property string $name
 * @property string $login_id
 * @property string $login_pass
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modify_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\Login $login
 */
class AdministratorData extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *
     * @var array
     */
    protected $_accessible = [
        'name' => true,
        'login_id' => true,
        'login_pass' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true,
        'login' => true
    ];

    public function decryptId($decryptKey) {
    	$loginId = Crypt::decrypt($this->login_id, $decryptKey);
    	$this->login_id = $loginId;
    }
}
