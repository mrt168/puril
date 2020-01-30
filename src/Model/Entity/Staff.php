<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Staff Entity
 *
 * @property int $staff_id
 * @property int $shop_id
 * @property string $name
 * @property string $name_kana
 * @property string $instagram_account
 * @property string $twitter_account
 * @property string $facebook_account
 * @property string $blog_account
 * @property string $description
 * @property string $image_path
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modify_user
 * @property int $del_flg
 */
class Staff extends Entity
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
        'name' => true,
        'name_kana' => true,
        'instagram_account' => true,
        'twitter_account' => true,
        'facebook_account' => true,
        'blog_account' => true,
        'description' => true,
        'image_path' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true
    ];
}
