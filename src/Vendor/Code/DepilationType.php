<?php
namespace App\Vendor\Code;

class DepilationType extends AAbstractCode implements AACodeImpl {

	public static $LADIES ;
	public static $MENS;

	public static function init() {
		self::$LADIES = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => 'レディース'
		);
		self::$MENS = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => 'メンズ'
		);
	}
}
DepilationType::init();