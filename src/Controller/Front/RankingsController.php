<?php
namespace App\Controller\Front;

use App\Controller\Front\FrontAppController;
use App\Controller\Front\SearchsController;
use App\Vendor\SiteInfo;
use App\Vendor\Layout;
use Cake\ORM\TableRegistry;
use App\Vendor\URLUtil;
use Cake\Routing\Router;
use App\Vendor\PagingUtil;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShopType;

/**
 * ランキング.
 */
class RankingsController extends FrontAppController {

	public $uses = false;

	const INDEX_PAGE = 'index';

	public $helpers = [
			'Paginator' => ['templates' => 'ranking-paginator-templates']
	];

	/**
	 * ランキングTOP
	 */
	public function index() {

		$shopTable = TableRegistry::get('Shops');

		$wheres = [];
		if (isset($_GET[URLUtil::MONTH_RANKING_PARA])) {
			$wheres[URLUtil::MONTH_RANKING_PARA] = date('Y-m-d H:i:s');
		}

		$this->paginate = $shopTable->makeFindForRankingFront($wheres, PagingUtil::FRON_SEARCH);
		$shops = $this->paginate('Shops')->toArray();

        // 口コミ取得
        $reviewTable = TableRegistry::get('Reviews');
        foreach ($shops as $key => $brand) {
            $reviews = [];
            $reviews = $reviewTable->findByShopIds($brand['shop_id'], 3)->toArray();
            $shopss[$key]['reviews'] = $reviews;
        }

		// 最寄駅取得
		$this->getStation($shops);

		$searchWheres = null;
		$isBrandRanking = false;
		$this->set(compact('shops', 'searchWheres', 'isBrandRanking'));

		SiteInfo::$RANKING[SiteInfo::TITLE] = sprintf(SiteInfo::$RANKING[SiteInfo::TITLE], "脱毛サロン・医療脱毛クリニックの口コミ人気ランキング");

		$resultCnt = $shopTable->countForRankingFront($wheres);
		SiteInfo::$RANKING[SiteInfo::DESCRIPTION] = sprintf(SiteInfo::$RANKING[SiteInfo::DESCRIPTION],
		"全国","","脱毛サロン・医療脱毛クリニック",$resultCnt,"全国","脱毛サロン・医療脱毛クリニック");

		parent::move(SiteInfo::$RANKING, Layout::USER_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * ランキング検索処理
	 */
	public function search() {

		$this->Shop = TableRegistry::get('Shops');

		$url = Router::url(null, true);
		$this->analysis(urldecode($url), URLUtil::RANKING);

		$shops = $this->paginate('Shops');

		if ($this->addShops) {
			$addShops = $this->addShops;
			$this->getStation($addShops);
			$this->set('addShops', $addShops);
		}
        // 口コミ取得
//        $reviewTable = TableRegistry::get('Reviews');
//        foreach ($shops as $key => $brand) {
//            $reviews = [];
//            $reviews = $reviewTable->findByShopIds($brand['shop_id'],3)->toArray();
//            $shops->toArray($key)['reviews'] = $reviews;
//        }

		$isBrandRanking = false;
		$this->set(compact('shops', 'isBrandRanking'));

		parent::move(SiteInfo::$RANKING, Layout::USER_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * ブランドランキング
	 */
	public function brandRanking() {

		$this->Brand = TableRegistry::get('Brands');


		$wheres = "";
		if (isset($_GET[URLUtil::MONTH_RANKING_PARA])) {
			$wheres[URLUtil::MONTH_RANKING_PARA] = date('Y-m-d H:i:s');
		}
		$this->paginate = $this->Brand->makeFindForFront($wheres, PagingUtil::FRON_SEARCH);
		$shops = $this->paginate('Brands');


		// 口コミ取得
		$reviewTable = TableRegistry::get('Reviews');
		$shops = $shops->toArray();
		foreach ($shops as $key => $brand) {
			$shopIds = [];
			$reviews = [];
			if ($brand['shops']) {
				foreach ($brand['shops'] as $shop) {
					array_push($shopIds, $shop['shop_id']);
				}
				$reviews = $reviewTable->findByShopIds($shopIds, 3)->toArray();
			}
			$shops[$key]['reviews'] = $reviews;
		}

		$isBrandRanking = true;
		$this->set(compact('shops', 'isBrandRanking'));

		// noindex
		$this->set('isNoIndex', true);

		SiteInfo::$RANKING[SiteInfo::TITLE] = sprintf(SiteInfo::$RANKING[SiteInfo::TITLE], "脱毛サロン・医療脱毛クリニックの口コミ人気ランキング");

		parent::move(SiteInfo::$RANKING, Layout::USER_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * URLから条件の解析処理を実施
	 */
	private function analysis($url, $baseUrl) {

		$wheres = [];
		$urls = explode($baseUrl.'/', $url);

		if (1 < count($urls)) {
			$param = $urls[1];

			// 不要スラッシュリダイレクト
			if(strpos(Router::url(),'//') !== false){
				$params = explode('/', $param);
				$this->redirect(Router::url("/". URLUtil::RANKING. "/". implode(array_filter($params, "strlen"), "/"), true));
			}

			// 通常検索
			$searchController = new SearchsController();
			$orderUrls = [];
			$orderParams = [];
			$searchController->normal_search($wheres, $param, $orderUrls);

			foreach ($orderUrls as $no => $orderUrl) {
				ksort($orderUrl);
				foreach ($orderUrl as $data) {
					array_push($orderParams, $data);
				}
			}
			if (implode(null,$orderParams) != implode(null, explode('/', $param))) {
				$orderUrl = implode("/",$orderParams)."/";
				$orderUrl = Router::url("/".URLUtil::RANKING. "/". $orderUrl, true);
				$this->redirect($orderUrl);
			}

			if (isset($_GET[URLUtil::MONTH_RANKING_PARA])) {
				$wheres[URLUtil::MONTH_RANKING_PARA] = date('Y-m-d H:i:s');
			}

			$this->paginate = $this->Shop->makeFindForRankingFront($wheres, PagingUtil::FRON_SEARCH);

			$this->request->data['Make'] = $wheres;
			$this->request->data['Make']['station_cd'] = $wheres['station_g_cd'];

			// サイト情報取得
			$description = "";
			$this->makeSiteInfo($wheres, $description);

			// 検索結果下部のHTML取得
			if (!$this->isNoIndex) {
				$this->getHtml($wheres);
			}

			$resultCnt = $this->Shop->countForRankingFront($wheres);
			if (!empty($resultCnt) && $resultCnt < PagingUtil::FRON_SEARCH) {

				$ids = [];
				foreach ($this->paginate('Shops') as $shop) {
					array_push($ids, $shop['shop_id']);
				}

				$pref = $wheres['pref'];
				$wheres = [];
				$wheres['shop_id'] = $ids;
				if (count($pref) == 1) {
// 					$wheres['pref'] = $pref;
				}

				$missingCnt = PagingUtil::FRON_SEARCH - count($ids);

				$this->addShops = $this->Shop->findRandForRankingFront($wheres, $missingCnt)->toArray();

				$id_array = [];
				$rank_array = [];
				foreach($this->addShops as $value) {
					$star_array[] = $value['star'];
					$cnt_array[] = $value['review_cnt'];
				}
				// ソートを実行
				array_multisort($star_array, SORT_DESC, $cnt_array, SORT_DESC, $this->addShops);

			} else {
				// 0件の場合 補足店舗情報
				if ($resultCnt == 0) {

					$wheres = [];
					$this->addShops = $this->Shop->findRandForRankingFront($wheres, PagingUtil::FRON_SEARCH)->toArray();

					$id_array = [];
					$rank_array = [];
					foreach($this->addShops as $value) {
						$star_array[] = $value['star'];
						$cnt_array[] = $value['review_cnt'];
					}
					// ソートを実行
					array_multisort($star_array, SORT_DESC, $cnt_array, SORT_DESC, $this->addShops);

					$this->isNoIndex = true;
				}
			}

			SiteInfo::$RANKING[SiteInfo::DESCRIPTION] = sprintf($description, $resultCnt);

			$this->set('isNoIndex', $this->isNoIndex);
		}

	}

	/**
	 * パンクズ用配列取得
	 */
	private function getPankuzuArray() {
		return array(
				'shop_type'=> ['val'=> null, 'url'=> null],
				'pref'=> ['val'=> null, 'url'=> null],
				'area'=> ['val'=> null, 'url'=> null],
				'station'=> ['val'=> null, 'url'=> null],
				'conditions'=> ['val'=> null, 'url'=> null]
		);
	}

	/**
	 * サイト情報
	 */
	private function makeSiteInfo($wheres, &$description) {
		$whereWords = [];

		$place = null;
		$salonType = null;
		$conditions = [];

		// noindex用
		$whereCnt = 0;
		$this->isNoIndex = false;

		$pankuzus = $this->getPankuzuArray();

		$this->PrefData = TableRegistry::get('PrefDatas');
		$this->Area = TableRegistry::get('Areas');
		$this->Station = TableRegistry::get('Stations');
		$this->DepilationSite = TableRegistry::get('DepilationSites');
		$this->Price = TableRegistry::get('Prices');
		$this->Payment = TableRegistry::get('Payments');
		$this->Discount = TableRegistry::get('Discounts');
		$this->OtherCondition = TableRegistry::get('OtherConditions');

		// 都道府県
		if (!empty($wheres['pref'])) {
			$prefNames = [];
			$prefUrlTexts = [];
			foreach ($wheres['pref'] as $pref) {
				array_push($whereWords, Pref::convert($pref, CodePattern::$VALUE));
				array_push($prefNames, Pref::convert($pref, CodePattern::$VALUE));

				$prefData = $this->PrefData->findByPref($pref);
				array_push($prefUrlTexts, $prefData['url_text']);
			}

			$place = implode('、', $prefNames);

			//パンクズ
			$prefUrl = implode(URLUtil::PREF_CONNECTION, $prefUrlTexts);
			$prefUrl = Router::url("/". URLUtil::RANKING. "/". $prefUrl);
			$salonType = ShopType::$DEPILATION_SALON[CodePattern::$VALUE]."・". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE];
			$url = null;
			if (isset($wheres['shop_type'])) {
				if (count($wheres['shop_type']) > 1) {
					$url .= "/".ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]. "/". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2];
				} else {
					$url .= "/".ShopType::convert($wheres['shop_type'][0], CodePattern::$VALUE2);
					$salonType = ShopType::convert($wheres['shop_type'][0], CodePattern::$VALUE);
				}
			}

			// 都道府県が２つ以上チェックされている場合はnoindex
			if (count($wheres['pref']) >= 2) {
				$this->isNoIndex = true;
			}

			$pankuzus['pref']['val'] = $place."の".$salonType;
			$pankuzus['pref']['url'] = $prefUrl. $url;
		} else {
			unset($pankuzus['pref']);
		}

		// 市区町村
		if (!empty($wheres['area_id'])) {
			$areaNames = [];
			$areaUrls = [];
			foreach ($wheres['area_id'] as $areaId) {
				$area = $this->Area->findByIdAndDelFlg($areaId);
				array_push($whereWords, $area['name']);
				array_push($areaNames, $area['name']);

				array_push($areaUrls, URLUtil::CITY. $area['area_id']);
			}

			$place = implode('、', $areaNames);

			// 市区町村が２つ以上チェックされている場合はnoindex
			if (count($wheres['area_id']) >= 2) {
				$this->isNoIndex = true;
			}

			$pankuzus['area']['val'] = $place."の".$salonType;
			$pankuzus['area']['url'] = $prefUrl. "/". implode("/", $areaUrls). $url;
		} else {
			unset($pankuzus['area']);
		}

		// 駅
		if (!empty($wheres['station_cd'])) {
			$stationNames = [];

			$stationUrls = [];
			foreach ($wheres['station_cd'] as $stationCd) {
				$station = $this->Station->findById($stationCd);

				if (!empty($station)) {
					$stationName = "{$station['Line']['line_name']}/{$station['station_name']}駅";

					array_push($whereWords, $stationName);
					array_push($stationNames, $stationName);

					array_push($stationUrls, URLUtil::STATION. $station['station_cd']);
				}
			}

			// 駅検索の場合はnoindex
			$whereCnt = 4;

			$place = implode('、', $stationNames);
			$prefUrl = !empty($prefUrl) ? $prefUrl : "";
			$salonType = !empty($salonType) ? $salonType : ShopType::$DEPILATION_SALON[CodePattern::$VALUE]."・". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE];

			$pankuzus['station']['val'] = $place."の".$salonType;

			if (!empty($url)) {
				$url = $url. "/". implode("/", $stationUrls);
			} else {
				$url = implode("/", $stationUrls);
			}

			$pankuzus['station']['url'] = $prefUrl. "/". $url;
		}

		// グループ駅
		$stationGUrls = [];
		if (!empty($wheres['station_g_cd'])) {
			$stationNames = [];
			$stationGroupCds = [];

			foreach ($wheres['station_g_cd'] as $stationCd) {
				$station = $this->Station->findById($stationCd);

				if(in_array($station['station_g_cd'], $stationGroupCds)) {
					continue;
				}

				array_push($stationGroupCds, $station['station_g_cd']);
			}

			foreach ($stationGroupCds as $stationGroupCd) {
				$station = $this->Station->findById($stationGroupCd);

				if (!empty($station)) {
					$stationName = "{$station['station_name']}駅";
					array_push($whereWords, $stationName);
					array_push($stationNames, $stationName);

					array_push($stationGUrls, URLUtil::STATION_G. $station['station_g_cd']);
				}
			}

			// 市区町村が２つ以上チェックされている場合はnoindex
			if (count($stationGroupCds) >= 2) {
				$this->isNoIndex = true;
			}

			$place = implode('、', $stationNames);
			$prefUrl = !empty($prefUrl) ? $prefUrl : "";
			$salonType = !empty($salonType) ? $salonType : ShopType::$DEPILATION_SALON[CodePattern::$VALUE]."・". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE];

			$pankuzus['station']['val'] = $place."の".$salonType;

			if (!empty($url)) {
				$url = $url. "/". implode("/", $stationGUrls);
			} else {
				$url = implode("/", $stationGUrls);
			}

			$pankuzus['station']['url'] = $prefUrl. "/". $url;
		}

		if (empty($pankuzus['station']['val']) && empty($pankuzus['station']['url'])) {
			unset($pankuzus['station']);
		}

		// 店舗タイプ
		if (!empty($wheres['shop_type'])) {
			$shopTypes = [];
			$shopParams = [];
			foreach ($wheres['shop_type'] as $shopType) {
				array_push($whereWords, ShopType::convert($shopType, CodePattern::$VALUE));
				array_push($shopTypes, ShopType::convert($shopType, CodePattern::$VALUE));

// 				$whereCnt++;
			}

			$salonType = implode('、', $shopTypes);

			// 双方チェックの場合noindex
			if (count($wheres['shop_type']) >= 2) {
				$whereCnt = 4;
			}

			// パンクズ
			if (count($wheres['shop_type']) > 1) {
				$url = Router::url(['controller'=> 'rankings', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]]);
			} else {
				$url = Router::url(['controller'=> 'rankings', 'action'=> 'search', ShopType::convert($wheres['shop_type'][0], CodePattern::$VALUE2)]);
			}
			$pankuzus['shop_type']['val'] = "全国の".implode('・', $shopTypes);
			$pankuzus['shop_type']['url'] = $url;

		} else {
			unset($pankuzus['shop_type']);
		}

		// 脱毛部位
		if (!empty($wheres['depilation_site_id'])) {
			if (!$this->partsSearch) {
				foreach ($wheres['depilation_site_id'] as $depilationSiteId) {
					$depilationSite = $this->DepilationSite->findByIdAndDelFlg($depilationSiteId);
					array_push($whereWords, $depilationSite['name']);
					array_push($conditions, $depilationSite['name']."脱毛");

					$whereCnt++;
				}
			} else {
				array_push($whereWords, "部分脱毛");
				array_push($conditions, "部分脱毛");

				$whereCnt++;
			}
		}
		// 価格
		if (!empty($wheres['price_id'])) {
			foreach ($wheres['price_id'] as $priceId) {
				$price = $this->Price->findByIdAndDelFlg($priceId);
				array_push($whereWords, $price['name']);
				array_push($conditions, $price['name']);

				$whereCnt++;
			}
		}
		// 支払方法
		if (!empty($wheres['payment_id'])) {
			foreach ($wheres['payment_id'] as $paymentId) {
				$payment = $this->Payment->findByIdAndDelFlg($paymentId);
				array_push($whereWords, $payment['name']);
				array_push($conditions, $payment['name']);

				$whereCnt++;
			}
		}
		// 特典・割引
		if (!empty($wheres['discount_id'])) {
			foreach ($wheres['discount_id'] as $discountId) {
				$discount = $this->Discount->findByIdAndDelFlg($discountId);
				array_push($whereWords, $discount['name']);
				array_push($conditions, $discount['name']);

				$whereCnt++;
			}
		}
		// その他こだわり条件
		if (!empty($wheres['other_condition_id'])) {
			foreach ($wheres['other_condition_id'] as $otherConditionId) {
				$otherCondition = $this->OtherCondition->findByIdAndDelFlg($otherConditionId);
				array_push($whereWords, $otherCondition['name']);
				array_push($conditions, $otherCondition['name']);

				$whereCnt++;
			}
		}

		// title 設定
		$title = null;
		if (empty($salonType)) {
			$salonType = ShopType::$DEPILATION_SALON[CodePattern::$VALUE]."、". $salonType = ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE];
		}

