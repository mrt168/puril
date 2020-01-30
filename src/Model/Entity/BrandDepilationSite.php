<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * BrandDepilationSite Entity
 *
 * @property int $brand_depilation_site_id
 * @property int $brand_id
 * @property int $depilation_site_id
 *
 * @property \App\Model\Entity\Brand $brand
 * @property \App\Model\Entity\DepilationSite $depilation_site
 */
class BrandDepilationSite extends Entity
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
        'depilation_site_id' => true,
        'brand' => true,
        'depilation_site' => true
    ];
}
