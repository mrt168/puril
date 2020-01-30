<?php
namespace App\Vendor\Code;

class Sex extends AAbstractCode implements AACodeImpl {
	public static $MAN;
	public static $WOMAN;
	public static function init() {
		self::$MAN = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '男性',
				CodePattern::$VALUE2 => 'men'
		);
		self::$WOMAN = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '女性',
				CodePattern::$VALUE2 => 'women'
		);
	}
}
Sex::init();