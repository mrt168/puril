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
				CodePattern::$VALUE => '5.0',
				CodePattern::$VALUE2 => '100'
		];
		self::$SLIGHTLY_SATISFIED = [
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '4.0',
				CodePattern::$VALUE2 => '75'
		];
		self::$NORMAL = [
				CodePattern::$CODE => '3',
				CodePattern::$VALUE => '3.0',
				CodePattern::$VALUE2 => '50'
		];
		self::$SLIGHTLY_DISSATISFIED = [
				CodePattern::$CODE => '4',
				CodePattern::$VALUE => '2.0',
				CodePattern::$VALUE2 => '25'
		];
		self::$VERY_DISSATISFIED = [
				CodePattern::$CODE => '5',
				CodePattern::$VALUE => '1.0',
				CodePattern::$VALUE2 => '0'
		];
	}
}
Satisfaction::init();