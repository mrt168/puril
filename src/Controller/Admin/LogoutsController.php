<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use App\Vendor\Constants;

/**
 * ログアウト管理.
 *
 * @author 2018/03/27 ACT K.MURAOKA
 */
class LogoutsController extends AdminAppController {

	const INDEX_PAGE = 'index';

	/**
	 * ログアウト処理を実施します.
	 *
	 * @click_url(exclude)
	 */
	public function index() {
		// セッションからIDを削除
		$this->Session->delete(Constants::SESSION_SYSTEM_USER);
		$this->Flash->set('ログアウトしました');

		// ﾛｸﾞｲﾝ画面へ遷移
		parent::moveNoLoginTop();
	}
}