<?php
namespace App\Controller\Front;

use App\Vendor\SiteInfo;
use App\Controller\Front\FrontAppController;
use App\Vendor\Layout;
use App\Vendor\URLUtil;
use Cake\ORM\TableRegistry;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShopType;

class PurilController extends FrontAppController
{

    public function index() {

        $shopTable = TableRegistry::get('Shops');
        $brandTable = TableRegistry::get('Brands');
        $reviewsTable = TableRegistry::get('Reviews');
        $salons = $reviewsTable->findByShopTypeOrdeByPostDate(null, 3);
        // 店舗件数
        $shopCnt = $shopTable->countByDelFlg();
        $wheres = array();
        if (isset($_GET[URLUtil::MONTH_RANKING_PARA])) {
            $wheres[URLUtil::MONTH_RANKING_PARA] = date('Y-m-d H:i:s');
        }
        $this->paginate = $brandTable->makeFindForFront($wheres, 3);
        $rank_brand = $this->paginate('Brands');

        $this->set(compact('salons', 'rank_brand','shopCnt'));
        // レイアウトの設定
        $this->viewBuilder()->setLayout('puril_default');

    }
}