<?php
namespace App\Vendor\Code;

class Gender extends AAbstractCode implements AACodeImpl {
	public static $MALE;
	public static $FEMALE;
	public static function init() {
		self::$MALE = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => 'Male',
				CodePattern::$VALUE2 => '男性'
		);
		self::$FEMALE = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => 'Female',
				CodePattern::$VALUE2 => '女性'
		);
	}
}
Gender::init();