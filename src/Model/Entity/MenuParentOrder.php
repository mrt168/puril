<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * MenuParentOrder Entity
 *
 * @property int $parent_order_id
 * @property int $menu_parent_id
 * @property int $administrator_id
 * @property int $order_no
 * @property int $show_flg
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modify_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\MenuParent $menu_parent
 * @property \App\Model\Entity\Administrator $administrator
 */
class MenuParentOrder extends Entity
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
        'administrator_id' => true,
        'order_no' => true,
        'show_flg' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true,
        'menu_parent' => true,
        'administrator' => true
    ];
}
