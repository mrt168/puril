<?php
namespace App\Vendor\Code;

class ContactType extends AAbstractCode implements AACodeImpl {

	public static $QUESTION;
//	public static $REVIEW;
    public static $REQUEST;
//    public static $RESERVE;

	public static function init() {
		self::$QUESTION = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => 'ご意見・ご質問・ご予約',
		);
//		self::$REVIEW = array (
//				CodePattern::$CODE => '2',
//				CodePattern::$VALUE => '口コミ投稿',
//		);
		self::$REQUEST = array (
				CodePattern::$CODE => '3',
				CodePattern::$VALUE => '口コミ削除・修正依頼',
		);
	}
}
ContactType::init();