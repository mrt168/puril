<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Shop Entity
 *
 * @property int $shop_id
 * @property int $area_id
 * @property int $pref
 * @property string $address
 * @property string $name
 * @property string $access
 * @property string $business_hours
 * @property string $holiday
 * @property string $credit_card
 * @property string $facility
 * @property string $staff
 * @property string $parking
 * @property string $conditions
 * @property string $memo
 * @property string $station
 * @property string $scraping_url
 * @property int $show_flg
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modify_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\Area $area
 */
class Shop extends Entity
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
        'area_id' => true,
        'pref' => true,
        'address' => true,
        'name' => true,
    	'description_subject' => true,
    	'description_content' => true,
        'access' => true,
        'business_hours' => true,
        'holiday' => true,
        'credit_card' => true,
        'facility' => true,
        'staff' => true,
        'parking' => true,
        'conditions' => true,
        'memo' => true,
        'station' => true,
    	'brand_id' => true,
    	'price_plan_html' => true,
    	'shop_image_path' => true,
    	'word' => true,
    	'interview_title' => true,
    	'interview_image_path' => true,
    	'interview_video_url' => true,
    	'affiliate_page_url' => true,
    	'affiliate_banner_url' => true,
        'scraping_url' => true,
    	'shop_type' => true,
        'show_flg' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true,
        'area' => true
    ];
}
