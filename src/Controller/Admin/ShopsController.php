<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use App\Vendor\PagingUtil;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Messages;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\ShowFlg;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ShopType;
use Cake\Datasource\ConnectionManager;
use App\Controller\Component\CsvComponent;
use Cake\Filesystem\File;

class ShopsController extends AdminAppController {

	const INDEX_PAGE = 'index';
	const EDIT_PAGE = 'edit';
	const IMG_EDIT_PAGE = 'img_edit';
	const STAFF_EDIT_PAGE = 'staff_edit';
	const INTERVIEW_EDIT_PAGE = 'interview_edit';
	const INFO_EDIT_PAGE = 'info_edit';
	const BLOG_EDIT_PAGE = 'blog_edit';
	const POPUP_PAGE = 'popup';
	const DETAIL_PAGE = 'detail';
	const CSV_PAEGE = 'csv_import';

	const SEARCH_SESSION_NAME = "322x8y5BsUgDy9zm";

	//店舗CSVレイアウト
	private static $CSV_INDEX = array(
			/**
			0=> 'shop_id'					// ID
			,1=> 'name'						// 店舗名
			,2=> 'shop_type'				// 施設種類
			,3=> 'brand'					// ブランド
			,4=> 'pref'						// 都道府県
			,5=> 'area'						// 市区町村
			,6=> 'address'					// 住所
			,7=> 'access'					// アクセス/道案内
			,8=> 'business_hours'			// 営業時間
			,9=> 'holiday'					// 定休日
			,10=> 'credit_card'				// クレジットカード
			,11=> 'facility'				// 設備
			,12=> 'staff'					// スタッフ数
			,13=> 'parking'					// 駐車場
			,14=> 'conditions'				// こだわり条件
			,15=> 'memo'					// 備考
			,16=> 'station'					// 最寄駅/バスetc
			,17=> 'stations'				// 最寄駅
			,18=> 'scraping_url'			// スクレイピングURL
			,19=> 'description_subject' 	// 店舗説明文 件名
			,20=> 'description_content'		// 店舗説明文 内容
			,21=> 'affiliate_page_url'		// アフィリエイトページURL
			,22=> 'affiliate_banner_url'	// アフィリエイトバナーURL
			,23=> 'depilation_sites'		// 脱毛部位
			,24=> 'depilation_site_names'	// 脱毛部位名
			,25=> 'payments'				// 支払方法
			,26=> 'payment_names'			// 支払方法名
			,27=> 'discounts'				// 特典・割引
			,28=> 'discount_names'			// 特典・割引名
			,29=> 'other_conditions'		// その他こだわり条件
			,30=> 'other_condition_names'	// その他こだわり条件名
			,31=> 'prices'					// 価格
			,32=> 'price_names'				// 価格名
			,33=> 'show_flg'				// 表示フラグ
			,34=> 'show_flg_name'			// 表示フラグ名
			*/
			0=> 'shop_id'					// ID
			,1=> 'name'						// 店舗名
			,2=> 'shop_type'				// 施設種類
			,3=> 'brand'					// ブランド
			,4=> 'pref'						// 都道府県
			,5=> 'area'						// 市区町村
			,6=> 'address'					// 住所
			,7=> 'access'					// アクセス/道案内
			,8=> 'business_hours'			// 営業時間
			,9=> 'holiday'					// 定休日
			,10=> 'credit_card'				// クレジットカード
			,11=> 'facility'				// 設備
			,12=> 'staff'					// スタッフ数
			,13=> 'parking'					// 駐車場
			,14=> 'conditions'				// こだわり条件
			,15=> 'memo'					// 備考
			,16=> 'station'					// 最寄駅/バスetc
			,17=> 'stations'				// 最寄駅
			,18=> 'price_plan_html'			// 料金プラン(HTML)
			,19=> 'word'					// 店舗からのひとこと
			,20=> 'interview_video_url'		// インタビュー動画URL
			,21=> 'scraping_url'			// スクレイピングURL
			,22=> 'description_subject' 	// 店舗説明文 件名
			,23=> 'description_content'		// 店舗説明文 内容
			,24=> 'affiliate_page_url'		// アフィリエイトページURL
			,25=> 'affiliate_banner_url'	// アフィリエイトバナーURL
			,26=> 'depilation_sites'		// 脱毛部位
			,27=> 'depilation_site_names'	// 脱毛部位名
			,28=> 'payments'				// 支払方法
			,29=> 'payment_names'			// 支払方法名
			,30=> 'discounts'				// 特典・割引
			,31=> 'discount_names'			// 特典・割引名
			,32=> 'other_conditions'		// その他こだわり条件
			,33=> 'other_condition_names'	// その他こだわり条件名
			,34=> 'prices'					// 価格
			,35=> 'price_names'				// 価格名
			,36=> 'show_flg'				// 表示フラグ
			,37=> 'show_flg_name'			// 表示フラグ名
	);

	/**
	 * 店舗一覧画面へ遷移します.
	 *
	 * @click_url(shop_view)
	 */
	public function index() {
		$this->Session->delete(self::SEARCH_SESSION_NAME);
		$this->search();
	}

	/**
	 * 店舗検索処理をします.
	 *
	 * @click_url(shop_view)
	 */
	public function search() {
		$wheres = array();
		if (isset($this->request->data['search'])) {
			$wheres = $this->request->data['Shop'];

		} else {
			if ($this->Session->check(self::SEARCH_SESSION_NAME)) {
				$wheresJson = parent::getSession(self::SEARCH_SESSION_NAME);
				$wheres = json_decode($wheresJson, true);

				$this->request->data['Shop'] = $wheres;
			} else {
				$wheres = array();
			}
		}
		$wheresJson = json_encode($wheres);
		parent::setSession(self::SEARCH_SESSION_NAME, $wheresJson);

		$this->set('wheres', $wheres);

		// 店舗名アンド検索用処理
		if (!empty($wheres['name'])) {
			$shopName = $wheres['name'];
			$wheres['name'] = [];

			$shopName = str_replace('　', ' ', $shopName);
			$shopName = trim($shopName);
			$shopName = preg_replace('/\s+/', ' ', $shopName);
			$wheres['names'] = explode(' ', $shopName);
		}

		$shopTable = TableRegistry::get('Shops');
		$this->paginate = $shopTable->makeFindByDelFlgOrderById($wheres, PagingUtil::SHOP_APP);
		$shops = $this->paginate();

		ConvertItems::convertObjectValue($shops)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, 'pref')
			->codeConverter(ShopType::toString(), CodePattern::$VALUE, 'shop_type')
			->codeConverter(ShowFlg::toString(), CodePattern::$VALUE, 'show_flg');

		// 最寄駅
		$ssTable = TableRegistry::get('ShopStations');
		foreach ($shops as $key => $shop) {
			$shopStations = $ssTable->findByShopId($shop['shop_id'])->toArray();
			if (!empty($shopStations)) {

				$shops[$key]['station_name'] = [];
				foreach ($shopStations as $shopStation) {
// 					$stationName = "{$shopStation['StationCompany']['company_name']}/{$shopStation['StationLine']['line_name']}/{$shopStation['Station']['station_name']}駅";
					$stationName = "{$shopStation['StationLine']['line_name']}/{$shopStation['Station']['station_name']}駅";
					array_push($shops[$key]['station_name'], $stationName);
				}
			}
		}

