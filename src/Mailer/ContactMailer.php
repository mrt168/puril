<?php
namespace App\Mailer;

use Cake\Mailer\Mailer;
use function Cake\Mailer\template;

class ContactMailer extends Mailer {

//	const ADMIN_MAIL = "y_kobayashi@acthd.co.jp";
// 	const ADMIN_MAIL = "muraoka.act@gmail.com";
 	const ADMIN_MAIL = "info@tsuru-tsuru.co.jp";

	// 施設情報掲載のお問い合わせ
    public function contact($data) {
        $this
		->profile('contact')
		->setViewVars(['data' => $data])
        ->setSubject('施設情報掲載のお問い合わせ')
        ->setTo(self::ADMIN_MAIL)
	->setFrom([self::ADMIN_MAIL => 'Puril'])
        ->setEmailFormat('text')
        ->setTemplate('contact');
    }

    // ユーザーレビューのお問い合わせ
    public function contactUser($data) {
    	$this
    	->profile('contact')
    	->setViewVars(['data' => $data])
    	->setSubject('ユーザーレビューのお問い合わせ')
    	->setTo(self::ADMIN_MAIL)
	->setFrom([self::ADMIN_MAIL => 'Puril'])
    	->setEmailFormat('text')
    	->setTemplate('contact_user');
    }

    // リメール
    public function remail($data) {
    	$this
    	->profile('contact')
    	->setSubject('お問い合わせありがとうございます')
    	->setTo($data['mail'])
	->setFrom([self::ADMIN_MAIL => 'Puril'])
    	->setEmailFormat('text')
    	->setTemplate('contact_user_to_user');
    }

    // 口コミ投稿
    public function reviewNotice($data) {
    	$this
    	->profile('contact')
    	->setViewVars(['data' => $data])
    	->setSubject('口コミ投稿のお知らせ')
    	->setTo(self::ADMIN_MAIL)
	->setFrom([self::ADMIN_MAIL => 'Puril'])
    	->setEmailFormat('text')
    	->setTemplate('review_notice');
    }

    // ご予約
    public function reserve($data) {
        $this
        ->profile('contact')
        ->setViewVars(['data' => $data])
            ->setSubject('【Puril】'.$data['shop_name'].'の仮予約を受け付けました。')
            ->setTo([$data['mail'], 'info@tsuru-tsuru.co.jp'])
	->setFrom([self::ADMIN_MAIL => 'Puril'])
        ->setEmailFormat('text')
        ->setTemplate('reserve');
    }
}
