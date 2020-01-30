<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use App\Vendor\Code\Pref;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use App\Vendor\Code\ShopType;

class TopsController extends AdminAppController {

	const INDEX_PAGE = 'index';

	/**
	 * ログイン後TOP画面へ遷移します.
	 *
	 * @click_url(exclude)
	 */
	public function index() {

		parent::move(ClickUrl::$TOP, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * @click_url(exclude)
	 */
	public function shopSiteMap() {

		$shopTable = TableRegistry::get('Shops');
		$shops = $shopTable->find()->where(['del_flg'=>1,  'show_flg'=>1, 'affiliate_page_url IS NOT'=> NULL]);
		foreach ($shops as $shop) {
			if (empty($shop['affiliate_page_url'])) {
				continue;
			}
echo <<<EOF
<url id="{$shop['shop_id']}"><loc>https://puril.net/shop/detail/{$shop['shop_id']}/</loc><changefreq>daily</changefreq></url>\n
EOF;
		}
		exit;
	}

	/**
	 * @click_url(exclude)
	 */
	public function brandSiteMap() {

		$brandTable = TableRegistry::get('Brands');
		$brands = $brandTable->find()->where(['del_flg'=>1]);
		foreach ($brands as $brand) {
echo <<<EOF
<url id="{$brand['brand_id']}"><loc>https://puril.net/brands/{$brand['brand_id']}/</loc><changefreq>daily</changefreq></url>\n
EOF;
		}
		exit;
	}

	/**
	 * @click_url(exclude)
	 */
	public function searchSiteMap() {

		$prefTable = TableRegistry::get('PrefDatas');
		$prefs = $prefTable->find()->where(['del_flg'=>1]);

		$depilationSites = TableRegistry::get('DepilationSites')->find();
		$paymentSites = TableRegistry::get('Payments')->find();
		$discountSites = TableRegistry::get('Discounts')->find();
		$otherConditionSites = TableRegistry::get('OtherConditions')->find();
		$prices = TableRegistry::get('Prices')->find();

		$conditions = [];
		foreach ($depilationSites as $depilationSite) {
			array_push($conditions, $depilationSite['url_text']);
		}
		foreach ($paymentSites as $paymentSite) {
			array_push($conditions, $paymentSite['url_text']);
		}
		foreach ($discountSites as $discountSite) {
			array_push($conditions, $discountSite['url_text']);
		}
		foreach ($otherConditionSites as $otherConditionSite) {
			array_push($conditions, $otherConditionSite['url_text']);
		}
		foreach ($prices as $price) {
			array_push($conditions, $price['url_text']);
		}

		foreach ($prefs as $pref) {
			echo <<<EOF
<url><loc>https://puril.net/search/{$pref['url_text']}/</loc><changefreq>daily</changefreq></url>\n
EOF;
		}

		foreach ($conditions as $condition) {
			echo <<<EOF
<url><loc>https://puril.net/search/{$condition}/</loc><changefreq>daily</changefreq></url>\n
EOF;
		}

		$shopTypes = ShopType::valueOf();
		foreach ($shopTypes as $shopType) {
			foreach ($prefs as $pref) {
				echo <<<EOF
<url><loc>https://puril.net/search/{$shopType['value2']}/{$pref['url_text']}/</loc><changefreq>daily</changefreq></url>\n
EOF;
			}
			foreach ($conditions as $condition) {
				echo <<<EOF
<url><loc>https://puril.net/search/{$shopType['value2']}/{$condition}/</loc><changefreq>daily</changefreq></url>\n
EOF;
			}
		}

		exit;
	}

	/**
	 * @click_url(exclude)
	 */
	public function csv() {
		echo "使用禁止";
		exit;

		parent::move(ClickUrl::$TOP, Layout::ADMIN_AFTER_LOGIN_LAYOUT, 'csv');
	}


	/**
	 * @click_url(exclude)
	 */
	public function csvImport() {

		echo "使用禁止";
		exit;

		$data = $this->request->data['Shops'];

		if (!isset($data['csv_file']) || empty($data['csv_file']['name'])) {
			$this->Flash->set('CSVファイルを選択して下さい。');
			$this->setAction('moveCsv');
			return;
		}

		set_time_limit(0);
		$data = mb_convert_encoding(file_get_contents($data['csv_file']['tmp_name']), 'UTF-8', 'SJIS-win');
		$temp = tmpfile();
		fwrite($temp, $data);
		rewind($temp);

		$count = 0; // 行目はヘッダー扱いするので
		$importCount = 0;
		$errorCount = 0;
		$deleteCount = 0;
		$regex = 'count_target';
		$jogaiRegex = 'jogai_data';
		$reigaiRegex = 'reigai_data';
		$deleteRegex = 'delete_data';
		$proc = 'proc';

		$csvIndexes = [
				'address',
				'name',
				'access',
				'business_hours',
				'holiday',
				'credit_card',
				'facility',
				'staff',
				'parking',
				'conditions',
				'memo',
				'station',
				'scraping_url',
		];

		$areaTable = TableRegistry::get('Areas');
		$shopTable = TableRegistry::get('Shops');
		$socTable = TableRegistry::get('ShopOtherConditions');

		while (($data = fgetcsv($temp, 0, ",")) !== false) {
			$count++;
			try {
				if ($count == 1) {
					$this->Csv->output_message($count, 'ヘッダー', $jogaiRegex);
					$errorCount++;
					continue ;
				}
				$shop = [];
				foreach ($csvIndexes as $csvIndex=> $columnName) {
					if (isset($data[$csvIndex])) {
						$val = trim($data[$csvIndex]);
						$shop[$columnName] = $val;
					}
				}

				$prefs = Pref::valueOf();
				foreach ($prefs as $pref) {
					if (strpos($shop['address'], $pref['value']) !== false) {
						$shop['pref'] = $pref['code'];
					}
				}

				$areas = $areaTable->findBypref($shop['pref']);
				$shop['area_id'] = null;
				foreach ($areas as $area) {
					if (strpos($shop['address'], $area['name']) !== false) {
						$shop['area_id'] = $area['area_id'];
					}
				}

				if (empty($shop['area_id'])) {
					echo "除外住所：". $shop['address']. "<br>";
					continue;
				}

				$shop['show_flg'] = 1;
				$shop['shop_type'] = 2;

				// ユーザーデータ保存
				$shopTable = TableRegistry::get('Shops');
				$shop = $shopTable->newEntity($shop);

				if ($shop->errors()) {
					$this->Csv->output_message($count, $this->Csv->implode_recursive(",", $shop->errors()), $jogaiRegex);
					$errorCount++;
					continue;
				}

				$connection = ConnectionManager::get('default');
				$connection->begin();
				$saveShop = $shopTable->save($shop);

				// mens時のこだわり条件の登録
				$ShopOtherCondition = [];
				$ShopOtherCondition['shop_id'] = $saveShop['shop_id'];
				$ShopOtherCondition['other_condition_id'] = 1;

				$ShopOtherCondition = $socTable->newEntity($ShopOtherCondition);
				$socTable->save($ShopOtherCondition);

				$connection->commit();
				$importCount++;

			} catch (\Exception $e) {
				$this->Csv->output_message($count, $e->getMessage(), $jogaiRegex);
				$errorCount++;
				$connection->rollback();
			}
		}

		echo "完了";

		$this->Csv->csv_comp($regex, $count, $importCount, $deleteCount, $errorCount, $proc);
		exit(0);
	}

}