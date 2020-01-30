<?php
namespace App\Controller\Front;

use App\Vendor\SiteInfo;
use App\Controller\Front\FrontAppController;
use App\Vendor\Layout;
use App\Vendor\Code\Pref;
use Cake\ORM\TableRegistry;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
use App\Vendor\URLUtil;
use App\Vendor\Code\ShopType;
use App\Vendor\Constants;
use App\Vendor\PagingUtil;
use Cake\Network\Exception\NotFoundException;

/**
 * 検索.
 */
class SearchsController extends FrontAppController {

	public $uses = false;

	const INDEX_PAGE = 'index';
	const SEARCH_PAGE = 'search';

	const ORDER_URL = [
			'shop_type' => 1,
			'pref' => 2,
			'area_id' => 3,
			'station_cd' => 4,
			'station_g_cd' => 5,
			'depilation_site_id' => 6,
			'price_id' => 7,
			'payment_id' => 8,
			'discount_id' => 9,
			'other_condition_id' => 10,
			'parts' => 11,
	];

	public $helpers = [
			'Paginator' => ['templates' => 'paginator-templates']
	];

	public function index() {
		$prefTable = TableRegistry::get('PrefDatas');
		$shopTable = TableRegistry::get('Shops');

		$prefs = $prefTable->findByDelFlgOrderByPref();
		ConvertItems::convertObjectValue($prefs)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, 'pref');

		$shopCnt = $shopTable->countByDelFlg();

		$this->set('prefs', $prefs);
		$this->set(compact('prefs', 'shopCnt'));

		SiteInfo::$SEARCH[SiteInfo::DESCRIPTION] = sprintf(SiteInfo::$SEARCH[SiteInfo::DESCRIPTION], number_format($shopCnt));

		// 構造データ
		$this->set('structureds', [parent::structuredBreadcrumbList([])]);

