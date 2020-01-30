<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * ShopPayment Entity
 *
 * @property int $shop_payment_id
 * @property int $shop_id
 * @property int $payment_id
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\Shop $shop
 * @property \App\Model\Entity\Payment $payment
 */
class ShopPayment extends Entity
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
        'payment_id' => true,
        'created' => true,
        'create_user' => true,
        'del_flg' => true,
        'shop' => true,
        'payment' => true
    ];
}