		$condition = "";
		if (!empty($place)) {
			if (!empty($conditions)) {
				$condition = implode('、', $conditions);

				$title = "{$place}、{$condition}の{$salonType}";
				$pankuzus['conditions']['val'] = "{$condition}、{$place}の{$salonType}";
			} else {
				$title = "{$place}の{$salonType}";
			}
		} else {
			if (!empty($conditions)) {
				$condition = implode('、', $conditions);

				$title = "{$condition}、全国の{$salonType}";
				$pankuzus['conditions']['val'] = "{$condition}、全国の{$salonType}";
			} else {
				$title = "全国の{$salonType}";
			}
		}

		if (empty($pankuzus['conditions']['val'])) {
			unset($pankuzus['conditions']);
		}

		$this->set(compact('pankuzus', 'conditions', 'place'));
		SiteInfo::$RANKING[SiteInfo::TITLE] = sprintf(SiteInfo::$RANKING[SiteInfo::TITLE], $title. "口コミ人気ランキング");

		$description = sprintf(SiteInfo::$RANKING[SiteInfo::DESCRIPTION],
				!empty($place) ? $place : "全国",
				!empty($condition) ? "、".$condition : "",
				$salonType,
				"%s",
				!empty($place) ? $place : "全国",
				$salonType
		);

