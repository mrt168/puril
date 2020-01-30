<?php
namespace App\Vendor\Code;

class DelFlg extends AAbstractCode implements AACodeImpl {

	public static $MI_SAKUJO;
	public static $SAKUJO_ZUMI;

	public static function init() {
		self::$MI_SAKUJO = array (
				CodePattern::$CODE => '1',
				CodePattern::$VALUE => '未削除',
		);
		self::$SAKUJO_ZUMI = array (
				CodePattern::$CODE => '2',
				CodePattern::$VALUE => '削除済',
		);
	}
}
DelFlg::init();