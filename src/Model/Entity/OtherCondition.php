<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * OtherCondition Entity
 *
 * @property int $other_condition_id
 * @property string $name
 * @property string $search_text
 * @property int $del_flg
 */
class OtherCondition extends Entity
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
        'search_text' => true,
        'url_text' => true,
    	'description' => true,
    	'html' => true,
    	'type' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true
    ];
}
