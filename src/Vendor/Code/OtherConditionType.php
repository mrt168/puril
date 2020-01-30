<?php
namespace App\Vendor\Code;

class OtherConditionType extends AAbstractCode implements AACodeImpl {
	public static $DEPILATION;
	public static $DEPARTMENT;
	public static $SUPPORT;
	public static $RECEPTIONIST;
	public static $LOCATION;

	public static function init() {
		self::$DEPILATION = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '脱毛タイプ',
		);
		self::$DEPARTMENT = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '診療科(医療脱毛の場合)',
		);
		self::$SUPPORT = array (
				CodePattern::$CODE => '3',
				CodePattern::$VALUE => 'サポート体制',
		);
		self::$RECEPTIONIST = array (
				CodePattern::$CODE => '4',
				CodePattern::$VALUE => '予約・受付・キャンセル',
		);
		self::$LOCATION = array (
				CodePattern::$CODE => '5',
				CodePattern::$VALUE => '立地・施設',
		);
	}
}
OtherConditionType::init();