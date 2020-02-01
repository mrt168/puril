<?php
namespace App\Model\Entity;

use Cake\ORM\Entity;

/**
 * Review Entity
 *
 * @property int $review_id
 * @property int $shop_id
 * @property float $evaluation
 * @property int $question1
 * @property string $question1_evaluation
 * @property int $question2
 * @property string $question2_evaluation
 * @property int $question3
 * @property string $question3_evaluation
 * @property int $question4
 * @property string $question4_evaluation
 * @property int $question5
 * @property string $question5_evaluation
 * @property int $question6
 * @property string $nickname
 * @property int $age
 * @property int $sex
 * @property string $station
 * @property string $instagram_account
 * @property string $twitter_account
 * @property string $title
 * @property string $content
 * @property \Cake\I18n\FrozenTime $birthday
 * @property \Cake\I18n\FrozenTime $created
 * @property int $create_user
 * @property \Cake\I18n\FrozenTime $modified
 * @property int $modify_user
 * @property int $del_flg
 *
 * @property \App\Model\Entity\Shop $shop
 */
class Review extends Entity
{

    /**
     * Fields that can be mass assigned using newEntity() or patchEntity().
     *
     * Note that when '*' is set to true, this allows all unspecified fields to
     * be mass assigned. For security purposes, it is advised to set '*' to false
     * (or remove it), and explicitly make individual fields accessible as needed.
     *vim
     * @var array
     */
    protected $_accessible = [
        'shop_id' => true,
        'evaluation' => true,
        'question1' => true,
        'question2' => true,
        'question3' => true,
        'question4' => true,
        'question5' => true,
        'question6' => true,
        'question1_evaluation' => true,
        'question2_evaluation' => true,
        'question3_evaluation' => true,
        'question4_evaluation' => true,
        'question5_evaluation' => true,
        'nickname' => true,
        'age' => true,
        'sex' => true,
        'birthday' => true,
        'reason' => true,
        'station' => true,
        'pref' => true,
        'instagram_account' => true,
        'twitter_account' => true,
        'title' => true,
        'content' => true,
    	'post_date' => true,
    	'visit_date' => true,
    	'ip_address' => true,
    	'show_flg' => true,
        'created' => true,
        'create_user' => true,
        'modified' => true,
        'modify_user' => true,
        'del_flg' => true,
        'shop' => true
    ];
}
