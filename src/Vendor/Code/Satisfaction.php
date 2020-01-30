<?php
namespace App\Vendor\Code;

class Satisfaction extends AAbstractCode implements AACodeImpl {

	public static $VERY_SATISFIED;
	public static $SLIGHTLY_SATISFIED;
	public static $NORMAL;
	public static $SLIGHTLY_DISSATISFIED;
	public static $VERY_DISSATISFIED;

	public static function init() {
		self::$VERY_SATISFIED = [
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '大変満足',
				CodePattern::$VALUE2 => '100'
		];
		self::$SLIGHTLY_SATISFIED = [
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => 'やや満足',
				CodePattern::$VALUE2 => '75'
		];
		self::$NORMAL = [
				CodePattern::$CODE => '3',
				CodePattern::$VALUE => '普通',
				CodePattern::$VALUE2 => '50'
		];
		self::$SLIGHTLY_DISSATISFIED = [
				CodePattern::$CODE => '4',
				CodePattern::$VALUE => 'やや不満',
				CodePattern::$VALUE2 => '25'
		];
		self::$VERY_DISSATISFIED = [
				CodePattern::$CODE => '5',
				CodePattern::$VALUE => '大変不満',
				CodePattern::$VALUE2 => '0'
		];
	}
}
Satisfaction::init();