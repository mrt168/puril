<?php
namespace App\Controller\Front;

use App\Vendor\SiteInfo;
use App\Controller\Front\FrontAppController;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\Pref;
use Cake\Filesystem\File;
use Cake\Routing\Router;

/**
 * Index.
 */
class IndexesController extends FrontAppController {

	public $uses = false;

	const PRIVACY_POLICY_PAGE = 'privacy_policy';
	const SITE_MAP_PAGE = 'site_map';
	const TERMS_MAP_PAGE = 'terms';


	public function index() {

		$this->set('noIndex', true);
		parent::move(SiteInfo::$TOP, null, 'index');
	}

	// プライバシーポリシー
	public function privacyPolicy() {
		$this->set('noIndex', true);
		parent::move(SiteInfo::$PRIVACY_POLICY, null, self::PRIVACY_POLICY_PAGE);
	}

	// サイトマップ
	public function siteMap() {

		$this->set('noIndex', true);
		// 地域別都道府県
		$prefTable = TableRegistry::get('PrefDatas');
		$prefDatas = $prefTable->find('all');
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

		$this->set('regionPrefs', $regionPrefs);

		parent::move(SiteInfo::$SITE_MAP, null, self::SITE_MAP_PAGE);
	}

	// 利用規約
	public function terms() {

		$this->set('noIndex', true);
		parent::move(SiteInfo::$TERMS, null, self::TERMS_MAP_PAGE);
	}

	// サイドバー取得
	public function getSidebar() {

		// コラムTOPページHTML取得
// 		$columnPageHtml = file_get_contents('https://puril.net/column/');
/*
		$columnPageHtml = file_get_contents(Router::url('/', true)."column/");

		// サイドバーHTMLを取得
		$start = mb_strpos($columnPageHtml,'<aside id="sidecolumn">');
		$end = mb_strpos($columnPageHtml,'</aside>');
		$sidebarHtml = mb_substr($columnPageHtml, $start, $end-$start, 'UTF8'). "</aside>";

		// side.ctp 書き換え処理
		$file = new File(APP. "Template/Element/Front/SearchResult/side.ctp");
		$file->write($sidebarHtml);

		echo "取得完了";
*/
		exit;
	}


}