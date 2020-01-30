<?php
namespace App\Vendor\Code;

class ShowFlg extends AAbstractCode implements AACodeImpl {

	public static $SHOW;
	public static $HIDE;

	public static function init() {
		self::$SHOW = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '表示',
		);
		self::$HIDE = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '非表示',
		);
	}
}
ShowFlg::init();