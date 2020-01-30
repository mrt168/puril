<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use Cake\ORM\TableRegistry;
use App\Vendor\Messages;

class MenusController extends AdminAppController {

	const INDEX_PAGE = 'index';

	/**
	 * ログイン後TOP画面へ遷移します.
	 *
	 * @click_url(menu)
	 */
	public function index() {

		parent::move(ClickUrl::$MENU, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * メニュー検索処理を実施します.
	 *
	 * @click_url(menu)
	 * @auth_type(menu)
	 */
	public function search() {
		if (!empty($this->request->data['administrator_id'])) {
			$this->MenuParent = TableRegistry::get('MenuParents');
			$menuParents = $this->MenuParent->findByAdministratorId($this->request->data['administrator_id']);

			$this->set('menuParents', $menuParents);
		} else {
			$this->Flash->set('管理者を選択して下さい。');
		}
		$this->setAction('index');
	}

	/**
	 * メニュー更新処理を実施します.
	 *
	 * @click_url(menu)
	 * @auth_type(menu)
	 */
	public function edit() {
		if (isset($this->request->data['edit']) && ! empty($this->request->data['administrator_id'])) {
			$administratorId = $this->request->data['administrator_id'];

			$this->MenuParentOrder = TableRegistry::get('MenuParentOrders');
			$this->MenuChildOrder = TableRegistry::get('MenuChildOrders');

			// 更新
			$menuParentOrders = $this->request->data['MenuParentOrders'];

			// まず親メニュー情報登録
			foreach ($menuParentOrders as $menuParentOrder) {
				$parentData = $this->MenuParentOrder->get($menuParentOrder['parent_order_id']);
				$this->MenuParentOrder->patchEntity($parentData, $menuParentOrder);

				$this->MenuParentOrder->save($parentData);

				// 子メニュー情報登録
				foreach ($menuParentOrder['MenuChildOrders'] as $menuChildOrder) {
					$childData = $this->MenuChildOrder->get($menuChildOrder['child_order_id']);
					$this->MenuChildOrder->patchEntity($childData, $menuChildOrder);

					$this->MenuChildOrder->save($childData);
				}
			}
			$this->set('menuItems', parent::getMenu());
			$this->Flash->set(Messages::UPDATE);
		}

		$this->setAction('search');
	}
}