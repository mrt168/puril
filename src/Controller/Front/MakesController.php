<?php
namespace App\Controller\Front;

use App\Controller\Front\FrontAppController;
use App\Vendor\Code\Pref;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\CodePattern;
use App\Vendor\URLUtil;
use App\Vendor\Code\ShopType;
use App\Vendor\Constants;
use Cake\Routing\Router;
use Cake\Event\Event;
use Cake\Network\Exception\NotFoundException;

/**
 * 検索等で遷移する際のURL生成
 */
class MakesController extends FrontAppController {

	public $uses = false;

	const WHERE_CNT = 3;

	public function beforeFilter(Event $event) {
// 		parent::initialize();
	}

	public function index() {
		$urlParams = [];

		if (isset($this->request->data['search']) || isset($this->request->data['ranking_search'])) {
			$shopTable = TableRegistry::get('Shops');

			// 検索結果が0件の場合はnoindex
			$urlParams = $this->url_make();
		} else if (isset($this->request->data['free_word_search'])) {
			$this->free_word();
		} else {
			if ($this->request->is('post')) {
				$this->redirect(['controller'=> 'searchs', 'action'=> 'index']);
				return ;
			}
			throw new NotFoundException();
			return ;
		}

		// セットしてきた各値でURLを生成
		$url = '/datsumou/';
		if (isset($this->request->data['search']) || isset($this->request->data['free_word_search'])) {
			$url .= URLUtil::SEARCH;
		} else if (isset($this->request->data['ranking_search'])) {
			$url .= URLUtil::RANKING;
		}

		foreach ($urlParams as $urlParam) {
			$url .= '/'.$urlParam;
		}

		$this->redirect($url. "/");
	}

	/**
	 * 検索時URLを生成.
	 */
	private function url_make() {
		$urlParams = [];
		$data = $this->request->data['Make'];

		// 店舗タイプ
		if (!empty($data['shop_type'])) {
			$this->shop_type($urlParams, $data['shop_type']);
		}

		// 都道府県を選択
		if (!empty($data['pref'])) {
			$this->pref($urlParams, $data['pref']);
		}

		// 市区町村を選択
		if (!empty($data['area_id'])) {
			$this->area($urlParams, $data['area_id'], $data['pref']);
		}

		// 駅を選択
		if (!empty($data['station_cd'])) {
			$this->station($urlParams, $data['station_cd']);
		}

		// 脱毛部位
		if (!empty($data['depilation_site_id'])) {
			$this->depilation_site($urlParams, $data['depilation_site_id']);
		}

		// 価格
		if (!empty($data['price_id'])) {
			$this->price($urlParams, $data['price_id']);
		}

		// 支払方法
		if (!empty($data['payment_id'])) {
			$this->payment($urlParams, $data['payment_id']);
		}

		// 特典・割引
		if (!empty($data['discount_id'])) {
			$this->discount($urlParams, $data['discount_id']);
		}

		// その他こだわり条件
		if (!empty($data['other_condition_id'])) {
			$this->other_condition($urlParams, $data['other_condition_id']);
		}

		return $urlParams;
	}

	/**
	 * フリーワード検索してきた場合のURLを生成.
	 */
	private function free_word() {
		$data = $this->request->data['Make'];

		// 検索文言を保持する
		$freeWord = $data['free_word'];

		if (!empty($freeWord)) {
			// 空白変換
			$freeWord = str_replace('　', ' ', $freeWord);
			$freeWord = trim($freeWord);
			$freeWord = preg_replace('/\s+/', ' ', $freeWord);
			$freeWords = explode(' ',$freeWord);

			$freeWord = implode('&', $freeWords);

			$url = "/datsumou/". URLUtil::SEARCH. "/". URLUtil::FREE_WORD ."{$freeWord}/";
		} else {
			$url = Router::url(['controller'=> 'searchs', 'action'=> 'index'], true);
// 			$url = "/". URLUtil::SEARCH. "/". ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]. "/". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]. "/";
		}

		$this->redirect($url);
	}

	/**
	 * 店舗タイプのURL生成.
	 */
	private function shop_type(&$urlParams, $value) {
		$shopTypes = [];
		if (is_array($value)) {
			$shopTypes = $value;
		} else {
			array_push($shopTypes, $value);
		}

		foreach ($shopTypes as $shopType) {
			$shopType = ShopType::convert($shopType, CodePattern::$VALUE2);
			array_push($urlParams, $shopType);
		}
	}

	/**
	 * 都道府県のURL生成.
	 */
	private function pref(&$urlParams, $value) {
		$prefs = [];
		if (is_array($value)) {
			$prefs = $value;
		} else {
			array_push($prefs, $value);
		}

		$prefTable = TableRegistry::get('PrefDatas');
		$urlTexts = [];
		foreach ($prefs as $pref) {
			$data = $prefTable->findByPref($pref);

			array_push($urlTexts, $data['url_text']);
// 			array_push($urlParams, $data['url_text']);
		}

		$urlText = implode(URLUtil::PREF_CONNECTION, $urlTexts);
		array_push($urlParams, $urlText);
	}

