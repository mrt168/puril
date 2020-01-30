<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use Cake\Event\Event;
use Cake\ORM\TableRegistry;
use App\Vendor\Constants;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use App\Vendor\ValidationUtil;
use App\Vendor\Crypt;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShowFlg;
use App\Vendor\Code\Pref;
use App\Vendor\Code\OtherConditionType;

class LoginsController extends AdminAppController {

	const INDEX_PAGE = 'index';

	public function initialize() {
		parent::initialize();

		$this->MenuParent = TableRegistry::get('MenuParents');
		$this->MenuParentOrder = TableRegistry::get('MenuParentOrders');
		$this->MenuChildren = TableRegistry::get('MenuChildrens');
		$this->MenuChildOrder = TableRegistry::get('MenuChildOrders');
	}

	/**
	 * ログイン後の処理は外したいのでinitBeforeFilterだけ呼び出して必要な処理のみ実施.
	 *
	 * @see AdminAppController::beforeFilter()
	 */
	function beforeFilter(Event $event) {
		parent::initBeforeFilter();
	}

	public function index() {
		if (parent::isLogin()) {
			// ログイン後ページへ遷移
			parent::moveTop();
			return;
		}

		parent::move(ClickUrl::$LOGIN, Layout::ADMIN_BEFORE_LOGIN_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * ログイン処理を実施します.
	 */
	public function login() {
		if (parent::isLogin()) {
			// ログイン後ページへ遷移
			parent::moveTop();
			return;
		}

		if (!isset($this->request->data['AdministratorData']['login_id']) || ! isset($this->request->data['AdministratorData']['login_pass']) || empty($this->request->data['AdministratorData']['login_id']) || empty($this->request->data['AdministratorData']['login_pass'])) {

			$this->Flash->set('ログインID又は、パスワードを入力して下さい。');
			$this->setAction('index');
			return;
		}
		$loginId = $this->request->data['AdministratorData']['login_id'];
		$loginPass = $this->request->data['AdministratorData']['login_pass'];
		if (ValidationUtil::SYSTEM_USER_LOGIN_ID_MIN_LEN <= mb_strlen($loginId) && ValidationUtil::SYSTEM_USER_LOGIN_PASS_MIN_LEN <= mb_strlen($loginPass)) {

			// ユーザ検索
			$administratorData = $this->AdministratorData->findByLoginIdAndPass($loginId, $loginPass, Crypt::SYSTEM_LOGIN_ID_KEY_NAME);
			if (!empty($administratorData)) {
				// ログイン状態Sessionを更新
				$sessionNo = parent::makeSessionNo();
				$administratorDataSession = $this->AdministratorDataSession->newEntity();
				$administratorDataSession->id = $sessionNo;
				$administratorDataSession->limit_time = strtotime(Constants::SESSION_VALID_MINUTE . ' minute '. date('Y-m-d H:i:s'));
				$administratorDataSession->administrator_id = $administratorData->administrator_id;

				// session番号を更新
				$this->AdministratorDataSession->save($administratorDataSession);

				// session番号を保持
				parent::setSessionNo($sessionNo);

				parent::moveTop();
				return;
			}
		}
		$this->Flash->set('ログインID又は、パスワードが間違っています。');
		$this->setAction('index');
	}

	/**
	 * **********************************************
	 *
	 * ここから下は初期データ登録用
	 *
	 * **********************************************
	 */

	/**
	 * 管理者の作成とメニューの登録処理を実施.
	 */
	public function init() {
		$loginId = 'admin';
		$loginPass = 'password';
		$name = 'administrator';

		// 管理者の存在チェック
		$administratorData = $this->AdministratorData->findByLoginIdAndPass($loginId, $loginPass, Crypt::SYSTEM_LOGIN_ID_KEY_NAME);
		if (empty($administratorData)) {
			// まず管理者作成
			$administratorData = $this->AdministratorData->newEntity();
			$administratorData->login_id = $loginId;
			$administratorData->login_pass = $loginPass;
			$administratorData->name = $name;

			$administratorData = $this->AdministratorData->save($administratorData);
			$administratorId = $administratorData->administrator_id;
		} else {
			$administratorId = $administratorData->administrator_id;
		}

		$this->regist_menu($administratorId);

		echo '登録完了';
		exit;
	}

	/**
	 * メニュー登録処理を実施.
	 */
	public function regist_menu($administratorId) {
		// メニュー登録
		$menus = $this->getDefMenu();
		$parentOrder = 1;
		foreach ($menus as $parent) {
			// 親メニュー名の存在チェック
			$menuParent = $this->MenuParent->findByMenuName($parent['category']);
			if (empty($menuParent)) {
				$menuParent = $this->MenuParent->newEntity();
				$menuParent->menu_name = $parent['category'];

				$saveMenuParent = $this->MenuParent->save($menuParent);

				$menuParentId = $saveMenuParent->menu_parent_id;
			} else {
				$menuParentId = $menuParent->menu_parent_id;
			}

			// 指定の管理者の親メニュー順が登録されているかチェック
			$menuParentOrder = $this->MenuParentOrder->findByMenuParentIdAndAdministratorId($menuParentId, $administratorId);
			if (empty($menuParentOrder)) {
				$menuParentOrder = $this->MenuParentOrder->newEntity();
				$menuParentOrder->menu_parent_id = $menuParentId;
				$menuParentOrder->administrator_id = $administratorId;
				$menuParentOrder->order_no = $parentOrder;
				$menuParentOrder->show_flg = ShowFlg::$SHOW[CodePattern::$CODE];

				$this->MenuParentOrder->save($menuParentOrder);
			} else {
				$menuParentOrder = $this->MenuParentOrder->get($menuParentOrder->parent_order_id);
				$menuParentOrder->order_no = $parentOrder;
				$this->MenuParentOrder->save($menuParentOrder);
			}
			$parentOrder ++;

			$childOrder = 1;
			foreach ($parent['childs'] as $child) {
				// 子メニューが登録されているかチェック
				$menuChildren = $this->MenuChildren->findByParentIdAndMenuName($menuParentId, $child['name']);
				if (empty($menuChildren)) {
					$menuChildren = $this->MenuChildren->newEntity();
					$menuChildren->menu_parent_id = $menuParentId;
					$menuChildren->menu_name = $child['name'];
					$menuChildren->controller_name = $child['controller'];
					$menuChildren->action_name = $child['action'];
					$menuChildren->click_url = $child['click_url'];

					$saveMenuChildren = $this->MenuChildren->save($menuChildren);

					$menuChildId = $saveMenuChildren->menu_child_id;
				} else {
					$menuChildId = $menuChildren->menu_child_id;
				}

				$menuChildOrder = $this->MenuChildOrder->findByMenuChildIdAndAdministratorId($menuChildId, $administratorId);
				if (empty($menuChildOrder)) {
					$menuChildOrder = $this->MenuChildOrder->newEntity();
					$menuChildOrder->menu_child_id = $menuChildId;
					$menuChildOrder->administrator_id = $administratorId;
					$menuChildOrder->order_no = $childOrder;
					$menuChildOrder->show_flg = ShowFlg::$SHOW[CodePattern::$CODE];

					$this->MenuChildOrder->save($menuChildOrder);
				} else {
					$menuChildOrder = $this->MenuChildOrder->get($menuChildOrder->child_order_id);
					$menuChildOrder->order_no = $childOrder;
					$this->MenuChildOrder->save($menuChildOrder);
				}
				$childOrder ++;
			}
		}
	}

	/**
	 * メニュー情報を取得します.
	 */
	private function getDefMenu() {
		$i = 0;
		return array (
				$i++ => array (
						'category'=> '店舗管理',
						'childs'=> array(
								array(
										'name'=> ClickUrl::$SHOP_VIEW[CodePattern::$VALUE],
										'controller'=> 'shops',
										'action'=> 'index',
										'click_url'=> ClickUrl::$SHOP_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$SHOP_REG[CodePattern::$VALUE],
										'controller'=> 'shops',
										'action'=> 'move_regist',
										'click_url'=> ClickUrl::$SHOP_REG[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$SHOP_CSV[CodePattern::$VALUE],
										'controller'=> 'shops',
										'action'=> 'move_csv',
										'click_url'=> ClickUrl::$SHOP_CSV[CodePattern::$CODE]
								)
						)
				),
				$i++ => array (
						'category'=> 'ブランド管理',
						'childs'=> array(
								array(
										'name'=> ClickUrl::$BRAND_VIEW[CodePattern::$VALUE],
										'controller'=> 'brands',
										'action'=> 'index',
										'click_url'=> ClickUrl::$BRAND_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$BRAND_REG[CodePattern::$VALUE],
										'controller'=> 'brands',
										'action'=> 'move_regist',
										'click_url'=> ClickUrl::$BRAND_REG[CodePattern::$CODE]
								)
						)
				),
				$i++ => array (
						'category'=> '口コミ管理',
						'childs'=> array(
								array(
										'name'=> ClickUrl::$REVIEW_VIEW[CodePattern::$VALUE],
										'controller'=> 'reviews',
										'action'=> 'index',
										'click_url'=> ClickUrl::$REVIEW_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$REVIEW_REG[CodePattern::$VALUE],
										'controller'=> 'reviews',
										'action'=> 'move_regist',
										'click_url'=> ClickUrl::$REVIEW_REG[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$REVIEW_CSV[CodePattern::$VALUE],
										'controller'=> 'reviews',
										'action'=> 'move_csv',
										'click_url'=> ClickUrl::$REVIEW_CSV[CodePattern::$CODE]
								)
						)
				),
				$i++ => array (
						'category'=> '項目管理',
						'childs'=> array(
								array(
										'name'=> ClickUrl::$PREF_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'pref',
										'click_url'=> ClickUrl::$PREF_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$AREA_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'area',
										'click_url'=> ClickUrl::$AREA_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$STATION_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'station',
										'click_url'=> ClickUrl::$STATION_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$DEPILATION_SITE_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'depilation_site',
										'click_url'=> ClickUrl::$DEPILATION_SITE_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$PAYMENT_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'payment',
										'click_url'=> ClickUrl::$PAYMENT_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$DISCOUNT_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'discount',
										'click_url'=> ClickUrl::$DISCOUNT_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$OTHER_CONDITION_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'other_condition',
										'click_url'=> ClickUrl::$OTHER_CONDITION_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$PRICE_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'price',
										'click_url'=> ClickUrl::$PRICE_VIEW[CodePattern::$CODE]
								),
								array(
										'name'=> ClickUrl::$IMAGE_VIEW[CodePattern::$VALUE],
										'controller'=> 'items',
										'action'=> 'image',
										'click_url'=> ClickUrl::$IMAGE_VIEW[CodePattern::$CODE]
								),
						)
				),
				$i++ => array (
						'category'=> '設定',
						'childs'=> array(
								array(
										'name'=> ClickUrl::$ADMINISTRATOR_VIEW[CodePattern::$VALUE],
										'controller'=> 'administrators',
										'action'=> 'index',
										'click_url'=> ClickUrl::$ADMINISTRATOR_VIEW[CodePattern::$CODE]
								),
								array (
										'name'=> ClickUrl::$ADMINISTRATOR_REG[CodePattern::$VALUE],
										'controller'=> 'administrators',
										'action'=> 'move_regist',
										'click_url'=> ClickUrl::$ADMINISTRATOR_REG[CodePattern::$CODE]
								),
								array (
										'name'=> ClickUrl::$MENU[CodePattern::$VALUE],
										'controller'=> 'menus',
										'action'=> 'index',
										'click_url'=> ClickUrl::$MENU[CodePattern::$CODE]
								)
						)
				)
		);
	}

	/**
	 * 店舗カテゴリーの登録処理
	 * 脱毛部位/支払方法/特典・割引/その他こだわり条件
	 */
	public function registCategory() {

		// 脱毛部位
		$depilationSites = [
				"全身",
				"顔",
				"おでこ",
				"眉毛",
				"うなじ・襟足",
				"鼻",
				"鼻毛",
				"もみあげ",
				"あご・ひげ",
				"ワキ",
				"胸",
				"乳首・乳輪",
				"腕",
				"手・指",
				"背中",
				"お腹",
				"VIO",
				"Vライン",
				"Iライン",
				"Oライン",
				"お尻",
				"足・ひざ下",
		];

		// 支払方法
		$payments = [
				"現金可",
				"カード払い可",
				"月額プランあり",
				"分割払い可",
				"都度払い可",
		];

		// 特典・割引
		$discounts = [
				"初回割引キャンペーンあり",
				"友達紹介割引キャンペーンあり",
				"学生割引キャンペーンあり",
				"乗り換え割引キャンペーンあり",
				"WEB特典キャンペーンあり",
		];

		// その他こだわり条件
		$otherConditions = [
				// 脱毛タイプ
				OtherConditionType::$DEPILATION[CodePattern::$CODE] => [
						"メンズ脱毛",
						"ブラジリアンンワックス",
						"SSC脱毛",
						"IPL脱毛",
						"SHR脱毛",
						"THR脱毛",
						"ハイパースキン脱毛",
						"レーザー脱毛",
						"ダイオードレーザー脱毛",
						"アレキサンドライト脱毛",
						"ヤグ（YAG）レーザー脱毛",
						"ニードル脱毛",
						"電気脱毛",
						"ベクタス脱毛",
						"ソプラノ脱毛",
						"永久脱毛"
				],

				// 診療科
				OtherConditionType::$DEPARTMENT[CodePattern::$CODE]=> [
						"皮膚科",
						"美容皮膚科",
						"美容外科"
				],

				// サポート体制
				OtherConditionType::$SUPPORT[CodePattern::$CODE] => [
						"アフターケアつき",
						"ドクターサポートあり",
						"女性スタッフ在籍",
						"男性スタッフ在籍",
						"女性専用",
						"未成年OK",
						"ブライダルメニューあり"
				],

				// 予約・受付・キャンセル
				OtherConditionType::$RECEPTIONIST[CodePattern::$CODE] => [
						"年中無休",
						"完全予約制",
						"当日受付OK",
						"朝10時前でもOK",
						"20時以降OK",
						"店舗移動可",
						"返金保証",
						"キャンセル料なし",
						"解約時返金"
				],

				// 立地・施設
				OtherConditionType::$LOCATION[CodePattern::$CODE] => [
						"駅チカ",
						"駐車場あり",
						"個室あり",
						"着替えあり",
						"メイクルームあり",
						"病院"
				]
		];

		// 価格
		$prices = [
				"安い・低価格",
				"高級",
				"通い放題・回数無制限",
				"1回お試し体験OK",
		];

		$depilationSiteTable = TableRegistry::get('DepilationSites');
		$paymentSiteTable = TableRegistry::get('Payments');
		$discountSiteTable = TableRegistry::get('Discounts');
		$otherConditionSiteTable = TableRegistry::get('OtherConditions');
		$priceTable = TableRegistry::get('Prices');

		foreach ($depilationSites as $depilationSite) {
			$data = [];
			$data = $depilationSiteTable->findByName($depilationSite);
			if (empty($data)) {
				$data['name'] = $depilationSite;
				$data['search_text'] = $depilationSite;
				$data = $depilationSiteTable->newEntity($data);
				$depilationSiteTable->save($data);
			}
		}

		foreach ($payments as $payment) {
			$data = [];
			$data = $paymentSiteTable->findByName($payment);
			if (empty($data)) {
				$data['name'] = $payment;
				$data['search_text'] = $payment;
				$data = $paymentSiteTable->newEntity($data);
				$paymentSiteTable->save($data);
			}
		}

		foreach ($discounts as $discount) {
			$data = [];
			$data = $discountSiteTable->findByName($discount);
			if (empty($data)) {
				$data['name'] = $discount;
				$data['search_text'] = $discount;
				$data = $discountSiteTable->newEntity($data);
				$discountSiteTable->save($data);
			}
		}

		foreach ($otherConditions as $type => $otherCondition) {
			foreach ($otherCondition as $name) {
				$data = $otherConditionSiteTable->findByName($name);
				if (empty($data)) {
					$data['name'] = $name;
					$data['search_text'] = $name;
					$data['type'] = $type;
					$data = $otherConditionSiteTable->newEntity($data);
					$otherConditionSiteTable->save($data);
				}
			}
		}

		foreach ($prices as $price) {
			$data = [];
			$data = $priceTable->findByName($price);
			if (empty($data)) {
				$data['name'] = $price;
				$data['search_text'] = $price;
				$data = $priceTable->newEntity($data);
				$priceTable->save($data);
			}
		}

		echo "登録完了";
		exit;
	}

	/**
	 * 都道府県情報登録
	 */
	public function registPrefData() {
		$prefTable = TableRegistry::get('PrefDatas');

		$prefs = Pref::valueOf();
		foreach ($prefs as $pref) {

			$data = $prefTable->findByPref($pref['code']);
			if (empty($data) && $pref['code'] != Pref::$MISETTEI[CodePattern::$CODE]) {
				$prefData = [];
				$prefData['pref'] = $pref['code'];
				$prefData['search_text'] = $pref['value'];

				$prefData = $prefTable->newEntity($prefData);
				$prefTable->save($prefData);
 			}
		}

		echo "登録完了";
		exit;
	}
}