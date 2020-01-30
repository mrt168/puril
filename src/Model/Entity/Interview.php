<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Interview Entity
 *
 * @property int $interview_id
 * @property int $shop_id
 * @property string $title
 * @property string $content
 * @property string $image_path
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modify_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\Shop $shop
 */
class Interview extends Entity
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
        'shop_id' => true,
        'title' => true,
        'content' => true,
        'image_path' => true,
    	'image_position_type' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true,
        'shop' => true
    ];
}
