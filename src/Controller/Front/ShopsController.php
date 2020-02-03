<?php
namespace App\Controller\Front;

use App\Vendor\SiteInfo;
use App\Controller\Front\FrontAppController;
use App\Vendor\Layout;
use Cake\ORM\TableRegistry;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShopType;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;
use App\Vendor\URLUtil;
use App\Vendor\PagingUtil;
use App\Vendor\Code\ShowFlg;
use Cake\Mailer\MailerAwareTrait;
use App\Vendor\Code\Sex;

/**
 * 店舗.
 */
class ShopsController extends FrontAppController {

	public $uses = false;

	use MailerAwareTrait;

	const DETAIL_PAGE = 'detail';
	const BLOG_PAGE = 'blog_index';
	const BLOG_DETAIL_PAGE = 'blog_detail';

	public $helpers = [
			'Paginator' => ['templates' => 'paginator-templates']
	];

	public function detail($shopId = null) {

		// 不要パラメーターがある際リダイレクト
		$shopDetailUrl = Router::url(['controller'=> 'shops', 'action'=> 'detail', $shopId], true). "/";
		if (Router::url(null, true) != $shopDetailUrl) {
			$this->redirect($shopDetailUrl);
			return ;
		}

		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->findByIdAndDelFlg($shopId);

		if (empty($shop['shop_id'])) {
			throw new NotFoundException();
		}
		
		if($shop['show_flg'] == 2) {
            $this->set('noindex', true);
        }


		// 最寄駅情報
		$ssTable = TableRegistry::get('ShopStations');
		$stationTabel = TableRegistry::get('Stations');
		$shopStations = $ssTable->findByShopId($shop['shop_id'])->toArray();
		if (!empty($shopStations)) {
			$shop['Station'] = [];
			$shop['StationG'] = [];
            $shop['station_name'] = [];
			$stationGroups = [];

			$whereStation['station_cd'] = [];
			foreach ($shopStations as $key => $shopStation) {
				$shop['Station'][$key]['station_cd'] = $shopStation['Station']['station_cd'];
// 				$shop['Station'][$key]['area_id'] = $shopStation['Area']['area_id'];
				$shop['Station'][$key]['name'] = "{$shopStation['StationLine']['line_name']}/{$shopStation['Station']['station_name']}駅";

				if (!empty($shopStation['Area']['area_id'])) {
					$shop['Station'][$key]['area_id'] = $shopStation['Area']['area_id'];
				} else {
					$shop['Station'][$key]['area_id'] = $shop['area_id'];
				}

				if (!in_array($shopStation['Station']['station_g_cd'], $stationGroups)) {
					array_push($stationGroups, $shopStation['Station']['station_g_cd']);
					$station = $stationTabel->findById($shopStation['Station']['station_g_cd']);

					$shop['StationG'][$key]['station_g_cd'] = $shopStation['Station']['station_g_cd'];
// 					$shop['StationG'][$key]['area_id'] = $station['Area']['area_id'];
					$shop['StationG'][$key]['name'] = $station['station_name']. "駅";
                    array_push($shop['station_name'], $station['station_name']. "駅");

					if (!empty($station['Area']['area_id'])) {
						$shop['StationG'][$key]['area_id'] = $station['Area']['area_id'];
					} else {
						$shop['StationG'][$key]['area_id'] = $shop['area_id'];
					}

				}

				array_push($whereStation['station_cd'], $shopStation['station_cd']);
			}
		}

		// こんな店舗もご覧になっています
		$whereStation['shop_id'] = [$shop['shop_id']];
		$whereArea['shop_id'] = [$shop['shop_id']];
		$whereArea['area_id'] = $shop['area_id'];
		$wherePref['shop_id'] = [$shop['shop_id']];
		$wherePref['pref'] = $shop['pref'];

		$othreShops = [];
		$othreShops['station_data'] = $shopTable->findRandForFront($whereStation, 3, true);
		$othreShops['area_data'] = $shopTable->findRandForFront($whereArea, 3, true);
		$othreShops['shop_data'] = $shopTable->findRandForFront($wherePref, 3, true);

		// 関連URL ブランド
		$brandUrlTable = TableRegistry::get('BrandUrls');
		$brandUrls = $brandUrlTable->findByBrandId($shop['brand_id']);

		$shop = $shop->toArray();
		ConvertItems::convertValue($shop)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, "pref")
			->codeConverter(ShopType::toString(), CodePattern::$VALUE, "shop_type");