	/**
	 * 市区町村のURL生成.
	 */
	private function area(&$urlParams, $value, $pref) {
		$areas = [];
		if (is_array($value)) {
			$areas = $value;
		} else {
			array_push($areas, $value);
		}
		$areas = array_unique($areas);

		$areaTable = TableRegistry::get('Areas');
		$isPref = false;
		foreach ($areas as $area) {
			$data = $areaTable->findByIdAndDelFlg($area);

			if (empty($pref) && !$isPref) {
				$prefTable = TableRegistry::get('PrefDatas');
				$prefData = $prefTable->findByPref($data['pref']);
				array_push($urlParams, $prefData['url_text']);

				$isPref = true;
			}

			$areaUrlText = URLUtil::CITY. $data['area_id'];

			array_push($urlParams, $areaUrlText);
		}
	}

	/**
	 * 駅のURL生成.
	 */
	private function station(&$urlParams, $value) {
		$stations = [];
		if (is_array($value)) {
			$stations = $value;
		} else {
			array_push($stations, $value);
		}

		$stationTable = TableRegistry::get('Stations');
		$stationUrlTexts = [];
		$prefUrlTexts = [];
		$areaUrlTexts = [];
		foreach ($stations as $station) {
			$data = $stationTable->findById($station);

			if (!empty($data['Area']['area_id'])) {

				// 都道府県
				if (!in_array($data['PrefData']['url_text'], $prefUrlTexts)) {
					array_push($prefUrlTexts, $data['PrefData']['url_text']);
				}

				$areaUrlText = URLUtil::CITY. $data['Area']['area_id'];
// 				if (!in_array($areaUrlText, $urlParams)) {
// 					array_push($urlParams, $areaUrlText);
// 				}
				if (!in_array($areaUrlText, $areaUrlTexts)) {
					array_push($areaUrlTexts, $areaUrlText);
				}
			}

			array_push($stationUrlTexts, URLUtil::STATION_G. $data['station_cd']);

// 			$stationUrlText = URLUtil::STATION_G. $data['station_cd'];
// 			array_push($urlParams, $stationUrlText);
		}

		// 都道府県
		if (!in_array(implode("--", $prefUrlTexts), $urlParams)) {
			array_push($urlParams, implode("--", $prefUrlTexts));
		}

		foreach ($areaUrlTexts as $areaUrlText) {
			array_push($urlParams, $areaUrlText);
		}

		foreach ($stationUrlTexts as $stationUrlText) {
			array_push($urlParams, $stationUrlText);
		}

	}

	/**
	 * 脱毛部位のURL生成.
	 */
	private function depilation_site(&$urlParams, $value) {
		$depilationSites = [];
		if (is_array($value)) {
			$depilationSites = $value;
		} else {
			array_push($depilationSites, $value);
		}

		$dsTable = TableRegistry::get('DepilationSites');
		foreach ($depilationSites as $depilationSite) {
			$data = $dsTable->findByIdAndDelFlg($depilationSite);

			array_push($urlParams, $data['url_text']);
		}
	}

	/**
	 * 価格のURL生成.
	 */
	private function price(&$urlParams, $value) {
		$prices = [];
		if (is_array($value)) {
			$prices = $value;
		} else {
			array_push($prices, $value);
		}

		$priceTable = TableRegistry::get('Prices');
		foreach ($prices as $price) {
			$data = $priceTable->findByIdAndDelFlg($price);

			array_push($urlParams, $data['url_text']);
		}
	}

	/**
	 * 支払方法のURL生成.
	 */
	private function payment(&$urlParams, $value) {
		$payments = [];
		if (is_array($value)) {
			$payments = $value;
		} else {
			array_push($payments, $value);
		}

		$paymentTable = TableRegistry::get('Payments');
		foreach ($payments as $payment) {
			$data = $paymentTable->findByIdAndDelFlg($payment);

			array_push($urlParams, $data['url_text']);
		}
	}

	/**
	 * 特典・割引のURL生成.
	 */
	private function discount(&$urlParams, $value) {
		$discounts = [];
		if (is_array($value)) {
			$discounts = $value;
		} else {
			array_push($discounts, $value);
		}

		$discountTable = TableRegistry::get('Discounts');
		foreach ($discounts as $discount) {
			$data = $discountTable->findByIdAndDelFlg($discount);

			array_push($urlParams, $data['url_text']);
		}
	}

	/**
	 * 特典・割引のURL生成.
	 */
	private function other_condition(&$urlParams, $value) {
		$otherConditions = [];
		if (is_array($value)) {
			$otherConditions = $value;
		} else {
			array_push($otherConditions, $value);
		}

		$ocTable = TableRegistry::get('OtherConditions');
		foreach ($otherConditions as $otherCondition) {
			$data = $ocTable->findByIdAndDelFlg($otherCondition);

			array_push($urlParams, $data['url_text']);
		}
	}
}