<?php
namespace App\Vendor\Code;

class ImagePositionType extends AAbstractCode implements AACodeImpl {

	public static $RIGHT;
	public static $LEFT;

	public static function init() {
		self::$RIGHT = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '右側表示',
		);
		self::$LEFT = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '左側表示',
		);
	}
}
ImagePositionType::init();