		parent::move(SiteInfo::$SEARCH, Layout::USER_LAYOUT, self::INDEX_PAGE);
	}

	public function search() {

		$url = Router::url(null, true);

		$this->analysis(urldecode($url), URLUtil::SEARCH);

		$this->shopTable = TableRegistry::get('Shops');
		$shops = $this->paginate('Shops')->toArray();

		// 20件に満たない場合の補填
// 		$isAddShop = false;
// 		if ($this->addShops) {
// 			foreach ($this->addShops as $addShop) {
// 			}
// 			$this->set('addShops', $this->addShops);
// 			$isAddShop = true;
// 		}
// 		$this->set('isAddShop', $isAddShop);

		// 最寄駅
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

		// 20件に満たない場合の補填
		$isAddShop = false;
		if ($this->addShops) {
			$addShops = $this->addShops->toArray();
			foreach ($addShops as $key => $addShop) {
				$shopStations = $this->ssTable->findByShopId($addShop['shop_id'])->toArray();
				if (!empty($shopStations)) {
					$stationGroups = [];

					$addShops[$key]['station_name'] = [];
					$addShops[$key]['station_cd'] = [];
					$addShops[$key]['station_g_cd'] = [];
					$addShops[$key]['area_id'] = [];
					foreach ($shopStations as $shopStation) {
						if (!in_array($shopStation['Station']['station_g_cd'], $stationGroups)) {
							array_push($stationGroups, $shopStation['Station']['station_g_cd']);

							$station = $this->stationTabel->findById($shopStation['Station']['station_g_cd']);

							array_push($addShops[$key]['station_name'], $station['station_name']. "駅");
							array_push($addShops[$key]['station_cd'], $shopStation['Station']['station_cd']);
							array_push($addShops[$key]['station_g_cd'], $shopStation['Station']['station_g_cd']);

							$areaId = !empty($station['Area']['area_id']) ? $station['Area']['area_id'] : $addShop['Area']['area_id'];
// 							array_push($addShops[$key]['area_id'], $station['Area']['area_id']);
							array_push($addShops[$key]['area_id'], $areaId);
						}
					}

				}
			}
			$this->set('addShops', $addShops);
			$isAddShop = true;
		}
		$this->set('isAddShop', $isAddShop);

		if (!empty($this->prefCodes)) {
			if (empty($this->areaIds)) {
				$this->areaIds = [null];
			}

			//ピックアップ
			$this->set('pickupShops', $this->getPickupShop($this->prefCodes[0], $this->areaIds[0]));

			// GoogleMap
			$this->set('mapShops', $this->getMapShop($this->prefCodes[0], $this->areaIds[0]));
		}

		$this->set('shops', $shops);

		parent::move(SiteInfo::$SEARCH_RESULT, Layout::USER_LAYOUT, self::SEARCH_PAGE);
	}

	/**
	 * GoogleMapにて都道府県・市区町村を選択し返します.
	 */
	public function searchMap($pref = null, $area = null) {

		if(!$this->request->is('ajax')) {
			throw new NotFoundException();
			return ;
		}

		$this->shopTable = TableRegistry::get('Shops');
		$this->ssTable = TableRegistry::get('ShopStations');

		$result = [];
		if (!empty($pref)) {
			$result['prefName'] = Pref::convert($pref, CodePattern::$VALUE);

			$shops = $this->getMapShop($pref, $pref);
			$resultShops = [];
			foreach ($shops as $shop) {
				array_push($resultShops, ['name'=> $shop->name, 'address'=> $shop->address]);
			}
			$result['shops'] = json_encode($resultShops, JSON_HEX_TAG | JSON_HEX_AMP | JSON_HEX_APOS | JSON_HEX_QUOT);
			$result['areas'] = TableRegistry::get('Areas')->findByPref($pref);
		}
		echo json_encode($result);
		exit;
	}

	/**
	 * URLから条件の解析処理を実施
	 */
	private function analysis($url, $baseUrl) {

		$shopTable = TableRegistry::get('Shops');

		$wheres = [];
		$urls = explode($baseUrl.'/', $url);

		if (1 < count($urls)) {
			$param = $urls[1];
			if (mb_strpos($param, URLUtil::FREE_WORD) !== false) {

				// フリーワード検索
				$this->free_word_search($wheres, $param);
				$this->paginate = $shopTable->makeFindForFrontByFreeWord($wheres, PagingUtil::FRON_SEARCH);

				// 件数
				$resultCnt = $shopTable->find('all', $shopTable->makeFindForFrontByFreeWord($wheres, null))->count();
				$this->set('resultCnt', $resultCnt);

				// 0件の場合 補足店舗情報
				if ($resultCnt == 0) {
					$wheres = [];
					$this->addShops = $shopTable->findRandForFront($wheres, PagingUtil::FRON_SEARCH);
				}

				$this->isNoIndex = true;

			} else {

				// 通常検索
				$orderUrls = [];
				$this->normal_search($wheres, $param, $orderUrls);
				$searchWheres = $wheres;

				$this->paginate = $shopTable->makeFindForFront($wheres, PagingUtil::FRON_SEARCH);

				$this->request->data['Make'] = $wheres;
				$this->request->data['Make']['station_cd'] = $wheres['station_g_cd'];;
				$this->request->data['Map'] = $wheres;

				// サイト情報取得
				$description = "";
				$this->makeSiteInfo($wheres, $description);

				// 検索結果下部のHTML取得
				if (!$this->isNoIndex) {
					$this->getHtml($wheres);
				}

				$resultCnt = $shopTable->countForFront($wheres);
				if (!empty($resultCnt) && $resultCnt < PagingUtil::FRON_SEARCH) {
					$ids = [];
					foreach ($this->paginate('Shops') as $shop) {
						array_push($ids, $shop['shop_id']);
					}

					$pref = $wheres['pref'];
					$wheres = [];
					$wheres['shop_id'] = $ids;
					if (count($pref) == 1) {
						$wheres['pref'] = $pref;
					}

					$missingCnt = PagingUtil::FRON_SEARCH - $this->paginate('Shops')->count();

					$this->addShops = $shopTable->findRandForFront($wheres, $missingCnt);
				} else {
					// 0件の場合 補足店舗情報
					if ($resultCnt == 0) {
						$pref = $wheres['pref'];
						$wheres = [];
						$wheres['pref'] = $pref;

						$this->addShops = $shopTable->findRandForFront($wheres, PagingUtil::FRON_SEARCH);

						$this->isNoIndex = true;
					}
				}

				// 都道府県別脱毛部位件数取得
				$nowUrl = Router::url();
				$shopTypeUrls = [
						Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]]). "/",
						Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]]). "/",
						Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]]). "/",
				];

				if(!empty($wheres['shop_type']) && in_array($nowUrl, $shopTypeUrls)) {
					$prefs = $this->PrefData->findByShopTypeOrderByPref($wheres['shop_type']);
					$this->set('prefs', $prefs);

					// 全身URL
					$this->set('zenshin_url', $this->DepilationSite->findByIdAndDelFlg(1)->url_text);
				}

				SiteInfo::$SEARCH_RESULT[SiteInfo::DESCRIPTION] = sprintf($description, $resultCnt);

				$this->set('resultCnt', $resultCnt);
			}

			$this->set('isNoIndex', $this->isNoIndex);

