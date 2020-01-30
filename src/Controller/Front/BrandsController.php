<?php
namespace App\Controller\Front;

use App\Controller\Front\FrontAppController;
use App\Vendor\SiteInfo;
use App\Vendor\Layout;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\JapaneseSyllabary;
use App\Vendor\Code\Alphabet;
use Cake\Network\Exception\NotFoundException;
use Cake\Routing\Router;
use App\Vendor\PagingUtil;

/**
 * ブランド.
 */
class BrandsController extends FrontAppController {

	public $uses = false;

	const INDEX_PAGE = 'index';
	const DETAIL_PAGE = 'detail';
	const REVIEW_INDEX_PAGE = 'review_index';

	public $helpers = [
			'Paginator' => ['templates' => 'paginator-templates']
	];

	/**
	 * ブランド一覧ページ
	 */
	public function index() {

		// TODO 後ほど実装
// 		throw new NotFoundException();
// 		exit;

		$brandTable = TableRegistry::get('Brands');
		$brands = $brandTable->findAllByDelFlg();

		$salons['JA'] = JapaneseSyllabary::getLine();
		$clinics['JA'] = JapaneseSyllabary::getLine();
		$salons['AL'] = Alphabet::valueOf();
		$clinics['AL'] = Alphabet::valueOf();

		foreach ($brands as $brand) {
			if ($brand['shop_type'] == ShopType::$DEPILATION_SALON[CodePattern::$CODE]) {
				// サロン
				// 50音
				if (!empty($brand['japanese_syllabary'])) {
					foreach ($salons['JA'] as $line => $japanesSyllabary) {
						foreach ($japanesSyllabary as $key => $japanes) {
							if (!isset($salons['JA'][$line][$key]['data'])) {
								$salons['JA'][$line][$key]['data'] = [];
							}
							if ($japanes[CodePattern::$CODE] == $brand['japanese_syllabary']) {
								array_push($salons['JA'][$line][$key]['data'], $brand);
								continue 2;
							}
						}
					}
				}
				// アルファベット
				if (!empty($brand['alphabet'])) {
					foreach ($salons['AL'] as $key => $alphabet) {
						if (!isset($salons['AL'][$key]['data'])) {
							$salons['AL'][$key]['data'] = [];
						}
						if ($alphabet[CodePattern::$CODE] == $brand['alphabet']) {
							array_push($salons['AL'][$key]['data'], $brand);
							continue 2;
						}
					}
				}


			} else if ($brand['shop_type'] == ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$CODE]) {
				// クリニック
				// 50音
				foreach ($clinics['JA'] as $line => $japanesSyllabary) {
					foreach ($japanesSyllabary as $key => $japanes) {
						if (!isset($clinics['JA'][$line][$key]['data'])) {
							$clinics['JA'][$line][$key]['data'] = [];
						}
						if ($japanes[CodePattern::$CODE] == $brand['japanese_syllabary']) {
							array_push($clinics['JA'][$line][$key]['data'], $brand);
							continue 3;
						}
					}
				}

				// アルファベット
				if (!empty($brand['alphabet'])) {
					foreach ($clinics['AL'] as $key => $alphabet) {
						if (!isset($clinics['AL'][$key]['data'])) {
							$clinics['AL'][$key]['data'] = [];
						}
						if ($alphabet[CodePattern::$CODE] == $brand['alphabet']) {
							array_push($clinics['AL'][$key]['data'], $brand);
							continue 2;
						}
					}
				}
			}
		}

		// 空配列の削除
		$this->deleteEmptyArray($salons['JA'], true);
		$this->deleteEmptyArray($salons['AL'], false);
		$this->deleteEmptyArray($clinics['JA'], true);
		$this->deleteEmptyArray($clinics['AL'], false);

		$this->set(compact('salons', 'clinics'));

		// 構造化データ
		// BreadcrumbList
		$structureds = [];
		array_push($structureds, parent::structuredBreadcrumbList(null, false));
		$this->set('structureds', $structureds);

