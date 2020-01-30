<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuChildren Entity
 *
 * @property int $menu_child_id
 * @property int $menu_parent_id
 * @property string $menu_name
 * @property string $controller_name
 * @property string $action_name
 * @property string $click_url
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modify_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\MenuParent $menu_parent
 */
class MenuChildren extends Entity
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
        'menu_parent_id' => true,
        'menu_name' => true,
        'controller_name' => true,
        'action_name' => true,
        'click_url' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true,
        'menu_parent' => true
    ];
}
