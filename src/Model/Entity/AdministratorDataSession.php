<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * AdministratorDataSession Entity
 *
 * @property string $id
 * @property int $administrator_id
 * @property int $limit_time
 * @property \Cake\I18n\FrozenTime $created
 *
 * @property \App\Model\Entity\Administrator $administrator
 */
class AdministratorDataSession extends Entity
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
        'id' => true,
        'administrator_id' => true,
        'limit_time' => true,
        'created' => true,
        'administrator' => true
    ];
}
