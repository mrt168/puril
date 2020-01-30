<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ShopDepilationSite Entity
 *
 * @property int $shop_depilation_site_id
 * @property int $shop_id
 * @property int $depilation_site_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\DepilationSite $depilation_site
 */
class ShopDepilationSite extends Entity
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
        'depilation_site_id' => true,
        'created' => true,
        'create_user' => true,
        'del_flg' => true,
        'shop' => true,
        'depilation_site' => true
    ];
}