		if($whereCnt > 1){
			$this->isNoIndex = true;
		}

		// 構造データ
		$structureds = [];
		$i = 2;
		array_unshift($pankuzus, [
				'val'=> '全国の脱毛施設の口コミランキング',
				'url'=> Router::url(['controller'=> 'rankings', 'action'=> 'index'], true)
		]);
		foreach ($pankuzus as $pankuzu) {
			$pankuzu['@type'] = 'ListItem';
			$pankuzu['position'] = "{$i}";
			$pankuzu['item']['@id'] = empty($pankuzu['url']) ? Router::url(null, true) : Router::url($pankuzu['url'], true). "/";
			$pankuzu['item']['name'] =  $pankuzu['val'];

			unset($pankuzu['url']);
			unset($pankuzu['val']);
			$i++;

			array_push($structureds, $pankuzu);
		}

		$this->set('structureds', [parent::structuredBreadcrumbList($structureds, false)]);

		$searchWheres = $wheres;
		$searchWheres['depilation_site_id'] = [];
		$searchWheres['price_id'] = [];
		$searchWheres['payment_id'] = [];
		$searchWheres['discount_id'] = [];
		$searchWheres['other_condition_id'] = [];
		$this->set('searchWheres', $searchWheres);
		$this->set('whereWords', $whereWords);
	}

	/**
	 * 最寄駅取得
	 */
	private function getStation(&$shops) {
		$this->ssTable = TableRegistry::get('ShopStations');
		$this->stationTabel = TableRegistry::get('Stations');
		foreach ($shops as $key => $shop) {
			$shopStations = $this->ssTable->findByShopId($shop['shop_id'])->toArray();
			if (!empty($shopStations)) {
				$stationGroups = [];

				$shops[$key]['station_name'] = [];
				$shops[$key]['station_cd'] = [];
				$shops[$key]['station_g_cd'] = [];
				$shops[$key]['area_id'] = [];
				foreach ($shopStations as $shopStation) {
					if (!in_array($shopStation['Station']['station_g_cd'], $stationGroups)) {
						array_push($stationGroups, $shopStation['Station']['station_g_cd']);

						$station = $this->stationTabel->findById($shopStation['Station']['station_g_cd']);

						array_push($shops[$key]['station_name'], $station['station_name']. "駅");
						array_push($shops[$key]['station_cd'], $shopStation['Station']['station_cd']);
						array_push($shops[$key]['station_g_cd'], $shopStation['Station']['station_g_cd']);

						$areaId = !empty($station['Area']['area_id']) ? $station['Area']['area_id'] : $shop['Area']['area_id'];
// 						array_push($shops[$key]['area_id'], $station['Area']['area_id']);
						array_push($shops[$key]['area_id'], $areaId);
					}
				}
			}
		}
	}

	/**
	 * ランキング下部のHTML取得
	 */
	private function getHtml($wheres) {

		$htmls = [];
		$isPlaceHtml = false;

		// 駅
		if (!empty($wheres['station_g_cd'])) {
			$stationTable = TableRegistry::get('Stations');
			$station = $stationTable->get($wheres['station_g_cd'][0]);

			$stationG = $stationTable->get($station['station_g_cd']);
			array_push($htmls, $stationG['html']);
			$isPlaceHtml = true;
		}

		// 市区町村
		if (count($wheres['area_id']) == 1 && !$isPlaceHtml) {
			$areaTable = TableRegistry::get('Areas');
			$area = $areaTable->findByIdAndDelFlg($wheres['area_id'][0]);
			array_push($htmls, $area['html']);
			$isPlaceHtml = true;
		}

		// 都道府県HTML
		if (count($wheres['pref']) == 1 && !$isPlaceHtml) {
			$prefDataTable = TableRegistry::get('PrefDatas');
			$prefData = $prefDataTable->findByPref($wheres['pref'][0]);
			array_push($htmls, $prefData['html']);
		}

		// 条件
		// 脱毛部位
		if (!empty($wheres['depilation_site_id'])) {
			$dsTable = TableRegistry::get('DepilationSites');
			foreach ($wheres['depilation_site_id'] as $depilationSiteId) {
				$ds = [];
				$ds = $dsTable->findByIdAndDelFlg($depilationSiteId);
				array_push($htmls, $ds['html']);
			}
		}

		// 価格
		if (!empty($wheres['price_id'])) {
			$priceTable = TableRegistry::get('Prices');
			foreach ($wheres['price_id'] as $priceId) {
				$price = [];
				$price = $priceTable->findByIdAndDelFlg($priceId);
				array_push($htmls, $price['html']);
			}
		}

		// 支払方法
		if (!empty($wheres['payment_id'])) {
			$paymentTable = TableRegistry::get('Payments');
			foreach ($wheres['payment_id'] as $paymentId) {
				$payment = [];
				$payment = $paymentTable->findByIdAndDelFlg($paymentId);
				array_push($htmls, $payment['html']);
			}
		}

		// 特典・割引
		if (!empty($wheres['discount_id'])) {
			$discountTable = TableRegistry::get('Discounts');
			foreach ($wheres['discount_id'] as $discountId) {
				$discount = [];
				$discount = $discountTable->findByIdAndDelFlg($discountId);
				array_push($htmls, $discount['html']);
			}
		}

		// その他こだわり条件一覧
		if (!empty($wheres['other_condition_id'])) {
			$ocTable = TableRegistry::get('OtherConditions');
			foreach ($wheres['other_condition_id'] as $otherConditionId) {
				$oc = [];
				$oc = $ocTable->findByIdAndDelFlg($otherConditionId);
				array_push($htmls, $oc['html']);
			}
		}


		$this->set('htmls', $htmls);
	}

}