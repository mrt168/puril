<?php
namespace App\Vendor\Code;

class ClickUrl extends AAbstractCode implements AACodeImpl {

	public static $LOGIN;
	public static $TOP;

	public static $SHOP_VIEW;
	public static $SHOP_REG;
	public static $SHOP_CSV;

	public static $BRAND_VIEW;
	public static $BRAND_REG;

	public static $REVIEW_VIEW;
	public static $REVIEW_REG;
	public static $REVIEW_CSV;

	public static $PREF_VIEW;
	public static $AREA_VIEW;
	public static $STATION_VIEW;
	public static $DEPILATION_SITE_VIEW;
	public static $PAYMENT_VIEW;
	public static $DISCOUNT_VIEW;
	public static $OTHER_CONDITION_VIEW;
	public static $PRICE_VIEW;
	public static $IMAGE_VIEW;

	public static $ADMINISTRATOR_VIEW;
	public static $ADMINISTRATOR_REG;
	public static $MENU;

	public static function init() {
		self::$LOGIN = array(CodePattern::$CODE => 'login', CodePattern::$VALUE => '管理ログイン');
		self::$TOP = array(CodePattern::$CODE => 'top', CodePattern::$VALUE => '管理トップ');

		self::$SHOP_VIEW = array(CodePattern::$CODE => 'shop_view', CodePattern::$VALUE => '店舗一覧');
		self::$SHOP_REG = array(CodePattern::$CODE => 'shop_reg', CodePattern::$VALUE => '店舗登録');
		self::$SHOP_CSV = array(CodePattern::$CODE => 'shop_csv', CodePattern::$VALUE => 'CSVインポート');

		self::$BRAND_VIEW = array(CodePattern::$CODE => 'brand_view', CodePattern::$VALUE => 'ブランド一覧');
		self::$BRAND_REG = array(CodePattern::$CODE => 'brand_reg', CodePattern::$VALUE => 'ブランド登録');

		self::$REVIEW_VIEW = array(CodePattern::$CODE => 'review_view', CodePattern::$VALUE => '口コミ一覧');
		self::$REVIEW_REG = array(CodePattern::$CODE => 'review_reg', CodePattern::$VALUE => '口コミ登録');
		self::$REVIEW_CSV = array(CodePattern::$CODE => 'review_csv', CodePattern::$VALUE => 'CSVインポート');

		self::$PREF_VIEW = array(CodePattern::$CODE => 'pref_view', CodePattern::$VALUE => '都道府県一覧');
		self::$AREA_VIEW = array(CodePattern::$CODE => 'area_view', CodePattern::$VALUE => '市区町村一覧');
		self::$STATION_VIEW = array(CodePattern::$CODE => 'station_view', CodePattern::$VALUE => '駅一覧');
		self::$DEPILATION_SITE_VIEW = array(CodePattern::$CODE => 'depilation_site_view', CodePattern::$VALUE => '脱毛部位一覧');
		self::$PAYMENT_VIEW = array(CodePattern::$CODE => 'payment_view', CodePattern::$VALUE => '支払方法一覧');
		self::$DISCOUNT_VIEW = array(CodePattern::$CODE => 'discount_view', CodePattern::$VALUE => '特典・割引一覧');
		self::$OTHER_CONDITION_VIEW = array(CodePattern::$CODE => 'other_condition_view', CodePattern::$VALUE => 'その他こだわり条件一覧');
		self::$PRICE_VIEW = array(CodePattern::$CODE => 'price_view', CodePattern::$VALUE => '価格一覧');
		self::$IMAGE_VIEW = array(CodePattern::$CODE => 'image_view', CodePattern::$VALUE => '画像管理');

		self::$ADMINISTRATOR_VIEW = array(CodePattern::$CODE => 'administrator_view', CodePattern::$VALUE => '管理者一覧');
		self::$ADMINISTRATOR_REG = array(CodePattern::$CODE => 'administrator_reg', CodePattern::$VALUE => '管理者登録');
		self::$MENU = array(CodePattern::$CODE => 'menu', CodePattern::$VALUE => 'メニュー');
	}
}
ClickUrl::init();
