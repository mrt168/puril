<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BrandUrl Entity
 *
 * @property int $brand_url_id
 * @property int $brand_id
 * @property string $url
 * @property int $priority
 *
 * @property \App\Model\Entity\Brand $brand
 */
class BrandUrl extends Entity
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
        'brand_id' => true,
        'url' => true,
    	'title' => true,
        'priority' => true,
        'brand' => true
    ];
}