		parent::move(SiteInfo::$BRAND_INDEX, Layout::USER_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * 空配列の削除
	 */
	private function deleteEmptyArray(&$array, $isKana = true) {
		foreach ($array as $line => $brand) {
			if ($isKana) {
				// 50音
				$datas = array_column($brand, 'data');
				$emptyArray = true;
				foreach ($datas as $data) {
					if (!empty($data)) {
						$emptyArray = false;
						continue;
					}
				}
				if ($emptyArray) {
					unset($array[$line]);
				}

				foreach ($brand as $key => $data) {
					if (empty($data['data'])) {
						unset($array[$line][$key]);
					}
				}
			} else {
				// アルファベット
				if (empty($brand['data'])) {
					unset($array[$line]);
				}
			}
		}
	}

	/**
	 * ブランド詳細ページ
	 */
	public function detail($brandId = null) {

// 		// TODO 後ほど実装
// 		throw new NotFoundException();
// 		exit;

		$brandTable = TableRegistry::get('Brands');
		$brand = $brandTable->findForDitailById($brandId);

		if (empty($brand['brand_id'])) {
			throw new NotFoundException();
		}

		// 運営店舗情報取得
		$totalReview = [];
		$reviews = [];
		$interviews = [];
		if ($brand['shops']) {
			$shopIds = [];
// 			$shops = [];

			$prefDataTabel = TableRegistry::get('PrefDatas');
			$ssTable = TableRegistry::get('ShopStations');
			$stationTabel = TableRegistry::get('Stations');

			$brand['pref_cds'] = [];
			foreach ($brand['shops'] as $key => $shop) {

				array_push($shopIds, $shop['shop_id']);
// 				array_push($shops, $shop);
				array_push($brand['pref_cds'], $shop['pref']);


				// 都道府県情報
				$prefData = $prefDataTabel->findByPref($shop['pref']);
				$brand['shops'][$key]['pref_url_text'] = $prefData['url_text'];

				// 最寄駅
				$shopStations = $ssTable->findByShopId($shop['shop_id'])->toArray();
				if (!empty($shopStations)) {
					$brand['shops'][$key]['StationG'] = [];

					$stationGroups = [];
					foreach ($shopStations as $stationkey => $shopStation) {
						if (!in_array($shopStation['Station']['station_g_cd'], $stationGroups)) {
							array_push($stationGroups, $shopStation['Station']['station_g_cd']);
							$station = $stationTabel->findById($shopStation['Station']['station_g_cd']);

							$brand['shops'][$key]['StationG'][$stationkey]['station_g_cd'] = $shopStation['Station']['station_g_cd'];
							$brand['shops'][$key]['StationG'][$stationkey]['area_id'] = $station['Area']['area_id'];
							$brand['shops'][$key]['StationG'][$stationkey]['name'] = $station['station_name']. "駅";
						}
					}
				}


				// インタビュー
				if (!empty($shop['interview_title'])) {
					array_push($interviews, [
							'shop_id'=> $shop['shop_id'],
							'name'=> $shop['name'],
							'pref'=> $shop['pref'],
							'interview_title'=> $shop['interview_title'],
							'interview_image_path'=> $shop['interview_image_path']
					]);
				}

			}

			// 総合評価、口コミ数
			$shopTable = TableRegistry::get('Shops');
			$totalReview = $shopTable->findByShopIds($shopIds);

			// 口コミ
			$reviewTable = TableRegistry::get('Reviews');
			$reviews = $reviewTable->findByShopIds($shopIds, 3);

			// インタビュー
// 			$interviewTable = TableRegistry::get('Interviews');
// 			$interviews = $interviewTable->findByShopIds($shopIds);
		}

		$this->set(compact('brand', 'totalReview', 'reviews', 'interviews'));

		// タイトル
		SiteInfo::$BRAND_DETAIL[SiteInfo::TITLE] = sprintf(SiteInfo::$BRAND_DETAIL[SiteInfo::TITLE], $brand['name']);

		// description
		SiteInfo::$BRAND_DETAIL[SiteInfo::DESCRIPTION] = sprintf(SiteInfo::$BRAND_DETAIL[SiteInfo::DESCRIPTION],
				$brand['name'],
				!empty($totalReview['star']) ? "{$brand['name']}の総合評価は【". number_format($totalReview['star'], 2). "】です！" : "",
				$brand['name'],
				$brand['name']
		);

		// 構造化データ
		$structureds = [];
		// LocalBusiness
		$data = [];
		$data['name'] = $brand['name'];
		$data['image_url'] = !empty($brand['image_path']) ? Router::url(['controller'=> 'images', 'action'=> 'brandImage', $brand['brand_id']], true) : "";
		$data['star'] = !empty($totalReview['star']) ? $totalReview['star'] : 0;
		$data['review_cnt'] = !empty($totalReview['review_cnt']) ? $totalReview['review_cnt'] : 0;

		array_push($structureds, parent::structuredLocalBusiness($data));

		// BreadcrumbList
		$pankuzus = [
				[
					'val'=> '店舗名から探す',
					'url'=> Router::url(['controller'=> 'brands'], true). "/",
				],
		];
		$i = 2;
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

		array_push($structureds, parent::structuredBreadcrumbList($breads, false));
		$this->set('structureds', $structureds);

		parent::move(SiteInfo::$BRAND_DETAIL, Layout::USER_LAYOUT, self::DETAIL_PAGE);
	}

	/**
	 * 口コミ一覧
	 */
	public function reviewIndex() {

		$brandId = $this->request->param('brand_id');

		$brandTable = TableRegistry::get('Brands');
		$brand = $brandTable->findForDitailById($brandId);

		if (empty($brand['brand_id'])) {
			throw new NotFoundException();
		}

		$shopIds = [];
		foreach ($brand['shops'] as $key => $shop) {
			array_push($shopIds, $shop['shop_id']);
		}

		$reviewTable = TableRegistry::get('Reviews');
		$this->paginate = $reviewTable->makeFindForFront($shopIds, PagingUtil::FRON_SEARCH);
		$reviews = $this->paginate('Reviews');

		$this->set(compact('brand', 'reviews'));


		$datas = $reviewTable->findByShopIds($shopIds);
		$star = 0;
		foreach ($datas as $data) {
			$star += $data['evaluation'];
		}
		// タイトル
		SiteInfo::$REVIEW_INDEX[SiteInfo::TITLE] = sprintf(SiteInfo::$REVIEW_INDEX[SiteInfo::TITLE],
				$brand['name'],
				count($datas),
				date('Y'),
				date('m')
		);

		// description
		SiteInfo::$REVIEW_INDEX[SiteInfo::DESCRIPTION] = sprintf(SiteInfo::$REVIEW_INDEX[SiteInfo::DESCRIPTION],
				$brand['name'],
				count($datas),
				number_format($star/count($datas),2),
				$brand['name']
		);

		// 構造化データ
		$structureds = [];
		// BreadcrumbList
		$pankuzus = [
				[
						'val'=> '店舗名から探す',
						'url'=> Router::url(['controller'=> 'brands'], true),
				],
				[
						'val'=> $brand['name'],
						'url'=> Router::url(['controller'=> 'brands', 'action'=> 'detail', $brand['brand_id']], true),
				]
		];
		$i = 2;
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

		array_push($structureds, parent::structuredBreadcrumbList($breads, false));
		$this->set('structureds', $structureds);

		parent::move(SiteInfo::$REVIEW_INDEX, Layout::USER_LAYOUT, self::REVIEW_INDEX_PAGE);
	}

}