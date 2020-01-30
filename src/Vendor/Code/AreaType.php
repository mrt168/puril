<?php
namespace App\Vendor\Code;

class AreaType extends AAbstractCode implements AACodeImpl {

	public static $NORMAL;
	public static $DESIGNATED ;

	public static function init() {
		self::$NORMAL = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '通常',
		);
		self::$DESIGNATED = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '指定都市',
		);
	}
}
AreaType::init();