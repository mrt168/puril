<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ShopPrice Entity
 *
 * @property int $shop_price_id
 * @property int $shop_id
 * @property int $price_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\Price $price
 */
class ShopPrice extends Entity
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
        'price_id' => true,
        'created' => true,
        'create_user' => true,
        'del_flg' => true,
        'shop' => true,
        'price' => true
    ];
}
