<?php
namespace App\Vendor\Code;

class ShopType extends AAbstractCode implements AACodeImpl {
	public static $DEPILATION_SALON;
	public static $MEDICAL_DEPILATION_CLINIC;


	public static function init() {
		self::$DEPILATION_SALON = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '脱毛サロン',
				CodePattern::$VALUE2 => 'salon'
		);
		self::$MEDICAL_DEPILATION_CLINIC = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '医療脱毛クリニック',
				CodePattern::$VALUE2 => 'clinic'
		);
	}
}
ShopType::init();