		$this->set('shops', $shops);

		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * 店舗詳細画面へ遷移します.
	 *
	 * @click_url(shop_view)
	 */
	public function detail($shopId) {
		$shopTable= TableRegistry::get('Shops');
		$shop = $shopTable->findByIdAndDelFlg($shopId);
		if (empty($shopId) || empty($shop)) {
			$this->redirect(array('controller'=> 'scrapings', 'action'=> 'index'));
			return;
		}

		$shop = $shop->toArray();
		ConvertItems::convertValue($shop)
			->codeConverter(ShopType::toString(), CodePattern::$VALUE, 'shop_type')
			->codeConverter(ShowFlg::toString(), CodePattern::$VALUE, 'show_flg');

		$ssTable = TableRegistry::get('ShopStations');
		$shopStations = $ssTable->findByShopId($shop['shop_id']);

		$this->set(compact('shop', 'shopStations'));

		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::DETAIL_PAGE);
	}

	/**
	 * 店舗登録画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveRegist() {
		parent::move(ClickUrl::$SHOP_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
	}

	/**
	 * 店舗編集画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveEdit($shopId = null) {
		if (!empty($shopId)) {
			$shopTable = TableRegistry::get('Shops');
			$shop = $shopTable->findByIdAndDelFlg($shopId);

			$this->set('referer', $this->referer());

			if (!empty($shop)) {
				$this->request->data['Shops'] = $shop;

				$areaTable = TableRegistry::get('Areas');
				$areaDatas = $areaTable->findBypref($shop['pref']);

				$areas = [];
				foreach ($areaDatas as $areaData) {
					$areas[$areaData['area_id']] = $areaData['name'];
				}
				$this->set('areas', $areas);

				// 最寄駅
				$ssTable = TableRegistry::get('ShopStations');
				$shopStations = $ssTable->findByShopId($shopId)->toArray();
				if (!empty($shopStations)) {
					$this->set('shopStations', $shopStations);
				}

				//脱毛部位
				$this->request->data['DepilationSites']['depilation_site_ids'] = [];
				foreach ($shop['depilation_sites'] as $depilationSite) {
					array_push($this->request->data['DepilationSites']['depilation_site_ids'], $depilationSite['depilation_site_id']);
				}
				//支払方法
				$this->request->data['Payments']['payment_ids'] = [];
				foreach ($shop['payments'] as $payment) {
					array_push($this->request->data['Payments']['payment_ids'], $payment['payment_id']);
				}
				//特典・割引
				$this->request->data['Discounts']['discount_ids'] = [];
				foreach ($shop['discounts'] as $discount) {
					array_push($this->request->data['Discounts']['discount_ids'], $discount['discount_id']);
				}
				//その他こだわり条件
				$this->request->data['OtherConditions']['other_condition_ids'] = [];
				foreach ($shop['other_conditions'] as $otherCondition) {
					array_push($this->request->data['OtherConditions']['other_condition_ids'], $otherCondition['other_condition_id']);
				}
				//価格
				$this->request->data['Prices']['price_ids'] = [];
				foreach ($shop['prices'] as $price) {
					array_push($this->request->data['Prices']['price_ids'], $price['price_id']);
				}

			}
		}
		parent::move(ClickUrl::$SHOP_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
	}

	/**
	 * 店舗更新処理を実施します
	 *
	 * @click_url(shop_reg)
	 */
	public function edit() {
		$shopTable = TableRegistry::get('Shops');
		$isUpdate = false;

		if (isset($this->request->data['regist'])) {
			// 新規登録
			$shop = $shopTable->newEntity($this->request->getData(), ['validate'=> 'edit']);
		} else if (isset($this->request->data['update'])) {
			// 更新
			$shop = $shopTable->get($this->request->getData()['Shops']['shop_id']);
			$oldShopData = $shopTable->findById($this->request->getData()['Shops']['shop_id']);
			$shopTable->patchEntity($shop, $this->request->getData(), ['validate'=> 'edit']);
			$isUpdate = true;
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('moveRegist');
			return;
		}

		$shopStationCds = $this->request->getData('ShopStations.station_cds');
		$depilationSiteIds = $this->request->getData('DepilationSites.depilation_site_ids');
		$paymentIds = $this->request->getData('Payments.payment_ids');
		$discountIds = $this->request->getData('Discounts.discount_ids');
		$otherConditionIds = $this->request->getData('OtherConditions.other_condition_ids');
		$priceIds = $this->request->getData('Prices.price_ids');

		$ssTable = TableRegistry::get('ShopStations');
		$sdsTable = TableRegistry::get('ShopDepilationSites');
		$spTable = TableRegistry::get('ShopPayments');
		$sdTable = TableRegistry::get('ShopDiscounts');
		$socTable = TableRegistry::get('ShopOtherConditions');
		$shopPriceTable = TableRegistry::get('ShopPrices');

		if (!$shop->getErrors()) {
			$saveShop = $shopTable->save($shop);

			// 店舗画像（店舗からのひとこと画像）
			if(!empty($this->request->getData()['Shops']['shop_image_file']['tmp_name'])) {
			$isImgEdit = false;
				if (!empty($shop['shop_id'])) {
					$beforeShop = $shopTable->get($shop['shop_id']);
					if (!empty($beforeShop->shop_image_path)) {
						move_uploaded_file($this->request->data['Shops']['shop_image_file']['tmp_name'], $beforeShop->shop_image_path);
						$isImgEdit = true;
					}
				}

				if (!$isImgEdit) {
					$pathInfo = pathinfo($this->request->data['Shops']['shop_image_file']['name']);
					$extension = '.'.$pathInfo['extension'];

					$filePath = $this->Image->upload($this->request->data['Shops']['shop_image_file']['tmp_name'], $this->Image->getShopImageFolder(), true, $extension, null, true);

					$saveData = [];
					$saveData = $shopTable->get($saveShop['shop_id']);
					$saveData['shop_image_path'] = $filePath;
					$shopTable->save($saveData);
				}
			}

			// 最寄駅
			$ssTable->deleteByShopId($saveShop['shop_id']);
			if (!empty($shopStationCds)) {
				foreach ($shopStationCds as $shopStationCd) {
					$shopStation = [];
					$shopStation['shop_id'] = $saveShop['shop_id'];
					$shopStation['station_cd'] = $shopStationCd;

					$shopStation = $ssTable->newEntity($shopStation);
					$ssTable->save($shopStation);
				}
			}

			// 脱毛部位
			$sdsTable->deleteByShopId($saveShop['shop_id']);
			if (!empty($depilationSiteIds)) {
				foreach ($depilationSiteIds as $depilationSiteId) {
					$shopDepilationSite = [];
					$shopDepilationSite['shop_id'] = $saveShop['shop_id'];
					$shopDepilationSite['depilation_site_id'] = $depilationSiteId;

					$shopDepilationSite = $sdsTable->newEntity($shopDepilationSite);
					$sdsTable->save($shopDepilationSite);
				}
			}

			// 支払方法
			$spTable->deleteByShopId($saveShop['shop_id']);
			if (!empty($paymentIds)) {
				foreach ($paymentIds as $paymentId) {
					$shopPayment = [];
					$shopPayment['shop_id'] = $saveShop['shop_id'];
					$shopPayment['payment_id'] = $paymentId;

					$shopPayment = $spTable->newEntity($shopPayment);
					$spTable->save($shopPayment);
				}
			}

			// 特典・割引
			$sdTable->deleteByShopId($saveShop['shop_id']);
			if (!empty($discountIds)) {
				foreach ($discountIds as $discountId) {
					$shopDiscount = [];
					$shopDiscount['shop_id'] = $saveShop['shop_id'];
					$shopDiscount['discount_id'] = $discountId;

					$shopDiscount = $sdTable->newEntity($shopDiscount);
					$sdTable->save($shopDiscount);
				}
			}

			// その他こだわり条件
			$socTable->deleteByShopId($saveShop['shop_id']);
			if (!empty($otherConditionIds)) {
				foreach ($otherConditionIds as $otherConditionId) {
					$shopOtherCondition = [];
					$shopOtherCondition['shop_id'] = $saveShop['shop_id'];
					$shopOtherCondition['other_condition_id'] = $otherConditionId;

					$shopOtherCondition = $socTable->newEntity($shopOtherCondition);
					$socTable->save($shopOtherCondition);
				}
			}

			// 価格
			$shopPriceTable->deleteByShopId($saveShop['shop_id']);
			if (!empty($priceIds)) {
				foreach ($priceIds as $priceId) {
					$shopPrice = [];
					$shopPrice['shop_id'] = $saveShop['shop_id'];
					$shopPrice['price_id'] = $priceId;

					$shopPrice = $shopPriceTable->newEntity($shopPrice);
					$shopPriceTable->save($shopPrice);
				}
			}

			// xml編集
			$this->editXml($saveShop, $oldShopData, $isUpdate);

			$url = [];
			if (!empty($this->request->getData('referer'))) {
				$url = $this->request->getData('referer');
			} else {
				$url= ['controller'=> 'shops', 'action'=> 'index'];
			}

			$this->Flash->set(Messages::UPDATE);
			$this->redirect($url);
			return;
		}
		$this->set('shop', $shop);
		$this->setAction('moveRegist');
	}

	/**
	 * 店舗画像編集画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveImgEdit($shopId = null) {

		$this->request->data['ShopImages']['shop_id'] = $shopId;

		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$shopImgTable = TableRegistry::get('ShopImages');
		$shopImgs = $shopImgTable->findByShopId($shopId);

		$this->set(compact('shop','shopImgs'));

		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::IMG_EDIT_PAGE);
	}

	/**
	 * 店舗画像更新処理を実施します
	 *
	 * @click_url(shop_reg)
	 */
	public function imgEdit() {
		if (!isset($this->request->data['regist']) && !isset($this->request->data['update'])) {
			$this->setAction('moveImgEdit');
			return;
		}
		$shopImgTable = TableRegistry::get('ShopImages');

		$shopImg = $this->request->data;

		if (!empty($shopImg['ShopImages']['image_file']['name']) && isset($shopImg['regist']) ) {
			$cnt = $shopImgTable->countByShopIdAndImageType($shopImg['ShopImages']['shop_id'], $shopImg['ShopImages']['image_type']);
			$cnt++;

			$pathInfo = pathinfo($shopImg['ShopImages']['image_file']['name']);
			$extension = '.'.$pathInfo['extension'];

			$filePath = $this->Image->upload($shopImg['ShopImages']['image_file']['tmp_name'], $this->Image->getShopImageFolder(), true, $extension, null, true);

			$saveData = [];
			$saveData['shop_id'] = $shopImg['ShopImages']['shop_id'];
			$saveData['image_path'] = $filePath;
			$saveData['image_type'] = $shopImg['ShopImages']['image_type'];
			$saveData['priority'] = $cnt;

			$saveData = $shopImgTable->newEntity($saveData);
			$shopImgTable->save($saveData);

			$this->Flash->set(Messages::REGIST);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveImgEdit', $shopImg['ShopImages']['shop_id']));
			return;
		} else if (isset($shopImg['update'])) {

			foreach ($shopImg['Priority'] as $id => $priority) {
				$priority['shop_image_id'] = $id;

				$data = $shopImgTable->get($id);

				$shopImgTable->patchEntity($data, $priority);

				$shopImgTable->save($data);
			}

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveImgEdit', $shopImg['ShopImages']['shop_id']));
			return;
		}

		$this->Flash->set(Messages::INPUT_ERROR);
		$this->redirect(array('controller'=> 'shops', 'action'=> 'moveImgEdit', $shopImg['ShopImages']['shop_id']));
		return;
	}

	/**
	 * スタッフ登録画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveStaffRegist($shopId = null) {
		$this->request->data['Staffs']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$staffTable = TableRegistry::get('Staffs');
		$staffs = $staffTable->findByShopId($shopId);

		$this->set(compact('shop', 'staffs'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::STAFF_EDIT_PAGE);
	}

	/**
	 * スタッフ編集画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveStaffEdit($shopId, $staffId) {
		$this->request->data['Staffs']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$staffTable = TableRegistry::get('Staffs');
		$staff = $staffTable->findByIdAndDelFlg($staffId);

		$staffs = $staffTable->findByShopId($shopId);

		$this->request->data['Staffs'] = $staff;

		$this->set(compact('shop', 'staffs'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::STAFF_EDIT_PAGE);
	}

	/**
	 * スタッフ更新処理を実施します
	 *
	 * @click_url(shop_reg)
	 */
	public function staffEdit() {

		$staffTable = TableRegistry::get('Staffs');

		if (isset($this->request->data['regist'])) {
			// 新規登録
			$staff = $staffTable->newEntity($this->request->getData());
		} else if (isset($this->request->data['update'])) {
			// 更新
			$staff = $staffTable->get($this->request->getData()['Staffs']['staff_id']);
			$staffTable->patchEntity($staff, $this->request->getData());
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('moveStaffRegist');
			return;
		}

		if (!$staff->getErrors()) {
			$saveStaff = $staffTable->save($staff);

			// 画像保存
			if (!empty($this->request->data['Staffs']['image_file']['name'])) {
				$isImgEdit = false;
				if (!empty($staff['staff_id'])) {
					$beforeStaff = $staffTable->get($staff['staff_id']);
					if (!empty($beforeStaff->image_path)) {
						move_uploaded_file($this->request->data['Staffs']['image_file']['tmp_name'], $beforeStaff->image_path);
						$isImgEdit = true;
					}
				}

				if (!$isImgEdit) {
					$pathInfo = pathinfo($this->request->data['Staffs']['image_file']['name']);
					$extension = '.'.$pathInfo['extension'];

					$filePath = $this->Image->upload($this->request->data['Staffs']['image_file']['tmp_name'], $this->Image->getStaffImageFolder(), true, $extension, null, true);

					$saveData = [];
					$saveData = $staffTable->get($saveStaff['staff_id']);
					$saveData['image_path'] = $filePath;
					$staffTable->save($saveData);
				}
			}

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveStaffRegist', $staff['shop_id']));
			return ;
		}
		$this->set('staff', $staff);
		$this->setAction('moveStaffRegist', $staff['shop_id']);
	}

	/**
	 * スタッフ削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function deleteStaff($shopId, $staffId) {
		if (!empty($shopId) && !empty($staffId)) {
			$staffTable = TableRegistry::get('Staffs');
			$staffTable->deleteById($staffId);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(['controller'=> 'shops', 'action'=> 'moveStaffRegist', $shopId]);
	}

	/**
	 * インタビュー登録画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveInterviewRegist($shopId = null) {
		$this->request->data['Interviews']['shop_id'] = $shopId;
		$this->request->data['Shops']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$this->request->data['Shops'] = $shop;

		$interviewTable = TableRegistry::get('Interviews');
		$interviews = $interviewTable->findByShopId($shopId);

		$this->set(compact('shop', 'interviews'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INTERVIEW_EDIT_PAGE);
	}

	/**
	 * インタビュー編集画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveInterviewEdit($shopId, $interviewId) {
		$this->request->data['Interviews']['shop_id'] = $shopId;
		$this->request->data['Shops']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$interviewTable = TableRegistry::get('Interviews');
		$interview = $interviewTable->findByIdAndDelFlg($interviewId);

		$interviews = $interviewTable->findByShopId($shopId);

		$this->request->data['Interviews'] = $interview;

		$this->set(compact('shop', 'interviews'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INTERVIEW_EDIT_PAGE);
	}

	/**
	 * インタビュー更新処理を実施します
	 *
	 * @click_url(shop_reg)
	 */
	public function InterviewEdit() {

		$interviewTable = TableRegistry::get('Interviews');

		if (isset($this->request->data['regist'])) {
			// 新規登録
			$interview = $interviewTable->newEntity($this->request->getData());
		} else if (isset($this->request->data['update'])) {
			// 更新
			$interview = $interviewTable->get($this->request->getData()['Interviews']['interview_id']);
			$interviewTable->patchEntity($interview, $this->request->getData());
		} else if (isset($this->request->data['shop_edit'])) {
			// 店舗情報保存
			$this->interviewDataShopEdit($this->request->getData('Shops'));
			return ;
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('moveInterviewRegist', $this->request->data['Interviews']['shop_id']);
			return;
		}

		if (!$interview->getErrors()) {
			$saveInfonterview = $interviewTable->save($interview);

			// 画像保存
			if (!empty($this->request->data['Interviews']['image_file']['name'])) {
				$isImgEdit = false;
				if (!empty($interview['interview_id'])) {
					$beforeInterview = $interviewTable->get($interview['interview_id']);
					if (!empty($beforeInterview->image_path)) {
						move_uploaded_file($this->request->data['Interviews']['image_file']['tmp_name'], $beforeInterview->image_path);
						$isImgEdit = true;
					}
				}

				if (!$isImgEdit) {
					$pathInfo = pathinfo($this->request->data['Interviews']['image_file']['name']);
					$extension = '.'.$pathInfo['extension'];

					$filePath = $this->Image->upload($this->request->data['Interviews']['image_file']['tmp_name'], $this->Image->getInterviewImageFolder(), true, $extension, null, true);

					$saveData = [];
					$saveData = $interviewTable->get($saveInfonterview['interview_id']);
					$saveData['image_path'] = $filePath;
					$interviewTable->save($saveData);
				}
			}

			$this->Flash->set(Messages::UPDATE, ['key'=> 'interview']);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveInterviewRegist', $interview['shop_id']));
			return ;
		}
		$this->set('interview', $interview);
		$this->setAction('moveInterviewRegist', $interview['shop_id']);
	}

	/**
	 * 店舗インタビュー情報の保存
	 */
	private function interviewDataShopEdit($shop) {

		if (!empty($shop)) {
			$shopTable = TableRegistry::get('Shops');
			$shopData = $shopTable->get($shop['shop_id']);
			$shopTable->patchEntity($shopData, $shop, ['validate'=> 'edit']);

			if (!$shopData->getErrors()) {

				// 店舗画像（店舗からのひとこと画像）
				if(!empty($shop['interview_image_file']['tmp_name'])) {
					$isImgEdit = false;
					if (!empty($shop['shop_id'])) {
						$beforeShop = $shopTable->get($shop['shop_id']);
						if (!empty($beforeShop->interview_image_path)) {
							move_uploaded_file($shop['interview_image_file']['tmp_name'], $beforeShop->interview_image_path);
							$isImgEdit = true;
						}
					}

					if (!$isImgEdit) {
						$pathInfo = pathinfo($shop['interview_image_file']['name']);
						$extension = '.'.$pathInfo['extension'];

						$filePath = $this->Image->upload($shop['interview_image_file']['tmp_name'], $this->Image->getInterviewImageFolder(), true, $extension, null, true);

						$shopData['interview_image_path'] = $filePath;
					}
				}

				$saveShop = $shopTable->save($shopData);

				$this->Flash->set(Messages::UPDATE);
				$this->redirect(array('controller'=> 'shops', 'action'=> 'moveInterviewRegist', $shop['shop_id']));
				return ;
			}

			$this->set('interview', $shopData);
			$this->setAction('moveInterviewRegist', $shop['shop_id']);
		}
	}

	/**
	 * インタビュー削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function deleteInterview($shopId, $interviewId) {
		if (!empty($shopId) && !empty($interviewId)) {
			$interviewTable = TableRegistry::get('Interviews');
			$interviewTable->deleteById($interviewId);

			$this->Flash->set(Messages::DELETE, ['key'=> 'interview']);
		}
		$this->redirect(['controller'=> 'shops', 'action'=> 'moveInterviewRegist', $shopId]);
	}

	/**
	 * お知らせ登録画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveInfoRegist($shopId = null) {
		$this->request->data['Infos']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$infoTable = TableRegistry::get('Infos');
		$infos = $infoTable->findByShopId($shopId);

		$this->set(compact('shop', 'infos'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INFO_EDIT_PAGE);
	}

	/**
	 * お知らせ編集画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveInfoEdit($shopId, $infoId) {
		$this->request->data['Infos']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$infoTable = TableRegistry::get('Infos');
		$info = $infoTable->findByIdAndDelFlg($infoId);

		$infos = $infoTable->findByShopId($shopId);

		$this->request->data['Infos'] = $info;

		$this->set(compact('shop', 'infos'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INFO_EDIT_PAGE);
	}

	/**
	 * お知らせ更新処理を実施します
	 *
	 * @click_url(shop_reg)
	 */
	public function infoEdit($shopId = null) {

		$infoTable = TableRegistry::get('Infos');

		if (isset($this->request->data['regist'])) {
			// 新規登録
			$info = $infoTable->newEntity($this->request->getData());
		} else if (isset($this->request->data['update'])) {
			// 更新
			$info = $infoTable->get($this->request->getData()['Infos']['info_id']);
			$infoTable->patchEntity($info, $this->request->getData());
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('moveInfoRegist');
			return;
		}

		if (!$info->getErrors()) {
			$infoStaff = $infoTable->save($info);

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveInfoRegist', $info['shop_id']));
			return ;
		}
		$this->set('info', $info);
		$this->setAction('moveInfoRegist', $info['shop_id']);
	}

	/**
	 * お知らせ削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function deleteInfo($shopId, $infoId) {
		if (!empty($shopId) && !empty($infoId)) {
			$infoTable = TableRegistry::get('Infos');
			$infoTable->deleteById($infoId);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(['controller'=> 'shops', 'action'=> 'moveInfoRegist', $shopId]);
	}

	/**
	 * ブログ登録画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveBlogRegist($shopId = null) {
		$this->request->data['Blogs']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$blogTable = TableRegistry::get('Blogs');
		$blogs = $blogTable->findByShopId($shopId);

		$this->set(compact('shop', 'blogs'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::BLOG_EDIT_PAGE);
	}

	/**
	 * ブログ編集画面へ遷移します.
	 *
	 * @click_url(shop_reg)
	 */
	public function moveBlogEdit($shopId, $blogId) {
		$this->request->data['Blogs']['shop_id'] = $shopId;
		$shopTable = TableRegistry::get('Shops');
		$shop = $shopTable->get($shopId);

		$blogTable = TableRegistry::get('Blogs');
		$blog = $blogTable->findByIdAndDelFlg($blogId);

		$blogs = $blogTable->findByShopId($shopId);

		$this->request->data['Blogs'] = $blog;

		$this->set(compact('shop', 'blogs'));
		parent::move(ClickUrl::$SHOP_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::BLOG_EDIT_PAGE);
	}

	/**
	 * ブログ更新処理を実施します
	 *
	 * @click_url(shop_reg)
	 */
	public function blogEdit() {

		$blogTable = TableRegistry::get('Blogs');

		if (isset($this->request->data['regist'])) {
			// 新規登録
			$blog = $blogTable->newEntity($this->request->getData());
		} else if (isset($this->request->data['update'])) {
			// 更新
			$blog = $blogTable->get($this->request->getData()['Blogs']['blog_id']);
			$blogTable->patchEntity($blog, $this->request->getData());
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('moveBlogRegist');
			return;
		}

		if (!$blog->getErrors()) {
			$saveBlog = $blogTable->save($blog);

			// 画像保存
			if (!empty($this->request->data['Blogs']['image_file']['name'])) {
				$isImgEdit = false;
				if (!empty($blog['blog_id'])) {
					$beforeBlog = $blogTable->get($blog['blog_id']);
					if (!empty($beforeBlog->image_path)) {
						move_uploaded_file($this->request->data['Blogs']['image_file']['tmp_name'], $beforeBlog->image_path);
						$isImgEdit = true;
					}
				}

				if (!$isImgEdit) {
					$pathInfo = pathinfo($this->request->data['Blogs']['image_file']['name']);
					$extension = '.'.$pathInfo['extension'];

					$filePath = $this->Image->upload($this->request->data['Blogs']['image_file']['tmp_name'], $this->Image->getBlogImageFolder(), true, $extension, null, true);

					$saveData = [];
					$saveData = $blogTable->get($saveBlog['blog_id']);
					$saveData['image_path'] = $filePath;
					$blogTable->save($saveData);
				}
			}

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveBlogRegist', $blog['shop_id']));
			return ;
		}
		$this->set('blog', $blog);
		$this->setAction('moveBlogRegist', $blog['shop_id']);
	}

	/**
	 * ブログ削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function deleteBlog($shopId, $blogId) {
		if (!empty($shopId) && !empty($blogId)) {
			$blogTable = TableRegistry::get('Blogs');
			$blogTable->deleteById($blogId);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(['controller'=> 'shops', 'action'=> 'moveBlogRegist', $shopId]);
	}

	/**
	 * 駅名抽出Windowを表示します.
	 *
	 * @click_url(exclude)
	 */
	public function extraction($shopId = null) {
		$this->set('shopId',$shopId);
		parent::move(ClickUrl::$SHOP_REG, Layout::ADMIN_AFTER_NO_MENU_LAYOUT, self::POPUP_PAGE);
	}

	/**
	 * 駅抽出Window検索処理を実施します.
	 *
	 * @click_url(exclude)
	 */
	public function extractionSearch() {
		$wheres = [];
		if (isset($this->request->data['search'])) {
			$wheres = $this->request->data['Stations'];

		} else {
			if ($this->Session->check(self::SEARCH_SESSION_NAME)) {
				$wheresJson = parent::getSession(self::SEARCH_SESSION_NAME);
				$wheres = json_decode($wheresJson, true);

				$this->request->data['Stations'] = $wheres;
			} else {
				$wheres = array();
			}
		}
		$wheresJson = json_encode($wheres);
		parent::setSession(self::SEARCH_SESSION_NAME, $wheresJson);

		$stationTable = TableRegistry::get('Stations');
		$this->paginate = $stationTable->makeFindByDelFlgOrderById($wheres, PagingUtil::STATION_APP);
		$stations = $this->paginate('Stations');

		$shopId = !empty($wheres['shop_id']) ? $wheres['shop_id'] : null;

		ConvertItems::convertObjectValue($stations)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, 'pref_cd');

		$this->set('stations', $stations);

		$this->extraction($shopId);
	}

	/**
	 * CSVエクスポート.
	 *
	 * @click_url(shop_view)
	 */
	public function csvExport() {

		ini_set('memory_limit', "-1");
		set_time_limit(0);

		if ($this->Session->check(self::SEARCH_SESSION_NAME)) {
			$wheresJson = parent::getSession(self::SEARCH_SESSION_NAME);
			$wheres = json_decode($wheresJson, true);
		} else {
			$wheres = array();
		}
		$shopTable = TableRegistry::get('Shops');
		$shops = $shopTable->findByDelFlgOrderById($wheres);

		if (empty($shops->toArray())) {
			$this->redirect(array('controller'=> 'shops', 'action'=> 'index'));
			return ;
		}

		$data=[];
		$this->ssTable = TableRegistry::get('ShopStations');
		$this->stationTable = TableRegistry::get('Stations');
		foreach ($shops as $key => $shop) {
			$data[$key] = [];
			array_push($data[$key], $shop['shop_id']);
			array_push($data[$key], $shop['name']);
			array_push($data[$key], $shop['shop_type']);
			array_push($data[$key], $shop['Brand']['name']);
			array_push($data[$key], Pref::convert($shop['pref'], CodePattern::$VALUE));
			array_push($data[$key], $shop['Area']['name']);
			array_push($data[$key], $shop['address']);
			array_push($data[$key], $shop['access']);
			array_push($data[$key], $shop['business_hours']);
			array_push($data[$key], $shop['holiday']);
			array_push($data[$key], $shop['credit_card']);
			array_push($data[$key], $shop['facility']);
			array_push($data[$key], $shop['staff']);
			array_push($data[$key], $shop['parking']);
			array_push($data[$key], $shop['conditions']);
			array_push($data[$key], $shop['memo']);
			array_push($data[$key], $shop['station']);

			/**
			// 最寄駅
			$stationNames = [];
			if (!empty($shop['station_cnt'])) {
				$shopStations = $this->ssTable->findByShopId($shop['shop_id'])->toArray();
				if (!empty($shopStations)) {
					foreach ($shopStations as $shopStation) {
						array_push($stationNames, $shopStation['StationLine']['line_name']. "/". $shopStation['Station']['station_name']. "駅");
					}
				}
			}
			array_push($data[$key], implode($stationNames, '&'));
			*/

			// 最寄駅(グループ駅名)
			$stationGroupNames = [];
			$stationGroupCds = [];
			if (!empty($shop['station_cnt'])) {
				$shopStations = $this->ssTable->findByShopId($shop['shop_id'])->toArray();
				if (!empty($shopStations)) {
					foreach ($shopStations as $shopStation) {
						if (!in_array($shopStation['Station']['station_g_cd'], $stationGroupCds)) {
							array_push($stationGroupCds, $shopStation['Station']['station_g_cd']);

							$station = $this->stationTable->findById($shopStation['Station']['station_g_cd']);
							array_push($stationGroupNames, $station['station_name']. "駅");
						}
					}
				}
			}
			array_push($data[$key], implode($stationGroupNames, '&'));

			array_push($data[$key], $shop['price_plan_html']);
			array_push($data[$key], $shop['word']);
			array_push($data[$key], $shop['interview_video_url']);
			array_push($data[$key], $shop['scraping_url']);
			array_push($data[$key], $shop['description_subject']);
			array_push($data[$key], $shop['description_content']);
			array_push($data[$key], $shop['affiliate_page_url']);
			array_push($data[$key], $shop['affiliate_banner_url']);

			// 脱毛部位
			$dsIds = [];
			$dss = [];
			if (!empty($shop['depilation_sites'])) {
				foreach ($shop['depilation_sites'] as $ds) {
					array_push($dsIds, $ds['depilation_site_id']);
					array_push($dss, $ds['name']);
				}
			}
			array_push($data[$key], implode($dsIds, '&'));
			array_push($data[$key], implode($dss, '&'));

			// 支払方法
			$paymentIds = [];
			$payments = [];
			if (!empty($shop['payments'])) {
				foreach ($shop['payments'] as $payment) {
					array_push($paymentIds, $payment['payment_id']);
					array_push($payments, $payment['name']);
				}
			}
			array_push($data[$key], implode($paymentIds, '&'));
			array_push($data[$key], implode($payments, '&'));

			// 特典・割引
			$discountIds = [];
			$discounts = [];
			if (!empty($shop['discounts'])) {
				foreach ($shop['discounts'] as $discount) {
					array_push($discountIds, $discount['discount_id']);
					array_push($discounts, $discount['name']);
				}
			}
			array_push($data[$key], implode($discountIds, '&'));
			array_push($data[$key], implode($discounts, '&'));

			// その他こだわり条件
			$ocIds = [];
			$ocs = [];
			if (!empty($shop['other_conditions'])) {
				foreach ($shop['other_conditions'] as $oc) {
					array_push($ocIds, $oc['other_condition_id']);
					array_push($ocs, $oc['name']);
				}
			}
			array_push($data[$key], implode($ocIds, '&'));
			array_push($data[$key], implode($ocs, '&'));

			// 価格
			$priceIds = [];
			$prices = [];
			if (!empty($shop['prices'])) {
				foreach ($shop['prices'] as $price) {
					array_push($priceIds, $price['price_id']);
					array_push($prices, $price['name']);
				}
			}
			array_push($data[$key], implode($priceIds, '&'));
			array_push($data[$key], implode($prices, '&'));

			array_push($data[$key], $shop['show_flg']);
			array_push($data[$key], ShowFlg::convert($shop['show_flg'], CodePattern::$VALUE));

		}

		//CSVの定義です。なお変数名は任意のものはダメで_headerでないと入りません。
		$_header = [
				'ID','店舗名','店舗種類','ブランド','都道府県','市区町村','住所','アクセス/道案内','営業時間','定休日',
				'クレジットカード','設備','スタッフ数','駐車場','こだわり条件','備考','最寄り駅/バスetc','最寄駅',
				'料金プラン(HTML)','店舗からのひとこと','インタビュー動画URL',
				'スクレイピングURL','店舗説明文 件名','店舗説明文 内容','アフィリエイトページURL','アフィリエイトバナーURL',
				'脱毛部位(ID)','脱毛部位','支払方法(ID)','支払方法','特典・割引(ID)','特典・割引','その他こだわり条件(ID)','その他こだわり条件','価格(ID)','価格',
				'表示フラグ(CODE)','表示フラグ',
		];

		//本データを_serializeに入れます。
		$_serialize = 'data';
		//これいれないと文字エンコーディング変換が有効になりません
		$_extension = 'mbstring';
		// 変換前の文字コード
		$_dataEncoding = 'UTF-8';
		// 変換後の文字エンコーディング
		$_csvEncoding = 'sjis-win';

		$this->response->download(date('Ymd').'店舗情報' . '.csv');
		$this->viewBuilder()->className('CsvView.Csv');
		$this->set(compact('data', '_header', '_serialize', '_extension', '_dataEncoding', '_csvEncoding'));
	}

	/**
	 * 店舗CSVインポート画面へ遷移します..
	 *
	 * @click_url(shop_csv)
	 */
	public function moveCsv() {
		parent::move(ClickUrl::$SHOP_CSV, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::CSV_PAEGE);
	}

	/**
	 * 店舗CSVインポート登録処理を実施します.
	 *
	 * @click_url(shop_csv)
	 */
	public function csvImport() {

		if (empty($this->request->data['Shops']['csv_file'])) {
			$this->setAction('moveCsv');
			return;
		}
		$data = $this->request->data['Shops'];

		if (!isset($data['csv_file']) || empty($data['csv_file']['name'])) {
			$this->Flash->set('CSVファイルを選択して下さい。');
			$this->setAction('moveCsv');
			return;
		}
		//レイアウト作成
		$this->viewBuilder()->setLayout(Layout::ADMIN_AFTER_LOGIN_LAYOUT);
		$this->render('csv_result');

		$body = $this->response->body();
		$this->autoRender = false;
		echo $body;

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

		$this->Shop = TableRegistry::get('Shops');

		$this->Area = TableRegistry::get('Areas');
		$this->Station = TableRegistry::get('Stations');
		$this->ShopStation = TableRegistry::get('ShopStations');

		$this->DepilationSite = TableRegistry::get('DepilationSites');
		$this->Payment = TableRegistry::get('Payments');
		$this->Discount = TableRegistry::get('Discounts');
		$this->OtherCondition = TableRegistry::get('OtherConditions');
		$this->Price = TableRegistry::get('Prices');

		$this->ShopDepilationSite = TableRegistry::get('ShopDepilationSites');
		$this->ShopPayment = TableRegistry::get('ShopPayments');
		$this->ShopDiscount = TableRegistry::get('ShopDiscounts');
		$this->ShopOtherCondition = TableRegistry::get('ShopOtherConditions');
		$this->ShopPrice = TableRegistry::get('ShopPrices');

		$connection = ConnectionManager::get('default');

		while (($data = fgetcsv($temp, 0, ",")) !== false) {
			$count++;
			try {
				if ($count == 1) {
					$this->Csv->output_message($count, 'ヘッダー', $jogaiRegex);
					$errorCount++;
					continue ;
				}

				if ($count > 5001) {
					$this->Csv->output_message($count, '一度に5000件以上はインポートできません', $jogaiRegex);
					break;
				}

				$shop = [];
				foreach (self::$CSV_INDEX as $csvIndex=> $columnName) {
					if (isset($data[$csvIndex])) {
						$val = trim($data[$csvIndex]);
						$shop['Shops'][$columnName] = $val;
					}
				}

				ConvertItems::convertValue($shop)
					->codeConverter(Pref::toString(), CodePattern::$CODE, 'pref');

				if (!ctype_digit($shop['Shops']['pref'])) {
					$this->Csv->output_message($count, '都道府県の入力に誤りがあります。', $jogaiRegex);
					$errorCount++;
					continue ;
				}

				// 都道府県
				if (!empty($shop['Shops']['area'])) {
					$areaName = $shop['Shops']['area'];
					$area = $this->Area->findByPrefAndName($shop['Shops']['pref'], $areaName);
					if (!empty($area['area_id'])) {
						$shop['Shops']['area_id'] = $area['area_id'];
					} else {
						$this->Csv->output_message($count, '市区町村の入力に誤りがあります。', $jogaiRegex);
						$errorCount++;
						continue ;
					}
				} else {
					$this->Csv->output_message($count, '市区町村を入力してください。', $jogaiRegex);
					$errorCount++;
					continue ;
				}

				// 最寄駅
				$stationGCds = [];
				if (!empty($shop['Shops']['stations'])) {
					$stations = explode("&", $shop['Shops']['stations']);
					$noStations = [];
					foreach ($stations as $station) {
						$stationName = str_replace('駅', '', $station);
						$data = $this->Station->findByPrefAndName($shop['Shops']['pref'], $stationName);
						if (!empty($data)) {
							if (!in_array($data['station_g_cd'], $stationGCds)) {
								array_push($stationGCds, $data['station_g_cd']);
							}
						} else {
							array_push($noStations, $station);
						}
					}

					if (!empty($noStations)) {
						$noStation = implode(",", $noStations);
						$this->Csv->output_message($count, "{$noStation} は存在しない駅名です。", $jogaiRegex);
						$errorCount++;
						continue ;
					}
				}

				// 脱毛部位
				$shopDepilationSites = [];
				if (!empty($shop['Shops']['depilation_sites'])) {
					$depilationSiteIds = explode("&", $shop['Shops']['depilation_sites']);
					$noIds = [];
					foreach ($depilationSiteIds as $key => $depilationSiteId) {
						$depilationSite = $this->DepilationSite->findByIdAndDelFlg($depilationSiteId);
						if (!empty($depilationSite)) {
							$shopDepilationSites[$key]['depilation_site_id'] = $depilationSiteId;
						} else {
							array_push($noIds, $depilationSiteId);
						}
					}

					if (!empty($noIds)) {
						$noId = implode(",", $noIds);
						$this->Csv->output_message($count, "脱毛部位ID:{$noId} は存在しません。", $jogaiRegex);
						$errorCount++;
						continue ;
					}
				}

				// 支払方法
				$shopPayments = [];
				if (!empty($shop['Shops']['payments'])) {
					$paymentIds = explode("&", $shop['Shops']['payments']);
					$noIds = [];
					foreach ($paymentIds as $key => $paymentId) {
						$payment = $this->Payment->findByIdAndDelFlg($paymentId);
						if (!empty($payment)) {
							$shopPayments[$key]['payment_id'] = $paymentId;
						} else {
							array_push($noIds, $paymentId);
						}
					}

					if (!empty($noIds)) {
						$noId = implode(",", $noIds);
						$this->Csv->output_message($count, "支払方法ID:{$noId} は存在しません。", $jogaiRegex);
						$errorCount++;
						continue ;
					}
				}

				// 特典・割引
				$shopDiscounts = [];
				if (!empty($shop['Shops']['discounts'])) {
					$discountIds = explode("&", $shop['Shops']['discounts']);
					$noIds = [];
					foreach ($discountIds as $key => $discountId) {
						$discount = $this->Discount->findByIdAndDelFlg($discountId);
						if (!empty($discount)) {
							$shopDiscounts[$key]['discount_id'] = $discountId;
						} else {
							array_push($noIds, $discountId);
						}
					}

					if (!empty($noIds)) {
						$noId = implode(",", $noIds);
						$this->Csv->output_message($count, "特典・割引ID:{$noId} は存在しません。", $jogaiRegex);
						$errorCount++;
						continue ;
					}
				}

				// その他こだわり条件
				$shopOtherConditions = [];
				if (!empty($shop['Shops']['other_conditions'])) {
					$otherConditionIds = explode("&", $shop['Shops']['other_conditions']);
					$noIds = [];
					foreach ($otherConditionIds as $key => $otherConditionId) {
						$otherCondition = $this->OtherCondition->findByIdAndDelFlg($otherConditionId);
						if (!empty($otherCondition)) {
							$shopOtherConditions[$key]['other_condition_id'] = $otherConditionId;
						} else {
							array_push($noIds, $otherConditionId);
						}
					}

					if (!empty($noIds)) {
						$noId = implode(",", $noIds);
						$this->Csv->output_message($count, "その他こだわり条件ID:{$noId} は存在しません。", $jogaiRegex);
						$errorCount++;
						continue ;
					}
				}

				// 価格
				$shopPrices = [];
				if (!empty($shop['Shops']['prices'])) {
					$priceIds = explode("&", $shop['Shops']['prices']);
					$noIds = [];
					foreach ($priceIds as $key => $priceId) {
						$price = $this->Price->findByIdAndDelFlg($priceId);
						if (!empty($price)) {
							$shopPrices[$key]['price_id'] = $priceId;
						} else {
							array_push($noIds, $priceId);
						}
					}

					if (!empty($noIds)) {
						$noId = implode(",", $noIds);
						$this->Csv->output_message($count, "価格ID:{$noId} は存在しません。", $jogaiRegex);
						$errorCount++;
						continue ;
					}
				}


				// 店舗データ保存
				$isUpdate = false;
				if (!empty($shop['Shops']['shop_id'])) {
					$shopData = $this->Shop->findById($shop['Shops']['shop_id']);
					$oldShopData = $this->Shop->findById($shop['Shops']['shop_id']);
					if (empty($shopData)) {
						$this->Csv->output_message($count, '店舗IDの入力に誤りがあります。', $jogaiRegex);
						$errorCount++;
						continue ;
					}

					$this->Shop->patchEntity($shopData, $shop, ['validate'=> 'edit']);
					$isUpdate = true;
				} else {
					$shopData = $this->Shop->newEntity($shop['Shops'], ['validate'=> 'edit']);
				}

				if ($shopData->errors()) {
					$this->Csv->output_message($count, $this->Csv->implode_recursive(",", $shopData->errors()), $jogaiRegex);
					$errorCount++;
					continue;
				}
				$connection->begin();

				$saveShop = $this->Shop->save($shopData);

				// 最寄駅登録
				$this->ShopStation->deleteByShopId($saveShop['shop_id']);
				if (!empty($stationGCds)) {
					foreach ($stationGCds as $stationGCd) {
						$stations = $this->Station->findByStationGCd($stationGCd);
						foreach ($stations as $station) {
							$shopStation = [];
							$shopStation['shop_id'] = $saveShop['shop_id'];
							$shopStation['station_cd'] = $station['station_cd'];

							$shopStation = $this->ShopStation->newEntity($shopStation);
							$this->ShopStation->save($shopStation);
						}
					}
				}

				// 脱毛部位登録
				$this->ShopDepilationSite->deleteByShopId($saveShop['shop_id']);
				if (!empty($shopDepilationSites)) {
					foreach ($shopDepilationSites as $shopDepilationSite) {
						$shopDepilationSite['shop_id'] = $saveShop['shop_id'];

						$shopDepilationSite = $this->ShopDepilationSite->newEntity($shopDepilationSite);
						$this->ShopDepilationSite->save($shopDepilationSite);
					}
				}

				// 支払方法登録
				$this->ShopPayment->deleteByShopId($saveShop['shop_id']);
				if (!empty($shopPayments)) {
					foreach ($shopPayments as $shopPayment) {
						$shopPayment['shop_id'] = $saveShop['shop_id'];

						$shopPayment = $this->ShopPayment->newEntity($shopPayment);
						$this->ShopPayment->save($shopPayment);
					}
				}

				// 特典・割引登録
				$this->ShopDiscount->deleteByShopId($saveShop['shop_id']);
				if (!empty($shopDiscounts)) {
					foreach ($shopDiscounts as $shopDiscount) {
						$shopDiscount['shop_id'] = $saveShop['shop_id'];

						$shopDiscount = $this->ShopDiscount->newEntity($shopDiscount);
						$this->ShopDiscount->save($shopDiscount);
					}
				}

				// その他こだわり条件登録
				$this->ShopOtherCondition->deleteByShopId($saveShop['shop_id']);
				if (!empty($shopOtherConditions)) {
					foreach ($shopOtherConditions as $shopOtherCondition) {
						$shopOtherCondition['shop_id'] = $saveShop['shop_id'];

						$shopOtherCondition = $this->ShopOtherCondition->newEntity($shopOtherCondition);
						$this->ShopOtherCondition->save($shopOtherCondition);
					}
				}

				// 価格登録
				$this->ShopPrice->deleteByShopId($saveShop['shop_id']);
				if (!empty($shopPrices)) {
					foreach ($shopPrices as $shopPrice) {
						$shopPrice['shop_id'] = $saveShop['shop_id'];

						$shopPrice = $this->ShopPrice->newEntity($shopPrice);
						$this->ShopPrice->save($shopPrice);
					}
				}

				//xml編集
				$this->editXml($saveShop, $oldShopData, $isUpdate);

				$connection->commit();
				$importCount++;
			} catch (\Exception $e) {
				$this->Csv->output_message($count, $e->getMessage(), $jogaiRegex);
				$errorCount++;
				$connection->rollback();
			}
			if ($count%5 == 0) {
				CsvComponent::script_message($regex, $count);
			}
		}
		$this->Csv->csv_comp($regex, $count, $importCount, $deleteCount, $errorCount, $proc);
		exit(0);
	}

	/**
	 * 削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function delete($shopId = null) {
		if (!empty($shopId)) {
			$shopTable = TableRegistry::get('Shops');
			$shopTable->deleteById($shopId);

			// xml削除編集
			$this->deleteXml($shopId);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(array('controller'=> 'shops', 'action'=> 'index'));
	}

	/**
	 * 画像削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function imgDelete($shopImgId = null, $shopId = null) {
		if (!empty($shopImgId) && !empty($shopId)) {
			$shopImgTable = TableRegistry::get('ShopImages');

			$shopImg = $shopImgTable->get($shopImgId);
			unlink($shopImg['image_path']);

			$shopImgTable->deleteById($shopImgId);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(array('controller'=> 'shops', 'action'=> 'moveImgEdit', $shopId));
	}

	/**
	 * 店舗画像(店舗からのひとこと)画像削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function shopImgDelete($shopId = null) {
		if (!empty($shopId)) {
			$shopTable = TableRegistry::get('Shops');

			$shop = $shopTable->get($shopId);
			unlink($shop['shop_image_path']);
			$shopTable->patchEntity($shop, ['shop_image_path'=>NULL]);
			$shopTable->save($shop);

			$this->Flash->set("店舗画像を". Messages::DELETE);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveEdit', $shopId));
			return ;
		}
		$this->redirect(array('controller'=> 'shops', 'action'=> 'index'));
	}

	/**
	 * インタビュー画像削除処理を実施します.
	 *
	 * @click_url(shop_view)
	 */
	public function interviewImgDelete($shopId = null) {
		if (!empty($shopId)) {
			$shopTable = TableRegistry::get('Shops');

			$shop = $shopTable->get($shopId);
			unlink($shop['interview_image_path']);
			$shopTable->patchEntity($shop, ['interview_image_path'=>NULL]);
			$shopTable->save($shop);

			$this->Flash->set("アイキャッチ画像を". Messages::DELETE);
			$this->redirect(array('controller'=> 'shops', 'action'=> 'moveInterviewRegist', $shopId));
			return ;
		}
		$this->redirect(array('controller'=> 'shops', 'action'=> 'index'));
	}

	/**
	 * Ajax
	 * 都道府県コードで市区町村を取得
	 *
	 * @click_url(exclude)
	 */
	public function getArea() {
		$this->autoRender = false;
		$pref = $this->request->data['pref'];

		if (!empty($pref) && $pref != Pref::$MISETTEI[CodePattern::$CODE])  {
			$areaTable = TableRegistry::get('Areas');
			$areas = $areaTable->findBypref($pref);
			if (!empty($areas) && isset($areas)) {
				$this->response->body(json_encode($areas));
				return;
			}
		}

		$this->response->body(json_encode("empty"));
	}

	/**
	 * 店舗画像の取得.
	 *
	 * @click_url(exclude)
	 */
	public function image($shopImgId) {
		$this->autoRender = false;

		if (!empty($shopImgId)) {
			$shopImgTable= TableRegistry::get('ShopImages');
			$shopImg = $shopImgTable->get($shopImgId);

			$path = $shopImg->image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}

	/**
	 * 店舗画像（店舗からのひとこと）の取得.
	 *
	 * @click_url(exclude)
	 */
	public function imageWord($shopId) {
		$this->autoRender = false;

		if (!empty($shopId)) {
			$shopTable= TableRegistry::get('Shops');
			$shop = $shopTable->get($shopId);

			$path = $shop->shop_image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}

	/**
	 * 店舗画像（インタビューアイキャッチ画像）の取得.
	 *
	 * @click_url(exclude)
	 */
	public function imageInterviewShop($shopId) {
		$this->autoRender = false;

		if (!empty($shopId)) {
			$shopTable= TableRegistry::get('Shops');
			$shop = $shopTable->get($shopId);

			$path = $shop->interview_image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}

	/**
	 * スタッフ画像の取得.
	 *
	 * @click_url(exclude)
	 */
	public function imageStaff($staffId) {
		$this->autoRender = false;

		if (!empty($staffId)) {
			$staffTable= TableRegistry::get('Staffs');
			$staff = $staffTable->get($staffId);

			$path = $staff->image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}

	/**
	 * スタッフ画像の取得.
	 *
	 * @click_url(exclude)
	 */
	public function imageInterview($interviewId) {
		$this->autoRender = false;

		if (!empty($interviewId)) {
			$interviewTable= TableRegistry::get('Interviews');
			$interview = $interviewTable->get($interviewId);

			$path = $interview->image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}

	/**
	 * ブログ画像の取得.
	 *
	 * @click_url(exclude)
	 */
	public function imageBlog($blogId) {
		$this->autoRender = false;

		if (!empty($blogId)) {
			$blogTable= TableRegistry::get('Blogs');
			$blog = $blogTable->get($blogId);

			$path = $blog->image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}

	/**
	 * 店舗xml編集
	 */
	private function editXml($saveShop, $oldShopData, $isUpdate) {
		$isAdd = false;
		$isDel = false;
		if (!$isUpdate && $saveShop['show_flg'] == ShowFlg::$SHOW[CodePattern::$CODE] && !empty($saveShop['affiliate_page_url'])) {
			$isAdd = true;
		} else {
			if ($saveShop['show_flg'] != $oldShopData['show_flg']) {
				if ($saveShop['show_flg'] == ShowFlg::$SHOW[CodePattern::$CODE] && !empty($saveShop['affiliate_page_url'])) {
					$isAdd = true;
				} else if ($saveShop['show_flg'] == ShowFlg::$HIDE[CodePattern::$CODE]) {
					$isDel = true;
				}
			}
			if ($saveShop['affiliate_page_url'] != $oldShopData['affiliate_page_url']) {
				if (!empty($saveShop['affiliate_page_url']) && $saveShop['show_flg'] == ShowFlg::$SHOW[CodePattern::$CODE]) {
					$isAdd = true;
				} else {
					$isDel = true;
				}
			}
		}

		if ($isAdd && !$isDel) {
			$this->addXml($saveShop['shop_id']);
		} else if (!$isAdd && $isDel) {
			$this->deleteXml($saveShop['shop_id']);
		}


	}

	/**
	 * 店舗xml追加処理
	 */
	private function addXml($shopId) {

		$file = new File(WWW_ROOT."sitemap_shops.xml");
		$xml = $file->read();
		$addxml = <<<EOF
	<url id="{$shopId}"><loc>https://puril.net/shop/detail/{$shopId}/</loc><changefreq>daily</changefreq></url>
</urlset>
EOF;
		$xml = str_replace('</urlset>', $addxml, $xml);
		$file->write($xml);
	}

	/**
	 * 店舗xml削除編集処理
	 */
	private function deleteXml($shopId) {

		$file = new File(WWW_ROOT."sitemap_shops.xml");
		$xml = $file->read();

		$delxml = '<url id="'.$shopId.'"><loc>https://puril.net/shop/detail/'.$shopId.'/</loc><changefreq>daily</changefreq></url>';

		$xml = str_replace($delxml,"",$xml);
		$xml = preg_replace('/\n(\s|\n)*\n/u',"\n",$xml);
		$file->write($xml);
	}
}