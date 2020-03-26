<?php
namespace App\Controller\Admin;

use Cake\ORM\TableRegistry;
use App\Controller\Admin\AdminAppController;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use App\Vendor\Messages;
use App\Vendor\Crypt;
use App\Vendor\Util;

class AdministratorsController extends AdminAppController {

	const INDEX_PAGE = 'index';
	const EDIT_PAGE = 'edit';

	/**
	 * 管理ユーザ一覧画面へ遷移します.
	 *
	 * @click_url(administrator_view)
	 */
	public function index() {
		$this->AdministratorDatas = TableRegistry::get('AdministratorDatas');
		$administratorDatas = $this->AdministratorDatas->findByDelFlgOrderById();
		$this->set('administratorDatas', $administratorDatas);

		parent::move(ClickUrl::$ADMINISTRATOR_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * 管理ユーザ登録画面へ遷移します.
	 *
	 * @click_url(administrator_view)
	 */
	public function moveRegist() {
		parent::move(ClickUrl::$ADMINISTRATOR_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
	}

	/**
	 * 管理ユーザ編集画面へ遷移します.
	 *
	 * @click_url(administrator_reg)
	 */
	public function moveEdit($administratorId = null) {
		if (!empty($administratorId)) {
			$this->AdministratorDatas = TableRegistry::get('AdministratorDatas');
			$administratorData = $this->AdministratorDatas->findByIdAndDelFlg($administratorId);
			if (!empty($administratorData)) {
				$administratorData->decryptId(Crypt::SYSTEM_LOGIN_ID_KEY_NAME);
				$this->request->data['AdministratorDatas'] = $administratorData;
				$this->request->data['AdministratorDatas']['login_pass'] = '';
			}
		}
		parent::move(ClickUrl::$ADMINISTRATOR_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
	}

	/**
	 * 管理ユーザ登録処理を実施します.
	 *
	 * @click_url(administrator_reg)
	 */
	public function edit() {
		$isNewAdministrator = false;
		$this->AdministratorDatas = TableRegistry::get('AdministratorDatas');
		if (isset ( $this->request->data['regist'])) {
			// 新規登録なので識別子を削除
			$isNewAdministrator = true;
			$administratorDatas = $this->AdministratorDatas->newEntity($this->request->getData());
		} else if (isset($this->request->data['update'])) {
			// 更新
			$administratorData = $this->AdministratorDatas->get($this->request->getData()['AdministratorDatas']['administrator_id']);
			$administratorDatas = $this->AdministratorDatas->patchEntity($administratorData, $this->request->getData());
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('admin_move_regist');
			return;
		}

		if (!$administratorDatas->errors() && $this->isDupulicateLoginId($administratorDatas)) {
			$saveAdministratorData = $this->AdministratorDatas->save($administratorDatas, false);

			if ($isNewAdministrator) {
				// 新規ユーザの場合はメニューを登録
				$loginsController = new LoginsController();
				$loginsController->regist_menu($saveAdministratorData->administrator_id);
			}

			if (isset($this->request->data['regist'])) {
				$this->Flash->set(Messages::REGIST);
			} else {
				$this->Flash->set(Messages::UPDATE);
			}
			return $this->redirect(array('controller'=> 'administrators', 'action'=> 'index'));
		}
		// $this->set('administratorDatas', $administratorDatas);
		$this->setAction('moveRegist');
	}

	/**
	 * ログインIDの重複チェック.
	 *
	 * @param AccountData $accountData
	 *        	サブミットされてきた入力値
	 */
	private function isDupulicateLoginId($administratorDatas) {
		$datas = $this->AdministratorDatas->findByDelFlgOrderById();
		if (!empty($datas) || !isset($administratorDatas->login_id) || empty($administratorDatas->login_id)) {
			foreach ($datas as $data) {
				$data->decryptId(Crypt::SYSTEM_LOGIN_ID_KEY_NAME);

				if ($data->login_id == $administratorDatas->login_id && $administratorDatas->administrator_id != $data->administrator_id) {
					// 重複している場合
					$this->Flash->set(Messages::DUPULICATE_LOGIN_ID);
					return false;
				}
			}
		}
		return true;
	}

	/**
	 * 削除処理を実施します.
	 *
	 * @click_url(administrator_view)
	 */
	public function delete($administratorId = null) {
		if (!empty($administratorId)) {
			$this->AdministratorDatas = TableRegistry::get('AdministratorDatas');
			$this->AdministratorDatas->deleteById($administratorId);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(array('controller'=> 'administrators', 'action'=> 'index'));
	}
}