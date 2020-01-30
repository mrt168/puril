<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use Cake\ORM\TableRegistry;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\AreaType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\Messages;
use App\Vendor\Code\OtherConditionType;

class ItemsController extends AdminAppController {

	const PREF_PAGE = 'pref';
	const PREF_EDIT_PAGE = 'pref_edit';
	const AREA_PAGE = 'area';
	const AREA_EDIT_PAGE = 'area_edit';
	const STATION_PAGE = 'station';
	const STATION_EDIT_PAGE = 'station_edit';
	const DEPILATIONSITE_PAGE = 'depilation_site';
	const PAYMENT_PAGE = 'payment';
	const DISCOUNT_PAGE = 'discount';
	const OTHER_CONDITIONS_PAGE = 'other_condition';
	const PRICE_PAGE = 'price';
	const IMAGE_PAGE = 'image';
	const HTML_EDIT_PAGE = 'html_edit';

	// 項目種類
	const PREF = "pref";
	const DEPILATIONSITE = "depilation_site";
	const PAYMENT = "payment";
	const DISCOUNT = 'discount';
	const OTHER_CONDITIONS = 'other_condition';
	const PRICE = 'price';

	/**
	 * 都道府県一覧画面へ遷移します.
	 *
	 * @click_url(pref_view)
	 */
	public function pref() {

		$prefTable = TableRegistry::get('PrefDatas');
		$prefDatas = $prefTable->findAllByDelFlg();

		ConvertItems::convertObjectValue($prefDatas)
			->codeConverter(Pref::toString(), CodePattern::$VALUE, 'pref');

		$this->set('prefDatas', $prefDatas);

		parent::move(ClickUrl::$PREF_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::PREF_PAGE);
	}

	/**
	 * 都道府県編集画面へ遷移.
	 *
	 * @click_url(pref_view)
	 */
	public function movePrefEdit($prefDataId) {

		$prefTable = TableRegistry::get('PrefDatas');
		$prefData = $prefTable->findByIdAndDelFlg($prefDataId);

		if (empty($prefData)) {
			$this->redirect(array('controller'=> 'items', 'action'=> 'pref'));
			return;
		}

		$this->request->data['PrefDatas'] = $prefData;
		$this->set('prefData', $prefData);

		parent::move(ClickUrl::$PREF_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::PREF_EDIT_PAGE);
	}

