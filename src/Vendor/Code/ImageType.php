<?php
namespace App\Vendor\Code;

class ImageType extends AAbstractCode implements AACodeImpl {
	public static $MAIN;
	public static $ACCESS;
// 	public static $ILLUSTRATION;


	public static function init() {
		self::$MAIN = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => 'メイン',
		);
		self::$ACCESS = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '道順',
		);
// 		self::$ILLUSTRATION = array (
// 				CodePattern::$CODE => '3',
// 				CodePattern::$VALUE => 'イラストマップ',
// 		);
	}
}
ImageType::init();