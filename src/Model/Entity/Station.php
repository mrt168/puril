<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Station Entity
 *
 * @property string $station_cd
 * @property string $station_g_cd
 * @property string $station_name
 * @property string $station_name_k
 * @property string $station_name_r
 * @property string $line_cd
 * @property string $pref_cd
 * @property string $post
 * @property string $address
 * @property string $lon
 * @property string $lat
 * @property string $open_ymd
 * @property string $close_ymd
 * @property string $e_status
 * @property string $e_sort
 */
class Station extends Entity
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
        'station_g_cd' => true,
        'station_name' => true,
        'station_name_k' => true,
        'station_name_r' => true,
        'line_cd' => true,
        'pref_cd' => true,
        'post' => true,
        'address' => true,
        'lon' => true,
        'lat' => true,
        'open_ymd' => true,
        'close_ymd' => true,
        'e_status' => true,
        'e_sort' => true,
    	'html' => true
    ];
}
