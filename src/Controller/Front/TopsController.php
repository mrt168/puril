<?php
namespace App\Controller\Front;

use App\Vendor\PagingUtil;
use App\Vendor\SiteInfo;
use App\Controller\Front\FrontAppController;
use App\Vendor\Layout;
use App\Vendor\URLUtil;
use Cake\ORM\TableRegistry;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShopType;



/**
 * TOP.
 */
class TopsController extends FrontAppController {

    public $helpers = [
        'Paginator' => ['templates' => 'ranking-paginator-templates']
    ];
	public $uses = false;

	const INDEX_PAGE = 'index';

	public function index() {

		$this->set('noIndex', true);
		$prefTable = TableRegistry::get('PrefDatas');
		$shopTable = TableRegistry::get('Shops');
		$reviewsTable = TableRegistry::get('Reviews');
        $brandTable = TableRegistry::get('Brands');

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
		$salons = $reviewsTable->findByShopTypeOrdeByPostDate(null, 5);
//		$medicals = $reviewsTable->findByShopTypeOrdeByPostDate(ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$CODE], 5);



        $this->Brand = TableRegistry::get('Brands');


        $wheres = array();
        if (isset($_GET[URLUtil::MONTH_RANKING_PARA])) {
            $wheres[URLUtil::MONTH_RANKING_PARA] = date('Y-m-d H:i:s');
        }
        $wheres['shop_type'] = ShopType::convert(ShopType::$DEPILATION_SALON[CodePattern::$CODE], CodePattern::$CODE);
        $this->paginate = $brandTable->makeFindForFront($wheres, 3);
        $rank_brand_salon = $this->paginate('Brands');

        $wheres['shop_type'] = ShopType::convert(ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$CODE], CodePattern::$CODE);
        $this->paginate = $brandTable->makeFindForFront($wheres, 3);
        $rank_brand_clinic = $this->paginate('Brands');

		// 店舗件数
		$shopCnt = $shopTable->countByDelFlg();

		$this->set(compact('prefs', 'regionPrefs', 'shopCnt', 'salons', 'rank_brand_salon','rank_brand_clinic'));

		// 構造データ
		$this->set('structureds', [parent::structuredOrganization()]);

		parent::move(SiteInfo::$TOP, Layout::USER_LAYOUT, self::INDEX_PAGE);
	}

}