		$this->set(compact('shop', 'othreShops', 'brandUrls'));

		$title = "{$shop['name']} | {$shop['pref']}{$shop['Area']['name']}の{$shop['shop_type']}";
		SiteInfo::$SHOP_DETAIL[SiteInfo::TITLE] = sprintf(SiteInfo::$SHOP_DETAIL[SiteInfo::TITLE], $title);

		$star = number_format($shop['star'],2);
		$reviewText = !empty($shop['star']) ? "（口コミ評価は【{$star}】です。）" : "";


		$description = sprintf(SiteInfo::$SHOP_DETAIL[SiteInfo::DESCRIPTION],
				$shop['name'],
				$shop['name'],
				$shop['pref'],
				$shop['Area']['name'],
				$shop['shop_type'],
				$reviewText,
				$shop['name'],
				$shop['shop_type']
				);
		SiteInfo::$SHOP_DETAIL[SiteInfo::DESCRIPTION] = $description;

		// 構造化データ
		$structureds = [];
		//Product
		$product['url'] = Router::url(null,true);
		$product['name'] = $shop['name'];
		$product['description'] = $description;
		$product['release_date'] = date('Y-m-d H:i:s', strtotime($shop['created']));
		$product['img_url'] = !empty($shop['shop_images']) ? Router::url(array('controller'=> 'images', 'action'=> 'shopImage', $shop['shop_images'][0]['shop_image_id']), true). "/" : null;
		$product['rating_value'] = $shop['star'];

		array_push($structureds, parent::structuredProduct($product));

		//Bread
		$pankuzus = [
				[
					'val'=> '全国の'. ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
					'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
					'val'=> "{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
					'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
					'val'=> "{$shop['Area']['name']}の". ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
					'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
		];

		$i = 3;
		$breads = [];
		foreach ($pankuzus as $pankuzu) {
			$pankuzu['@type'] = 'ListItem';
			$pankuzu['position'] = "{$i}";
			$pankuzu['item']['@id'] = empty($pankuzu['url']) ? Router::url(null, true) : Router::url($pankuzu['url'], true). "/";
			$pankuzu['item']['name'] =  $pankuzu['val'];

			unset($pankuzu['url']);
			unset($pankuzu['val']);
			$i++;

			array_push($breads, $pankuzu);
		}

		array_push($structureds, parent::structuredBreadcrumbList($breads));

		$this->set('structureds', $structureds);

		parent::move(SiteInfo::$SHOP_DETAIL, Layout::USER_LAYOUT, self::DETAIL_PAGE);
	}

	/**
	 * ブログ一覧ページ
	 */
	public function blogIndex() {

		$shopId = $this->request->param('shop_id');

		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->findByIdAndDelFlg($shopId);

		if (empty($shop['shop_id'])) {
			throw new NotFoundException();
		}

		$blogTable = TableRegistry::get('Blogs');
		$this->paginate = $blogTable->makeFindByDelFlgOrderByDate(PagingUtil::FRON_SEARCH);
		$blogs = $this->paginate('Blogs');

		$shop = $shop->toArray();
		ConvertItems::convertValue($shop)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, "pref")
			->codeConverter(ShopType::toString(), CodePattern::$VALUE, "shop_type");

		$this->set(compact('shop', 'blogs'));

