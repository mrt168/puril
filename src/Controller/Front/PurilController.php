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

class PurilController extends FrontAppController
{
 
  public function index() {
 
    // レイアウトの設定
    $this->viewBuilder()->setLayout('puril_default');
 
  }
}