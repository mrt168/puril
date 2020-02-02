<?php
namespace App\Vendor;

use App\Vendor\Constants;

class SiteInfo {

	public static $HOME; 			// ホーム
	public static $TOP;			// トップ

	public static $SEARCH;			// 検索
	public static $SEARCH_RESULT;	// 検索結果

	public static $SHOP_DETAIL;	// 店舗詳細
	public static $BLOG_INDEX;		// ブログ一覧
	public static $BLOG_DETAIL;	// ブログ詳細

	public static $BRAND_INDEX;	// ブランド一覧
	public static $BRAND_DETAIL;	// ブランド詳細
	public static $REVIEW_INDEX;	// 口コミ一覧

	public static $RANKING;	// ランキング

	public static $SITE_MAP;		// サイトマップ
	public static $PRIVACY_POLICY;	// プライバシーポリシー
	public static $TERMS;			// 利用規約
	public static $CONTACT;		// お問合せ
	public static $CONTACT_USER;	// ユーザーお問合せ
	public static $CONTACT_TAHNKS;	// お問合せサンクスページ

	public static $SHOP_RESERVE;	// 店舗予約

	// 大介が追加（ここから）
	public static $SHOP_RESERVE_INDEX;
	public static $SHOP_RESERVE_CONFIRM;
	public static $SHOP_RESERVE_THANKS;
	// 大介が追加（ここまで）


	public static $ERROR400;
	public static $ERROR500;

	const TITLE = 'title';
	const DESCRIPTION = 'description';
	const H1 = 'h1';
	const KEYWORD = 'keyword';

	public static function init() {
		self::$HOME = array(self::TITLE=> Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);

		self::$TOP = array(self::TITLE=> "Puril - おすすめ脱毛サロン・クリニックの検索予約サイト"
				,self::DESCRIPTION=> '全国にある脱毛サロンや医療脱毛クリニックの検索・予約サイト。掲載店舗数11,480件。口コミや料金、写真などをもとに、24時間いつでもネット予約ができます。'
				,self::H1=> ''
				,self::KEYWORD => ''
		);

		self::$SEARCH = array(self::TITLE=> "全国のおすすめ脱毛サロン・医療脱毛クリニック｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> '【掲載数No1】日本初の脱毛専門ポータルサイト『Puril』。脱毛サロンはもちろん、医療脱毛クリニックもご紹介！ %s件の店舗情報を掲載中で、店舗情報や口コミは毎日更新！あなたの好きな条件で、脱毛店舗を検索してください♪'
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$SEARCH_RESULT = array(self::TITLE=> "%s｜". Constants::FRONT_TITLE
// 				,self::DESCRIPTION=> '%s%sのおすすめ%sの検索結果一覧（%s件）です。%sの脱毛サロン・医療脱毛クリニックaaaaの特徴、メリット・デメリットなどの情報もふまえて、あなたにピッタリな店舗を見つけましょう！'
				,self::DESCRIPTION=> '%s%sの%sの検索結果一覧（%s件）です。%sの%sの特徴、メリット・デメリットなどの情報もふまえて、あなたにピッタリな店舗を見つけましょう！'
				,self::H1=> ''
				,self::KEYWORD => ''
		);

		self::$SHOP_DETAIL = array(self::TITLE=> "%s｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> '%sの店舗情報です。%sは、%s%sにある%s。%s%sで対応可能な脱毛部位、料金プラン、アクセスなどの詳細情報はもちろん、類似の%sをお探しの方は、是非チェックしてください！'
				,self::H1=> ''
				,self::KEYWORD => ''
		);

		self::$BLOG_INDEX = array(self::TITLE=> "ブログ一覧｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$BLOG_DETAIL = array(self::TITLE=> "ブログ詳細｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);

		self::$RANKING = array(self::TITLE=> "%s｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> '%s%sの%sの口コミ人気ランキング（%s件）です！Purilに寄せられた口コミにより、%sの%sをランキング形式でご紹介♪ みんなの評判もふまえて、あなたにピッタリな店舗を見つけましょう！'
				,self::H1=> ''
				,self::KEYWORD => ''
		);

		self::$BRAND_INDEX = array(self::TITLE=> "脱毛施設を店舗名から探す｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$BRAND_DETAIL = array(self::TITLE=> "%s徹底調査！特徴・料金・口コミ・評判・対応エリア｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> '%sの特徴、料金プラン、口コミ・評判、キャンペーン、店舗展開エリアなどをすべて掲載！%s%sの公式サイトでは手に入らないお役立ち情報が満載ですので、是非ご参考ください♪【Puril】'
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$REVIEW_INDEX = array(self::TITLE=> "%sの評価は？【口コミ%s件】最新%s年%s月｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> '%sの口コミ一覧（%s件、総合評価%s点）はこちら！%sの実際の料金はどうなの？スタッフさんの対応は？説明はしっかり行ってくれる？予約はとれる？など、みんなの実際の評判が気になる方は、こちらをご覧ください！【Puril】'
				,self::H1=> ''
				,self::KEYWORD => ''
		);

		self::$SITE_MAP = array(self::TITLE=> "サイトマップ｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$PRIVACY_POLICY = array(self::TITLE=> "プライバシーポリシー｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$TERMS = array(self::TITLE=> "利用規約｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$CONTACT = array(self::TITLE=> "施設情報掲載のお問い合わせ｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$CONTACT_USER = array(self::TITLE=> "ユーザーレビューのお問い合わせ｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
		self::$CONTACT_TAHNKS = array(self::TITLE=> "お問い合わせありがとうございます。｜". Constants::FRONT_TITLE
				,self::DESCRIPTION=> ''
				,self::H1=> ''
				,self::KEYWORD => ''
		);
        self::$SHOP_RESERVE = array(self::TITLE=> "%sをカンタン予約する｜". Constants::FRONT_TITLE
        ,self::DESCRIPTION=> '%sの予約ページです。Purilでは、カンタン30秒でご予約が可能です。来店日時やご希望の脱毛部位を選択いただけますと、Purilでご予約を代行いたします。お気軽にお問い合わせください。'
        ,self::H1=> ''
        ,self::KEYWORD => ''
		);
		
		// 大介が追加（ここから）
        self::$SHOP_RESERVE_INDEX = array(self::TITLE=> "ネット予約｜". Constants::FRONT_TITLE
        ,self::DESCRIPTION=> ''
        ,self::H1=> ''
        ,self::KEYWORD => ''
		);
        self::$SHOP_RESERVE_CONFIRM = array(self::TITLE=> "ご予約内容の確認｜". Constants::FRONT_TITLE
        ,self::DESCRIPTION=> ''
        ,self::H1=> ''
        ,self::KEYWORD => ''
		);
        self::$SHOP_RESERVE_THANKS = array(self::TITLE=> "ご予約完了｜". Constants::FRONT_TITLE
        ,self::DESCRIPTION=> ''
        ,self::H1=> ''
        ,self::KEYWORD => ''
		);
		// 大介が追加（ここまで）
	}
}
SiteInfo::init();
?>