		// 構造化データ
		$structureds = [];
		//Bread
		$pankuzus = [
				[
					'val'=> '全国の'. ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
					'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
					'val'=> "{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
					'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
					'val'=> "{$shop['Area']['name']}の". ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
					'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
					'val'=> "{$shop['name']}",
					'url'=> Router::url(['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']], true),
				],
		];

		$i = 3;
		$breads = [];
		foreach ($pankuzus as $pankuzu) {
			$pankuzu['@type'] = 'ListItem';
			$pankuzu['position'] = "{$i}";
			$pankuzu['item']['@id'] = empty($pankuzu['url']) ? Router::url(null, true) : Router::url($pankuzu['url'], true). "/";
			$pankuzu['item']['name'] =  $pankuzu['val'];

			unset($pankuzu['url']);
			unset($pankuzu['val']);
			$i++;

			array_push($breads, $pankuzu);
		}

		array_push($structureds, parent::structuredBreadcrumbList($breads));

		$this->set('structureds', $structureds);


		parent::move(SiteInfo::$BLOG_INDEX, Layout::USER_LAYOUT, self::BLOG_PAGE);
	}

	/**
	 * ブログ詳細ページ
	 */
	public function blogDetail($blogId) {

		$shopId = $this->request->param('shop_id');

		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->findByIdAndDelFlg($shopId);

		$blogsTable = TableRegistry::get('Blogs');
		$blog = $blogsTable->findByIdAndDelFlg($blogId);


		if (empty($shop['shop_id']) || empty($blog)) {
			throw new NotFoundException();
		}

		$shop = $shop->toArray();
		ConvertItems::convertValue($shop)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, "pref")
			->codeConverter(ShopType::toString(), CodePattern::$VALUE, "shop_type");

		$this->set(compact('shop', 'blog'));

		// 構造化データ
		$structureds = [];
		//Bread
		$pankuzus = [
				[
						'val'=> '全国の'. ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
						'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
						'val'=> "{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
						'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
						'val'=> "{$shop['Area']['name']}の". ShopType::convert($shop['shop_type'], CodePattern::$VALUE),
						'url'=> Router::url(['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], true),
				],
				[
						'val'=> "{$shop['name']}",
						'url'=> Router::url(['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']], true),
				],
				[
						'val'=> "ブログ",
						'url'=> Router::url(['controller'=> 'shops', 'action'=> 'blogIndex', 'shop_id'=> $shop['shop_id']], true),
				],
		];

		$i = 3;
		$breads = [];
		foreach ($pankuzus as $pankuzu) {
			$pankuzu['@type'] = 'ListItem';
			$pankuzu['position'] = "{$i}";
			$pankuzu['item']['@id'] = empty($pankuzu['url']) ? Router::url(null, true) : Router::url($pankuzu['url'], true). "/";
			$pankuzu['item']['name'] =  $pankuzu['val'];

			unset($pankuzu['url']);
			unset($pankuzu['val']);
			$i++;

			array_push($breads, $pankuzu);
		}

		array_push($structureds, parent::structuredBreadcrumbList($breads));

		$this->set('structureds', $structureds);


		parent::move(SiteInfo::$BLOG_DETAIL, Layout::USER_LAYOUT, self::BLOG_DETAIL_PAGE);
	}

	/**
	 * 画像の取得.
	 */
	public function shopImage($shopImgId) {
		$this->autoRender = false;
		if (!empty($shopImgId)) {
			$shopImgTable = TableRegistry::get('ShopImages');
			$shopImg = $shopImgTable->get($shopImgId);

			if (!empty($shopImg->image_path)) {
				$this->Image->output_image($shopImg->image_path);
			}
		}
		exit;
	}

	/**
	 * Ajax処理
	 * 口コミ投稿
	 */
	public function send() {

		$this->autoRender = false;

		$review['Reviews'] = $this->request->data['Reviews'];

		$reviewTable = TableRegistry::get('Reviews');

		$data = $reviewTable->findByShopIdAndIpAddressOrderByCreated($review['Reviews']['shop_id'], $this->request->clientIp());

		// IPチェック (5分後には再投稿可)
//		if (!empty($data)) {
//			if (date('Y-m-d H:i:s', strtotime($data['created']. "+5 minute")) > date('Y-m-d H:i:s')) {
//				$errorMsg = ['send_error'=> '時間をおいて投稿してください.'];
//				echo json_encode(compact('errorMsg'));
//				return ;
//			}
//		}

		$review = $reviewTable->newEntity($this->request->getData(), ['validate'=> 'front']);

		$errorMsg = [];
		if (!$review->getErrors()) {
			$review['ip_address'] = $this->request->clientIp();
			$review['show_flg'] = ShowFlg::$HIDE[CodePattern::$CODE];
			$review['post_date'] = date('Y-m-d H:i:s');

			$saveReview = $reviewTable->save($review);

			// メール送信
//			$shopTable = TableRegistry::get('Shops');
//			$shop = $shopTable->get($saveReview['shop_id']);
//
//			$data = [];
//			$data['post_date'] = date('Y/m/d H:i:s', strtotime($saveReview['post_date']));
//			$data['visit_date'] = !empty($saveReview['visit_date']) ? date('Y/m/d', strtotime($saveReview['visit_date'])) : "";
//			$data['shop_name'] = $shop['name']. "（ID:{$shop['shop_id']}）";
//			$data['evaluation'] = $saveReview['evaluation'];
//			$data['nickname'] = $saveReview['nickname'];
//			$data['age'] = $saveReview['age'];
//			$data['sex'] = Sex::convert($saveReview['sex'], CodePattern::$VALUE);
//			$data['instagram_account'] = $saveReview['instagram_account'];
//			$data['twitter_account'] = $saveReview['twitter_account'];
//			$data['title'] = $saveReview['title'];
//			$data['content'] = $saveReview['content'];
//
//			$this->getMailer('Contact')->send('reviewNotice', [$data]);

			echo true;
			return ;
		} else {

			foreach ($review->getErrors() as $column => $msgs) {
				$errorMsg[$column] = implode('、', $msgs);
			}
			echo json_encode(compact('errorMsg'));
			return ;
		}
	}
	// 大介が追加(ここから)
	public function tempReserve(){
		parent::move(SiteInfo::$SHOP_RESERVE_INDEX, Layout::USER_LAYOUT, 'reserve');
	}
	public function reserveConfirm(){
		parent::move(SiteInfo::$SHOP_RESERVE_CONFIRM, Layout::USER_LAYOUT, 'reserve_confirm');
	}
	public function reserveThanks(){
		parent::move(SiteInfo::$SHOP_RESERVE_THANKS, Layout::USER_LAYOUT, 'reserve_thanks');
	}
	// 大介が追加(ここまで)

	/**
	 * 予約フォーム
	 */
	public function reserve() {
		$shopId = $this->request->getQuery('shop_id');

		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->findByIdAndDelFlg($shopId);

		if (empty($shop['shop_id'])) {
			throw new NotFoundException();
		}
		
		// Purilからの予約を行なってほしくない店舗
		if ( strpos($shop['name'],'キレイモ') !== false || strpos($shop['name'],'ジェイエステティック') !== false || strpos($shop['name'],'キレイモ') !== false || strpos($shop['name'],'エステティックTBC') !== false || strpos($shop['name'],'銀座カラー') !== false ) {
			return $this->redirect(['action' => 'detail', $shop['shop_id']]);
		}

		$shop = $shop->toArray();
		ConvertItems::convertValue($shop)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, "pref")
			->codeConverter(ShopType::toString(), CodePattern::$VALUE, "shop_type");

		$this->set(compact('shop'));
        // title
        SiteInfo::$SHOP_RESERVE[SiteInfo::TITLE]= sprintf(
            SiteInfo::$SHOP_RESERVE[SiteInfo::TITLE],
            $shop['name']
        );
        // description
        SiteInfo::$SHOP_RESERVE[SiteInfo::DESCRIPTION] = sprintf(
            SiteInfo::$SHOP_RESERVE[SiteInfo::DESCRIPTION],
            $shop['name']
        );
        parent::move(SiteInfo::$SHOP_RESERVE);
	}

    /**
     * 口コミ投稿フォーム
     */
    public function post() {
        $shopId = $this->request->getQuery('shop_id');

        $shopTable = TableRegistry::get('Shops');
        $shop = $shopTable->findByIdAndDelFlg($shopId);

        if (empty($shop['shop_id'])) {
            throw new NotFoundException();
        }

        $shop = $shop->toArray();
        ConvertItems::convertValue($shop)
            ->codeConverter(Pref::toString(), CodePattern::$VALUE, "pref")
            ->codeConverter(ShopType::toString(), CodePattern::$VALUE, "shop_type");

        $this->set(compact('shop'));
        // title
        SiteInfo::$SHOP_RESERVE[SiteInfo::TITLE]= sprintf(
            SiteInfo::$SHOP_RESERVE[SiteInfo::TITLE],
            $shop['name']
        );
        // description
        SiteInfo::$SHOP_RESERVE[SiteInfo::DESCRIPTION] = sprintf(
            SiteInfo::$SHOP_RESERVE[SiteInfo::DESCRIPTION],
            $shop['name']
        );
        parent::move(SiteInfo::$SHOP_RESERVE);
    }
}