	/**
	 * 都道府県編集処理.
	 *
	 * @click_url(pref_view)
	 */
	public function prefHtmlEdit() {
		if (!isset($this->request->data['update'])) {
			$this->redirect(array('controller'=> 'items', 'action'=> 'pref'));
			return;
		}

		$prefTable = TableRegistry::get('PrefDatas');

		$predData = $prefTable->get($this->request->getData('PrefDatas.pref_data_id'));
		$prefTable->patchEntity($predData, $this->request->getData());

		if (!$predData->getErrors()) {
			$savePrefData = $prefTable->save($predData);

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'items', 'action'=> 'pref', $savePrefData['pref_data_id']));
			return;
		}

		$this->set('predData', $predData);
		$this->setAction('movePrefEdit');
		return ;
	}

	/**
	 * 都道府県編集処理.
	 *
	 * @click_url(pref_view)
	 */
	public function prefEdit() {
		$prefTable= TableRegistry::get('prefDatas');

		$prefDatas = $this->request->data['PrefDatas'];

		$errorWords = [];
		foreach ($prefDatas as $id => $prefData) {

			// 同じURLテキストチェック
			if ($this->check_same_url_text($prefData['url_text'], self::PREF)) {
				array_push($errorWords, $prefData['url_text']);
				unset($prefData['url_text']);
			}

			$prefData['pref_id'] = $id;

			$data = $prefTable->get($id);

			$prefTable->patchEntity($data, $prefData);
			$prefTable->save($data);
		}

		$errorWord = implode('/', $errorWords);
		if (!empty($errorWord)) {
			$this->Flash->set("既に使われています　". $errorWord);
		}

		$this->Flash->set(Messages::UPDATE);
		$this->pref();
	}

	/**
	 * 市区町村一覧画面へ遷移します.
	 *
	 * @click_url(area_view)
	 */
	public function area() {

		parent::move(ClickUrl::$AREA_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::AREA_PAGE);
	}

	/**
	 * 市区町村検索処理を実施します.
	 *
	 * @click_url(area_view)
	 */
	public function areaSearch() {
		if (!empty($this->request->data['pref'])) {
			$areaTable= TableRegistry::get('Areas');
			$areas = $areaTable->findBypref($this->request->data['pref']);

			ConvertItems::convertObjectValue($areas)
			->codeConverter(AreaType::toString(), CodePattern::$VALUE, 'area_type');

			$this->set('areas', $areas);
		} else {
			$this->Flash->set('都道府県を選択して下さい。');
		}
		$this->setAction('area');
	}

	/**
	 * 市区町村HTML編集画面へ遷移.
	 *
	 * @click_url(area_view)
	 */
	public function moveAreaEdit($areaId) {

		$areaTable = TableRegistry::get('Areas');
		$area = $areaTable->findByIdAndDelFlg($areaId);

		if (empty($area)) {
			$this->redirect(array('controller'=> 'items', 'action'=> 'area'));
			return;
		}

		$this->request->data['Areas'] = $area;
		$this->set('area', $area);

		parent::move(ClickUrl::$AREA_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::AREA_EDIT_PAGE);
	}

	/**
	 * 市区町村HTML編集処理.
	 *
	 * @click_url(pref_view)
	 */
	public function areaHtmlEdit() {
		if (!isset($this->request->data['update'])) {
			$this->redirect(array('controller'=> 'items', 'action'=> 'area'));
			return;
		}

		$areaTable = TableRegistry::get('Areas');

		$area = $areaTable->get($this->request->getData('Areas.area_id'));
		$areaTable->patchEntity($area, $this->request->getData());

		if (!$area->getErrors()) {
			$saveArea = $areaTable->save($area);

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'items', 'action'=> 'moveAreaEdit', $saveArea['area_id']));
			return;
		}

		$this->set('area', $area);
		$this->setAction('moveAreaEdit');
		return ;
	}

	/**
	 * 駅一覧画面へ遷移します.
	 *
	 * @click_url(station_view)
	 */
	public function station() {

		parent::move(ClickUrl::$STATION_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::STATION_PAGE);
	}

	/**
	 * 駅検索処理を実施します.
	 *
	 * @click_url(station_view)
	 */
	public function stationSearch() {
		if (!empty($this->request->data['pref'])) {
			$stationTable= TableRegistry::get('Stations');
			$stations = $stationTable->findByPref($this->request->data['pref']);

			$this->set('stations', $stations);
		} else {
			$this->Flash->set('都道府県を選択して下さい。');
		}
		$this->setAction('station');
	}

	/**
	 * 駅HTML編集画面へ遷移.
	 *
	 * @click_url(station_view)
	 */
	public function moveStationEdit($stationCd) {

		$stationTable = TableRegistry::get('Stations');
		$station = $stationTable->get($stationCd);

		if (empty($station)) {
			$this->redirect(array('controller'=> 'items', 'action'=> 'station'));
			return;
		}

		$this->request->data['Stations'] = $station;
		$this->set('station', $station);

		parent::move(ClickUrl::$STATION_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::STATION_EDIT_PAGE);
	}

	/**
	 * 駅HTML編集処理.
	 *
	 * @click_url(station_view)
	 */
	public function stationHtmlEdit() {
		if (!isset($this->request->data['update'])) {
			$this->redirect(array('controller'=> 'items', 'action'=> 'station'));
			return;
		}

		$stationTable = TableRegistry::get('Stations');

		$station = $stationTable->get($this->request->getData('Stations.station_cd'));
		$stationTable->patchEntity($station, $this->request->getData());

		if (!$station->getErrors()) {
			$saveStation = $stationTable->save($station);

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'items', 'action'=> 'moveStationEdit', $saveStation['station_cd']));
			return;
		}

		$this->set('station', $station);
		$this->setAction('moveStationEdit');
		return ;
	}

	/**
	 * 脱毛部位一覧画面へ遷移します.
	 *
	 * @click_url(depilation_site_view)
	 */
	public function depilationSite() {

		$dsTable= TableRegistry::get('depilation_sites');
		$depilationSites = $dsTable->find('all');

		$this->set('depilationSites', $depilationSites);

		parent::move(ClickUrl::$DEPILATION_SITE_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::DEPILATIONSITE_PAGE);
	}

	/**
	 * 脱毛部位編集処理.
	 *
	 * @click_url(depilation_site_view)
	 */
	public function depilationSiteEdit() {
		$dsTable= TableRegistry::get('depilation_sites');

		$depilationSites = $this->request->data['DepilationSites'];

		$errorWords = [];
		foreach ($depilationSites as $id => $depilationSite) {

			// 同じURLテキストチェック
			if ($this->check_same_url_text($depilationSite['url_text'], self::DEPILATIONSITE)) {
				array_push($errorWords, $depilationSite['url_text']);
				unset($depilationSite['url_text']);
			}

			$depilationSite['depilation_site_id'] = $id;

			$data = $dsTable->get($id);
			$dsTable->patchEntity($data, $depilationSite);

			$dsTable->save($data);
		}

		$errorWord = implode('/', $errorWords);
		if (!empty($errorWord)) {
			$this->Flash->set("既に使われています　". $errorWord);
		}

		$this->Flash->set(Messages::UPDATE);
		$this->depilationSite();
	}

	/**
	 * 支払方法一覧画面へ遷移します.
	 *
	 * @click_url(payment_view)
	 */
	public function payment() {

		$paymentTable= TableRegistry::get('payments');
		$payments = $paymentTable->find('all');

		$this->set('payments', $payments);

		parent::move(ClickUrl::$PAYMENT_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::PAYMENT_PAGE);
	}

	/**
	 * 支払方法編集処理.
	 *
	 * @click_url(payment_view)
	 */
	public function paymentEdit() {
		$paymentTable= TableRegistry::get('payments');

		$payments = $this->request->data['Payments'];

		$errorWords = [];
		foreach ($payments as $id => $payment) {

			// 同じURLテキストチェック
			if ($this->check_same_url_text($payment['url_text'], self::PAYMENT)) {
				array_push($errorWords, $payment['url_text']);
				unset($payment['url_text']);
			}

			$payment['payment_id'] = $id;

			$data = $paymentTable->get($id);
			$paymentTable->patchEntity($data, $payment);

			$paymentTable->save($data);
		}

		$errorWord = implode('/', $errorWords);
		if (!empty($errorWord)) {
			$this->Flash->set("既に使われています　". $errorWord);
		}

		$this->Flash->set(Messages::UPDATE);
		$this->payment();
	}

	/**
	 * 特典・割引一覧画面へ遷移します.
	 *
	 * @click_url(discount_view)
	 */
	public function discount() {

		$discountTable= TableRegistry::get('discounts');
		$discounts = $discountTable->find('all');

		$this->set('discounts', $discounts);

		parent::move(ClickUrl::$DISCOUNT_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::DISCOUNT_PAGE);
	}

	/**
	 * 特典・割引編集処理.
	 *
	 * @click_url(discount_view)
	 */
	public function discountEdit() {
		$discountTable= TableRegistry::get('discounts');

		$discounts = $this->request->data['Discounts'];

		$errorWords = [];
		foreach ($discounts as $id => $discount) {

			// 同じURLテキストチェック
			if ($this->check_same_url_text($discount['url_text'], self::DISCOUNT)) {
				array_push($errorWords, $discount['url_text']);
				unset($discount['url_text']);
			}

			$discount['discount_id'] = $id;

			$data = $discountTable->get($id);
			$discountTable->patchEntity($data, $discount);

			$discountTable->save($data);
		}

		$errorWord = implode('/', $errorWords);
		if (!empty($errorWord)) {
			$this->Flash->set("既に使われています　". $errorWord);
		}

		$this->Flash->set(Messages::UPDATE);
		$this->discount();
	}

	/**
	 * その他こだわり条件一覧画面へ遷移します.
	 *
	 * @click_url(other_condition_view)
	 */
	public function otherCondition() {

		$ocTable= TableRegistry::get('otherConditions');
		$otherConditions = $ocTable->find('all');

		ConvertItems::convertObjectValue($otherConditions)
			->codeConverter(OtherConditionType::toString(), CodePattern::$VALUE, 'type');

		$this->set('otherConditions', $otherConditions);

		parent::move(ClickUrl::$OTHER_CONDITION_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::OTHER_CONDITIONS_PAGE);
	}

	/**
	 * その他こだわり条件編集処理.
	 *
	 * @click_url(other_condition_view)
	 */
	public function otherConditionEdit() {
		$ocTable= TableRegistry::get('otherConditions');

		$otherConditions = $this->request->data['OtherConditions'];

		$errorWords = [];
		foreach ($otherConditions as $id => $otherCondition) {

			// 同じURLテキストチェック
			if ($this->check_same_url_text($otherCondition['url_text'], self::OTHER_CONDITIONS)) {
				array_push($errorWords, $otherCondition['url_text']);
				unset($otherCondition['url_text']);
			}

			$otherCondition['other_conditions_id'] = $id;

			$data = $ocTable->get($id);
			$ocTable->patchEntity($data, $otherCondition);

			$ocTable->save($data);
		}

		$errorWord = implode('/', $errorWords);
		if (!empty($errorWord)) {
			$this->Flash->set("既に使われています　". $errorWord);
		}

		$this->Flash->set(Messages::UPDATE);
		$this->otherCondition();
	}

	/**
	 * 価格一覧画面へ遷移します.
	 *
	 * @click_url(price_view)
	 */
	public function price() {

		$priceTable= TableRegistry::get('prices');
		$prices = $priceTable->find('all');

		$this->set('prices', $prices);

		parent::move(ClickUrl::$PRICE_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::PRICE_PAGE);
	}

	/**
	 * 価格方法編集処理.
	 *
	 * @click_url(price_view)
	 */
	public function priceEdit() {
		$priceTable= TableRegistry::get('prices');

		$prices = $this->request->data['Prices'];

		$errorWords = [];
		foreach ($prices as $id => $price) {

			// 同じURLテキストチェック
			if ($this->check_same_url_text($price['url_text'], self::PRICE)) {
				array_push($errorWords, $price['url_text']);
				unset($price['url_text']);
			}

			$price['price_id'] = $id;

			$data = $priceTable->get($id);
			$priceTable->patchEntity($data, $price);

			$priceTable->save($data);
		}

		$errorWord = implode('/', $errorWords);
		if (!empty($errorWord)) {
			$this->Flash->set("既に使われています　". $errorWord);
		}

		$this->Flash->set(Messages::UPDATE);
		$this->price();
	}

	/**
	 * 脱毛部位,支払方法,特典・割引,その他こだわり条件,価格のHTML登録画面へ遷移.
	 *
	 * @click_url(price_view)
	 */
	public function moveHtmlEdit($page, $id) {

		switch ($page) {
			case self::DEPILATIONSITE:
				$clickUrl = ClickUrl::$DEPILATION_SITE_VIEW;
				$dsTable= TableRegistry::get('depilation_sites');
				$data = $dsTable->get($id);
				break;
			case self::PAYMENT:
				$clickUrl = ClickUrl::$PAYMENT_VIEW;
				$paymentTable= TableRegistry::get('payments');
				$data = $paymentTable->get($id);
				break;
			case self::DISCOUNT:
				$clickUrl = ClickUrl::$DISCOUNT_VIEW;
				$discountTable= TableRegistry::get('discounts');
				$data = $discountTable->get($id);
				break;
			case self::OTHER_CONDITIONS:
				$clickUrl = ClickUrl::$OTHER_CONDITION_VIEW;
				$ocTable= TableRegistry::get('other_conditions');
				$data = $ocTable->get($id);
				break;
			case self::PRICE:
				$clickUrl = ClickUrl::$PRICE_VIEW;
				$priceTable= TableRegistry::get('prices');
				$data = $priceTable->get($id);
				break;
			default:
				$this->redirect(['controller'=> 'tops', 'action'=> 'index']);
				return ;
		}

		$this->request->data['Items']['html'] = $data['html'];
		$this->request->data['Items']['id'] = $id;
		$this->request->data['Items']['page'] = $page;

		parent::move($clickUrl, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::HTML_EDIT_PAGE);
	}

	/**
	 * 脱毛部位,支払方法,特典・割引,その他こだわり条件,価格のHTML登録.
	 *
	 * @click_url(price_view)
	 */
	public function htmlEdit() {

		$items = $this->request->data['Items'];

		switch ($items['page']) {
			case self::DEPILATIONSITE:
				$table= TableRegistry::get('depilation_sites');
				$postData['depilation_site_id'] = $items['id'];
				break;
			case self::PAYMENT:
				$table= TableRegistry::get('payments');
				$postData['payment_id'] = $items['id'];
				break;
			case self::DISCOUNT:
				$table= TableRegistry::get('discounts');
				$postData['discount_id'] = $items['id'];
				break;
			case self::OTHER_CONDITIONS:
				$table= TableRegistry::get('other_conditions');
				$postData['other_condition_id'] = $items['id'];
				break;
			case self::PRICE:
				$table= TableRegistry::get('prices');
				$postData['price_id'] = $items['id'];
				break;
			default:
				$this->redirect(['controller'=> 'tops', 'action'=> 'index']);
				return ;
		}

		$postData['html'] = $items['html'];
		$data = $table->get($items['id']);

		$table->patchEntity($data, $postData);
		$table->save($data);
		$this->Flash->set(Messages::UPDATE);
		$this->redirect(['controller'=> 'items', 'action'=> 'moveHtmlEdit', $items['page'], $items['id']]);
		return ;
	}

	/**
	 * 画像一覧画面へ遷移します.
	 *
	 * @click_url(image_view)
	 */
	public function image() {

		$imgTable= TableRegistry::get('Images');
		$this->paginate = $imgTable->makeFindByDelFlgOrderById(50);
		$imageDatas = $this->paginate('Images');

		$this->set('imageDatas', $imageDatas);

		parent::move(ClickUrl::$IMAGE_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::IMAGE_PAGE);
	}

	/**
	 * 画像登録処理.
	 *
	 * @click_url(image_view)
	 */
	public function imgEdit() {

		$image = $this->request->data;

		if (!empty($image['Images']['image_file']['name']) && isset($image['regist'])) {

			$pathInfo = pathinfo($image['Images']['image_file']['name']);
			$extension = '.'.$pathInfo['extension'];

			$filePath = $this->Image->upload($image['Images']['image_file']['tmp_name'], $this->Image->getImageFolder(), true, $extension, null, true);

			$imgTable = TableRegistry::get('Images');
			$saveData = [];
			$saveData['image_path'] = $filePath;

			$saveData = $imgTable->newEntity($saveData);
			$imgTable->save($saveData);

			$this->Flash->set(Messages::REGIST);
			$this->redirect(array('controller'=> 'items', 'action'=> 'image'));
			return;

		}

		$this->Flash->set(Messages::INPUT_ERROR);
		$this->redirect(array('controller'=> 'items', 'action'=> 'image'));
		return;


	}

	/**
	 * 画像の取得.
	 *
	 * @click_url(exclude)
	 */
	public function imageView($imgId, $isMain = true) {
		$this->autoRender = false;

		if (!empty($imgId)) {
			$imgTable= TableRegistry::get('Images');
			$image = $imgTable->get($imgId);

			$path = $image->image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}

	/**
	 * 画像削除処理を実施します.
	 *
	 * @click_url(image_view)
	 */
	public function imgDelete($imgId = null) {
		if (!empty($imgId)) {
			$imgTable = TableRegistry::get('Images');

			$image = $imgTable->get($imgId);
			unlink($image['image_path']);

			$imgTable->deleteById($imgId);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(array('controller'=> 'items', 'action'=> 'image'));
	}

	/**
	 * 同じURLテキストかのチェック
	 *
	 * @click_url(exclude)
	 */
	private function check_same_url_text($urlText, $type) {

		if (!empty($urlText)) {

			$prefTable = TableRegistry::get('PrefDatas');
			$dsTable = TableRegistry::get('DepilationSites');
			$paymentTable = TableRegistry::get('Payments');
			$descountTable = TableRegistry::get('Discounts');
			$ocTable = TableRegistry::get('OtherConditions');
			$priceTable = TableRegistry::get('Prices');

			// 都道府県
			$pref = $prefTable->findByUrlText($urlText);
			if (!empty($pref) && $type != self::PREF) {
				return true;
			}

			// 脱毛部位
			$ds = $dsTable->findByUrlText($urlText);
			if (!empty($ds) && $type != self::DEPILATIONSITE) {
				return true;
			}

			// 支払方法
			$payment = $paymentTable->findByUrlText($urlText);
			if (!empty($payment) && $type != self::PAYMENT) {
				return true;
			}

			// 特典・割引
			$descount = $descountTable->findByUrlText($urlText);
			if (!empty($descount) && $type != self::DISCOUNT) {
				return true;
			}

			// その他こだわり条件
			$oc = $ocTable->findByUrlText($urlText);
			if (!empty($oc) && $type != self::OTHER_CONDITIONS) {
				return true;
			}

			// 価格
			$price = $priceTable->findByUrlText($urlText);
			if (!empty($price) && $type != self::PRICE) {
				return true;
			}
		}

		return false;
	}
}