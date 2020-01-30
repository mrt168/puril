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

/**
 * TOP.
 */
class TopsController extends FrontAppController {

	public $uses = false;

	const INDEX_PAGE = 'index';

	public function index() {

		$this->set('noIndex', true);
		$prefTable = TableRegistry::get('PrefDatas');
		$shopTable = TableRegistry::get('Shops');
		$reviewsTable = TableRegistry::get('Reviews');

		// 都道府県
		$prefs = [];
		$prefDatas = $prefTable->find('all');
		foreach ($prefDatas as $prefData) {
			$prefs[$prefData['pref']] = $prefData;
		}

		// 地域別都道府県
		$regionPrefs = Pref::getRegionOptions();
		foreach ($regionPrefs as $region => $pref) {
			foreach ($pref as $prefCode => $value) {
				foreach ($prefDatas as $prefData) {
					if($prefData['pref'] == $prefCode) {
						$regionPrefs[$region][$prefCode] = $prefData['url_text'];
					}
				}
			}
		}

		// 口コミ(脱毛サロン,医療脱毛)
		$salons = $reviewsTable->findByShopTypeOrdeByPostDate(ShopType::$DEPILATION_SALON[CodePattern::$CODE], 5);
		$medicals = $reviewsTable->findByShopTypeOrdeByPostDate(ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$CODE], 5);

		// 店舗件数
		$shopCnt = $shopTable->countByDelFlg();

		$this->set(compact('prefs', 'regionPrefs', 'shopCnt', 'salons', 'medicals'));

		// 構造データ
		$this->set('structureds', [parent::structuredOrganization()]);

		parent::move(SiteInfo::$TOP, Layout::USER_LAYOUT, self::INDEX_PAGE);
	}

}