// 			$this->set('searchWheres', $wheres);
			$searchWheres['depilation_site_id'] = [];
			$searchWheres['price_id'] = [];
			$searchWheres['payment_id'] = [];
			$searchWheres['discount_id'] = [];
			$searchWheres['other_condition_id'] = [];
			$this->set('searchWheres', $searchWheres);
		} else {
			echo "検索条件なし";
			exit;
		}
	}

	/**
	 * 検索用の店舗情報カラム取得
	 */
	private function getShopColumn() {
		return array(
				'pref'=> [],
				'area_id'=> [],
				'station_cd'=> [],
				'station_g_cd'=> [],
				'depilation_site_id'=> [],
				'price_id'=> [],
				'payment_id'=> [],
				'discount_id'=> [],
				'other_condition_id'=> []
		);
	}

	/**
	 * 通常検索時の処理.
	 */
// 	private function normal_search(&$wheres, $param) {
	public  function normal_search(&$wheres, $param, &$orderUrls) {
		$params = explode('/', $param);

		// 不要スラッシュリダイレクト
		if(strpos(Router::url(),'//') !== false){
			$this->redirect(Router::url("/". URLUtil::SEARCH. "/". implode(array_filter($params, "strlen"), "/"), true));
		}

		$this->Shop = TableRegistry::get('Shops');
		$this->PrefData = TableRegistry::get('PrefDatas');
		$this->Area = TableRegistry::get('Areas');
		$this->Station = TableRegistry::get('Stations');
		$this->DepilationSite = TableRegistry::get('DepilationSites');
		$this->Price = TableRegistry::get('Prices');
		$this->Payment = TableRegistry::get('Payments');
		$this->Discount = TableRegistry::get('Discounts');
		$this->OtherCondition = TableRegistry::get('OtherConditions');

		$wheres = $this->getShopColumn();

		// URL順序用
		$orderUrls = [];
		$refererParams = $params;
		$noNeedParams = [];
		$isNoNeddParam = false;
		foreach ($params as $key => $param) {
			if (empty($param)) {
// 				unset($params[$key]);
				continue;
			}

			// 何の条件かチェック
			if ($this->isShopType($param, $orderUrls)) {
				// 店舗タイプ
				if (empty($wheres['shop_type'])) {
					$wheres['shop_type'] = [];
				}

				array_push($wheres['shop_type'], ShopType::convert($param, CodePattern::$CODE));

				$this->shopTypes = $wheres['shop_type'];

			} else if ($this->isPref($param, $wheres, $orderUrls)) {
				// 都道府県
				if (empty($wheres['pref'])) {
					$wheres['pref'] = [];
				}

				if (empty($this->prefCodes)) {
					$this->prefCodes = $wheres['pref'];
					$this->set('prefCodes', $this->prefCodes);
				}
			} else if ($this->isArea($param, $wheres, $orderUrls)) {
				// 市区町村
				if (empty($wheres['area_id'])) {
					$wheres['area_id'] = [];
				}

				if (empty($this->areaIds)) {
					$this->areaIds = $wheres['area_id'];
				}

			} else if ($this->isStation($param, $wheres, $orderUrls)) {
				// 駅
				if (empty($wheres['station_cd'])) {
					$wheres['station_cd'] = [];
				}

			} else if ($this->isStationG($param, $wheres, $orderUrls)) {
				// グループ駅
				if (empty($wheres['station_g_cd'])) {
					$wheres['station_g_cd'] = [];
				}

			} else if ($this->isDepilationSite($param, $wheres, $orderUrls)) {
				// 脱毛部位
				if (empty($wheres['depilation_site_id'])) {
					$wheres['depilation_site_id'] = [];
				}

			} else if ($this->isPrice($param, $wheres, $orderUrls)) {
				// 価格
				if (empty($wheres['price_id'])) {
					$wheres['price_id'] = [];
				}

			} else if ($this->isPayment($param, $wheres, $orderUrls)) {
				// 支払方法
				if (empty($wheres['payment_id'])) {
					$wheres['payment_id'] = [];
				}

			} else if ($this->isDiscount($param, $wheres, $orderUrls)) {
				// 特典・割引
				if (empty($wheres['discount_id'])) {
					$wheres['discount_id'] = [];
				}

			} else if ($this->isOtherCondition($param, $wheres, $orderUrls)) {
				// その他こだわり条件
				if (empty($wheres['other_condition_id'])) {
					$wheres['other_condition_id'] = [];
				}

			} else if ($this->isParts($param, $wheres, $orderUrls)) {
				// 部位脱毛
				if (empty($wheres['depilation_site_id'])) {
					$wheres['depilation_site_id'] = [];
				}

				$this->partsSearch = true;
			} else {
				unset($params[$key]);
				$isNoNeddParam = true;
			}

		}

		// URL並び替え
		ksort($orderUrls);
		$orderParams = [];
		if (!empty($orderUrls[self::ORDER_URL['pref']])) {
			$pref = implode(URLUtil::PREF_CONNECTION, $orderUrls[self::ORDER_URL['pref']]);
			$orderUrls[self::ORDER_URL['pref']] = [];
			array_push($orderUrls[self::ORDER_URL['pref']], $pref);
		}
		foreach ($orderUrls as $no => $orderUrl) {
			ksort($orderUrl);
			foreach ($orderUrl as $data) {
				array_push($orderParams, $data);
			}
		}

		// URL順序が違った場合リダイレクト
		if (implode(null,$orderParams) != implode(null,$params)) {
			$orderUrl = implode("/",$orderParams)."/";
			$orderUrl = Router::url("/".URLUtil::SEARCH. "/". $orderUrl, true);
			$this->redirect($orderUrl);
		}

		// 駅コードに市区町村コードが無い場合はリダイレクト

		if (!empty($wheres['station_cd']) || !empty($wheres['station_g_cd'])) {
			if (empty($wheres['area_id'])) {

				if (!empty($wheres['station_cd'])) {
					$stationCds = $wheres['station_cd'];
				} else if (!empty($wheres['station_g_cd'])) {
					$stationCds = $wheres['station_g_cd'];
				}

				$prefs = [];
				$prefUrlTexts = [];
				$areaUrlTexts = [];
				$stationUrlTexts = [];
				$gStation = null;

				foreach ($stationCds as $stationCd) {
					$station = $this->Station->findById($stationCd);

					if (!empty($wheres['station_cd'])) {
						array_push($stationUrlTexts, URLUtil::STATION. $station['station_cd']);
					} else if (!empty($wheres['station_g_cd']) && !in_array(URLUtil::STATION_G. $station['station_g_cd'], $stationUrlTexts)) {
						array_push($stationUrlTexts, URLUtil::STATION_G. $station['station_g_cd']);

						$gStation = $this->Station->findById($station['station_g_cd']);
					}

					if (!in_array($station['pref_cd'], $prefs)) {
						array_push($prefs, $station['pref_cd']);

						$pref = $this->PrefData->findByPref($station['pref_cd']);
						array_push($prefUrlTexts, $pref['url_text']);
					}

					if (!empty($station['Area']['area_id']) || !empty($gStation['Area']['area_id'])) {
						if (!in_array(URLUtil::CITY. $station['Area']['area_id'], $areaUrlTexts) && empty($gStation)) {
							array_push($areaUrlTexts, URLUtil::CITY. $station['Area']['area_id']);
						} else if (!in_array(URLUtil::CITY. $gStation['Area']['area_id'], $areaUrlTexts)) {
							array_push($areaUrlTexts, URLUtil::CITY. $gStation['Area']['area_id']);
						}
					} else {
						if (!empty($station)) {
							$data = $this->Shop->findByPrefAndStationCd($station['pref_cd'], $station['station_cd']);
						} else if (!empty($gStation)) {
							$data = $this->Shop->findByPrefAndStationCd($gStation['pref_cd'], $gStation['station_cd']);
						} else {
							throw new NotFoundException();
							return ;
						}

						if (empty($data)) {
							throw new NotFoundException();
							return ;
						}

						if (!in_array(URLUtil::CITY. $data['area_id'], $areaUrlTexts)) {
							array_push($areaUrlTexts, URLUtil::CITY. $data['area_id']);
						}
					}

				}

				$shopTypeUrlText = null;
				if (!empty($wheres['shop_type'])) {
					foreach ($wheres['shop_type'] as $shopType) {
						$shopTypeUrlText .= "/". ShopType::convert($shopType, CodePattern::$VALUE2);
					}
				}

				$pos = strpos(Router::url(null,true), implode($stationUrlTexts, "/"));
				$resStr = substr(Router::url(null,true), $pos+mb_strlen(implode($stationUrlTexts, "/")));

				$url = $shopTypeUrlText. "/". implode($prefUrlTexts, URLUtil::PREF_CONNECTION). "/". implode($areaUrlTexts, "/"). "/". implode($stationUrlTexts, "/");

				$this->redirect("/". URLUtil::SEARCH. "/". $url. $resStr);
				return ;
			}

		}

		// 不要なパラメータがあった場合除外リダイレクト
		if ($isNoNeddParam) {
			$url = "/". URLUtil::SEARCH. "/";
			$url .= implode('/', $params);
			$this->redirect($url);
			return;
		}

		// 都道府県HTMLの取得 (都道府県検索のときのみ表示)
// 		if (count($wheres['pref']) == 1) {
// 			if (count(array_filter($wheres)) == 1) {
// 				$prefData = $this->PrefData->findByPref($wheres['pref'][0]);
// 				$this->set('prefHtml', $prefData['html']);
// 			}
// 		}
	}

	/**
	 * フリーワード検索時の処理.
	 */
	private function free_word_search(&$wheres, $param) {
		$param = str_replace(URLUtil::FREE_WORD, '', $param);
		$param = str_replace("/", '', $param);
		$params = explode('&', $param);

		// フリーワード検索文言
		$this->set("whereWords", $params);

// 		$pankuzus = implode("、", $params);
		$pankuzus['free_word']['val'] = implode("、", $params);
		$pankuzus['free_word']['url'] = null;
		$conditions = $params;
		$title = implode("、", $params);

		$this->set(compact('pankuzus', 'conditions'));
		SiteInfo::$SEARCH_RESULT[SiteInfo::TITLE] = sprintf(SiteInfo::$SEARCH_RESULT[SiteInfo::TITLE], $title);
		SiteInfo::$SEARCH_RESULT[SiteInfo::DESCRIPTION] = $title;

		$this->PrefData = TableRegistry::get('PrefDatas');
		$this->Area = TableRegistry::get('Areas');
		$this->DepilationSite = TableRegistry::get('DepilationSites');
		$this->Price = TableRegistry::get('Prices');
		$this->Payment = TableRegistry::get('Payments');
		$this->Discount = TableRegistry::get('Discounts');
		$this->OtherCondition = TableRegistry::get('OtherConditions');

		$wheres = $this->getShopColumn();
		$wheres['free_word'] = [];

		foreach ($params as $param) {
			array_push($wheres['free_word'], $param);

			// 1文字検索 制限 (1文字以上の場合)
			if (mb_strlen($param) > 1) {
				// 脱毛部位検索文言チェック
				if ($this->isDepilationSiteSearchText($param, $wheres)) {
					if (empty($wheres['depilation_site_id'])) {
						$wheres['depilation_site_id'] = [];
					}
				}

				// 価格検索文言チェック
				if ($this->isPriceSearchText($param, $wheres)) {
					if (empty($wheres['price_id'])) {
						$wheres['price_id'] = [];
					}
				}

				// 支払方法検索文言チェック
				if ($this->isPaymentSearchText($param, $wheres)) {
					if (empty($wheres['payment_id'])) {
						$wheres['payment_id'] = [];
					}
				}

				// 特典・割引検索文言チェック
				if ($this->isDiscountSearchText($param, $wheres)) {
					if (empty($wheres['discount_id'])) {
						$wheres['discount_id'] = [];
					}
				}

				// その他こだわり条件検索文言チェック
				if ($this->isOtherConditionSearchText($param, $wheres)) {
					if (empty($wheres['other_condition_id'])) {
						$wheres['other_condition_id'] = [];
					}
				}

			}

			// 都道府県名チェック
			if ($this->isPrefName($param, $wheres)) {
				if (empty($wheres['pref'])) {
					$wheres['pref'] = [];
				}
			}

			// 市区町村名チェック
			if ($this->isAreaName($param, $wheres)) {
				if (empty($wheres['area_id'])) {
					$wheres['area_id'] = [];
				}
			}
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

		$whereCnt = 0;
		$this->isNoIndex = false;

		$pankuzus = $this->getPankuzuArray();

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
			$prefUrl = Router::url("/". URLUtil::SEARCH. "/". $prefUrl);
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
				$url = Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]]);
			} else {
				$url = Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($wheres['shop_type'][0], CodePattern::$VALUE2)]);
			}
			$pankuzus['shop_type']['val'] = "全国の".implode('・', $shopTypes);
			$pankuzus['shop_type']['url'] = $url;

		} else {
// 			$url = Router::url(['controller'=> 'searchs', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]]);
// 			$pankuzus['shop_type']['val'] = "全国の".ShopType::$DEPILATION_SALON[CodePattern::$VALUE]."・". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE];
// 			$pankuzus['shop_type']['url'] = $url;
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
/*
		$date_Y = date("Y");
		$date_m = date("m");
		$shopTable = TableRegistry::get('Shops');
		$reviewCount = $shopTable->find('all', $shopTable->makeFindForReviewCount($wheres, null))->count();
	
		$reviewTitle = '';

		if($reviewCount > 0) {
			$reviewTitle = ':口コミ'.$reviewCount.'件';
		}
*/

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
		SiteInfo::$SEARCH_RESULT[SiteInfo::TITLE] = sprintf(SiteInfo::$SEARCH_RESULT[SiteInfo::TITLE], $title. "");

		$description = sprintf(SiteInfo::$SEARCH_RESULT[SiteInfo::DESCRIPTION],
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
		$i = 3;
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

		$this->set('structureds', [parent::structuredBreadcrumbList($structureds)]);

		$this->set('whereWords', $whereWords);
	}

	/**
	 * 都道府県チェック
	 */
	private function isPref($param, &$wheres, &$orderUrls) {
		$prefs = [];
		if (strpos($param,URLUtil::PREF_CONNECTION) !== false) {

			$prefs = explode(URLUtil::PREF_CONNECTION, $param);
		} else {
			// 一つだけの場合
			$prefData = $this->PrefData->findByUrlText($param);
			if (!empty($prefData)) {
				array_push($wheres['pref'], $prefData['pref']);

				// 都道府県HTML
// 				$this->set('prefHtml', $prefData['html']);

				// 市区町村を取得
// 				$areas = $this->Area->findByPref($prefData['pref']);
// 				$this->set('areas', $areas);

				$orderUrls[self::ORDER_URL['pref']][$prefData['pref']] = $param;

				return true;
			}
			$this->set('areas', null);
			return false;
		}

		// 複数ある場合
		if (!empty($prefs)) {
			foreach ($prefs as $pref) {
				$prefData = $this->PrefData->findByUrlText($pref);
				if (!empty($prefData)) {
					array_push($wheres['pref'], $prefData['pref']);

					$orderUrls[self::ORDER_URL['pref']][$prefData['pref']] = $prefData['url_text'];
				}
			}

			return true;
		}
		return false;
	}

	/**
	 * 駅チェック
	 */
	private function isStation($param, &$wheres, &$orderUrls) {
		if (strpos($param,URLUtil::STATION) !== false) {
			$param = str_replace(URLUtil::STATION, '', $param);
			if (!empty($param)) {
				$station = $this->Station->findById($param);
				if (!empty($station)) {
					array_push($wheres['station_cd'], $station['station_cd']);

					$orderUrls[self::ORDER_URL['station_cd']][$station['station_cd']] = URLUtil::STATION. $station['station_cd'];

					return true;
				}
			}
		}
		return false;
	}

	/**
	 * グループ駅チェック
	 */
	private function isStationG($param, &$wheres, &$orderUrls) {
		if (strpos($param,URLUtil::STATION_G) !== false) {
			$param = str_replace(URLUtil::STATION_G, '', $param);
			if (!empty($param)) {
				$stations = $this->Station->findByStationGCd($param)->toArray();
				if (!empty($stations)) {
					foreach ($stations as $station) {
						array_push($wheres['station_g_cd'], $station['station_cd']);
					}

					$orderUrls[self::ORDER_URL['station_g_cd']][$param] = URLUtil::STATION_G. $param;

					return true;
				}
			}
		}
		return false;
	}

	/**
	 * 市区町村チェック
	 */
	private function isArea($param, &$wheres, &$orderUrls) {
		if (strpos($param,URLUtil::CITY) !== false) {
			$param = str_replace(URLUtil::CITY, '', $param);
			if (!empty($param)) {
				$area = $this->Area->findByIdAndDelFlg($param);

				if (!empty($area)) {
					if (!$this->prefCodes) {
						$this->prefCodes = [];
					}
					if (!in_array($area['pref'], $this->prefCodes)) {
						$this->prefCodes[] = $area['pref'];
						$this->set('prefCodes', $this->prefCodes);
					}

					array_push($wheres['area_id'], $area['area_id']);

					$orderUrls[self::ORDER_URL['area_id']][$area['area_id']] = URLUtil::CITY. $area['area_id'];

					return true;
				}
			}
		}
		return false;
	}

	/**
	 * 店舗タイプチェック
	 */
	private function isShopType($param, &$orderUrls) {
		$shopTypes = ShopType::valueOf();
		foreach ($shopTypes as $shopType) {
			if ($shopType[CodePattern::$VALUE2] == $param) {

				$orderUrls[self::ORDER_URL['shop_type']][$shopType[CodePattern::$CODE]] = $param;
				return true;
			}
		}
		return false;
	}

	/**
	 * 脱毛部位チェック
	 */
	private function isDepilationSite($param, &$wheres, &$orderUrls) {
		$depilationSites = $this->DepilationSite->findByUrlText($param);

		if (!empty($depilationSites)) {
			array_push($wheres['depilation_site_id'], $depilationSites['depilation_site_id']);

			$orderUrls[self::ORDER_URL['depilation_site_id']][$depilationSites['depilation_site_id']] = $param;
			return true;
		}
		return false;
	}

	/**
	 * 価格チェック
	 */
	private function isPrice($param, &$wheres, &$orderUrls) {
		$price = $this->Price->findByUrlText($param);

		if (!empty($price)) {
			array_push($wheres['price_id'], $price['price_id']);
			$orderUrls[self::ORDER_URL['price_id']][$price['price_id']] = $param;
			return true;
		}
		return false;
	}

	/**
	 * 支払方法チェック
	 */
	private function isPayment($param, &$wheres, &$orderUrls) {
		$payment = $this->Payment->findByUrlText($param);

		if (!empty($payment)) {
			array_push($wheres['payment_id'], $payment['payment_id']);
			$orderUrls[self::ORDER_URL['payment_id']][$payment['payment_id']] = $param;
			return true;
		}
		return false;
	}

	/**
	* 特典・割引チェック
	*/
	private function isDiscount($param, &$wheres, &$orderUrls) {
		$discount = $this->Discount->findByUrlText($param);

		if (!empty($discount)) {
			array_push($wheres['discount_id'], $discount['discount_id']);
			$orderUrls[self::ORDER_URL['discount_id']][$discount['discount_id']] = $param;
			return true;
		}
		return false;
	}

	/**
	 * その他こだわり条件チェック
	 */
	private function isOtherCondition($param, &$wheres, &$orderUrls) {
		$otherCondition = $this->OtherCondition->findByUrlText($param);

		if (!empty($otherCondition)) {
			array_push($wheres['other_condition_id'], $otherCondition['other_condition_id']);
			$orderUrls[self::ORDER_URL['other_condition_id']][$otherCondition['other_condition_id']] = $param;
			return true;
		}
		return false;
	}

	/**
	 * 部分脱毛チェック
	 */
	private function isParts($param, &$wheres, &$orderUrls) {
		if ($param == URLUtil::PARTS_DEPILATION) {
			$datas = $this->DepilationSite->find('all');
			if (!empty($datas)) {
				foreach ($datas as $data) {
					if ($data['depilation_site_id'] == 1) {
						continue;
					}

					array_push($wheres['depilation_site_id'], $data['depilation_site_id']);
				}

				$orderUrls[self::ORDER_URL['parts']][1] = $param;
				return true;
			}
		}
		return false;
	}

	/**********************************************************************************************
	 *
	 * フリーワード検索用
	 *
	 **********************************************************************************************/

	/**
	 * 都道府県名チェック
	 */
	private function isPrefName($param, &$wheres) {
		$prefs = $this->PrefData->findBySearchText($param);
		if (!empty($prefs->toArray())) {
			foreach ($prefs as $pref) {
				array_push($wheres['pref'], $pref['pref']);
			}
			return true;
		}
		return false;
	}

	/**
	 * 市区町村名チェック
	 */
	private function isAreaName($param, &$wheres) {
		$areas = $this->Area->findByName($param);
		if (!empty($areas->toArray())) {
			foreach ($areas as $area) {
				array_push($wheres['area_id'], $area['area_id']);
			}
			return true;
		}
		return false;
	}

	/**
	 * 脱毛部位検索文言チェック
	 */
	private function isDepilationSiteSearchText($param, &$wheres) {
		$depilationSites = $this->DepilationSite->findBySearchText($param);
		if (!empty($depilationSites)) {
			foreach ($depilationSites as $depilationSite) {
				array_push($wheres['depilation_site_id'], $depilationSite['depilation_site_id']);
			}
			return true;
		}
		return false;
	}

	/**
	 * 価格検索文言チェック
	 */
	private function isPriceSearchText($param, &$wheres) {
		$prices = $this->Price->findBySearchText($param);

		if (!empty($prices)) {
			foreach ($prices as $price) {
				array_push($wheres['price_id'], $price['price_id']);
			}
			return true;
		}
		return false;
	}

	/**
	 * 支払方法検索文言チェック
	 */
	private function isPaymentSearchText($param, &$wheres) {
		$payments = $this->Payment->findBySearchText($param);

		if (!empty($payments)) {
			foreach ($payments as $payment) {
				array_push($wheres['payment_id'], $payment['payment_id']);
			}
			return true;
		}
		return false;
	}

	/**
	 * 特典・割引検索文言チェック
	 */
	private function isDiscountSearchText($param, &$wheres) {
		$discounts = $this->Discount->findBySearchText($param);

		if (!empty($discounts)) {
			foreach ($discounts as $discount) {
				array_push($wheres['discount_id'], $discount['discount_id']);
			}
			return true;
		}
		return false;
	}

	/**
	 * その他こだわり条件検索文言チェック
	 */
	private function isOtherConditionSearchText($param, &$wheres) {
		$otherConditions = $this->OtherCondition->findBySearchText($param);

		if (!empty($otherConditions)) {
			foreach ($otherConditions as $otherCondition) {
				array_push($wheres['other_condition_id'], $otherCondition['other_condition_id']);
			}
			return true;
		}
		return false;
	}

	/**
	 * ピックアップ記事を取得します.
	 */
	private function getPickupShop($pref = null, $area = null) {

		$shopTypes = [ShopType::$DEPILATION_SALON[CodePattern::$CODE], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$CODE]];
		if (!empty($this->shopTypes)) {
			$shopTypes = $this->shopTypes;
		}
		$this->set('shopTypes', $shopTypes);

		$pickupLimit = 3;
		$pickupShops = $this->shopTable->findPickupByPrefNotnullAffPageUrl($pref, $area, $shopTypes, $pickupLimit)->toArray();
		/**
		if (count($pickupShops) < $pickupLimit) {
			$pickupShopsSec = $this->shopTable->findPickupByPref($pref, $area, $pickupLimit);
			foreach ($pickupShopsSec as $pickupShop) {
				array_push($pickupShops, $pickupShop);
				if ($pickupLimit <= count($pickupShops)) {
					break;
				}
			}
		}
		*/

		$stationTabel = TableRegistry::get('Stations');
		foreach ($pickupShops as $key => $shop) {
			$shopStations = $this->ssTable->findByShopId($shop['shop_id'])->toArray();
			if (!empty($shopStations)) {
				$stationGroups = [];

				$areaId = $shop['area_id'];

				$pickupShops[$key]['station_name'] = [];
				$pickupShops[$key]['station_cd'] = [];
				$pickupShops[$key]['station_g_cd'] = [];
				$pickupShops[$key]['area_id'] = [];
				foreach ($shopStations as $shopStation) {
					if (!in_array($shopStation['Station']['station_g_cd'], $stationGroups)) {
						array_push($stationGroups, $shopStation['Station']['station_g_cd']);

						$station = $this->stationTabel->findById($shopStation['Station']['station_g_cd']);

// 						array_push($pickupShops[$key]['station_name'], $shopStation['Station']['station_name']. "駅");
						array_push($pickupShops[$key]['station_name'], $station['station_name']. "駅");
						array_push($pickupShops[$key]['station_cd'], $shopStation['Station']['station_cd']);
						array_push($pickupShops[$key]['station_g_cd'], $shopStation['Station']['station_g_cd']);
// 						array_push($pickupShops[$key]['area_id'], $station['Area']['area_id']);

						if (!empty($station['Area']['area_id'])) {
							array_push($pickupShops[$key]['area_id'], $station['Area']['area_id']);
						} else {
							array_push($pickupShops[$key]['area_id'], $areaId);
						}
					}
				}
			}
		}

		return $pickupShops;
	}

	/**
	 * GoogleMap用店舗取得.
	 */
	private function getMapShop($pref = null, $area = null) {
		// GoogleMap用の最新の10件を取得
		$mapLimit = 10;
		$mapShops = $this->shopTable->findPickupByPrefNotnullAffPageUrl($pref, $area, null, $mapLimit)->toArray();
		if (count($mapShops) < $mapLimit) {
			$mapShopsSec = $this->shopTable->findPickupByPref($pref, $area, $mapLimit);
			foreach ($mapShopsSec as $mapShop) {
				array_push($mapShops, $mapShop);
				if ($mapLimit <= count($mapShops)) {
					break;
				}
			}
		}

		foreach ($mapShops as $key => $shop) {
			$shopStations = $this->ssTable->findByShopId($shop['shop_id'])->toArray();
			$mapShops[$key]['station_name'] = [];
			$mapShops[$key]['station_cd'] = [];
			if (!empty($shopStations)) {
				foreach ($shopStations as $shopStation) {
					$stationName = "{$shopStation['StationCompany']['company_name']}/{$shopStation['StationLine']['line_name']}/{$shopStation['Station']['station_name']}駅";
					array_push($mapShops[$key]['station_name'], $stationName);
					array_push($mapShops[$key]['station_cd'], $shopStation['Station']['station_cd']);
				}
			}
		}
		return $mapShops;
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