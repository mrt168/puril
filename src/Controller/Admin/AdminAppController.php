<?php
namespace App\Controller\Admin;

use App\Controller\AppController;
use Cake\Event\Event;
use Cake\Core\Configure;
use Cake\Routing\Router;
use Cake\Utility\Security;
use Cake\ORM\TableRegistry;
use Cake\Datasource\ConnectionManager;
use App\Vendor\Layout;
use App\Vendor\Constants;
use App\Vendor\Crypt;
use App\Vendor\Code\CodePattern;
use App\Vendor\AnnotationReader;
use App\Vendor\Util;
use Cake\Utility\Inflector;

class AdminAppController extends AppController {

    public function initialize() {
        parent::initialize();

    }

	function beforeFilter(Event $event) {
		parent::beforeFilter($event);

		$this->initBeforeFilter();
		if (!$this->isLogin()) {
 			// ﾛｸﾞｲﾝしていない場合
			$this->moveNoLoginTop();
			return;
		}

		// メニューの表示可能チェック
		$this->MenuParent = TableRegistry::get('MenuParents');
		$this->checkShowAbleMenu();
		$this->set('menuItems', $this->getMenu());
	}

    protected function initBeforeFilter() {
//     	$sslStatus = Configure::read(Constants::SSL_STATUS);
//     	if ($sslStatus === Constants::SSL_STATUS_ON) {
//     		$this->Cookie->secure = true;
//     	}

    	$this->AdministratorData = TableRegistry::get('AdministratorDatas');
    	$this->AdministratorDataSession = TableRegistry::get('AdministratorDataSessions');

    	$this->set('click_url', '');
		Security::setHash(Crypt::CRYPT_TYPE);

    	if ($this->request->is('get')) {
    		$this->log('【GET】Admin ' . Router::url() . ' ' . var_export($_GET, true), LOG_DEBUG);
    	} else {
    		$this->log('【POST】Admin ' . Router::url() . ' ' . var_export($_POST, true), LOG_DEBUG);
    	}
    }

    /**
     * ログイン前TOP画面へリダイレクト.
     */
    protected function moveNoLoginTop() {
    	$this->redirect('/' . Constants::ADMIN_ROOT_URL);
    }

    /**
     * ログイン後TOP画面へリダイレクト.
     */
    protected function moveTop() {
    	$this->redirect('/' . Constants::ADMIN_ROOT_URL."/tops/index");
//     	$this->redirect(array('controller'=> 'tops', 'action'=> 'index'	));
    }

    /**
     * ログインチェック.
     */
    protected function isLogin() {
    	if (!$this->Session->check(Constants::SESSION_SYSTEM_USER)) {
    		return false;
    	}
    	// Session番号からログイン者情報を取得します
    	$sessionNo = $this->getSessionNo(Constants::SESSION_SYSTEM_USER);
    	$administratorData = $this->AdministratorData->findBySessionId($sessionNo);
    	if (empty($administratorData)) {
    		return false;
    	}
    	$this->set('loginUser', $administratorData);
    	$this->loginUser = $administratorData;

    	$className = __NAMESPACE__. '\\'. $this->name . 'Controller';
    	$instance = new $className();
    	$ano = new AnnotationReader($instance);
    	$anoParam = $ano->getNoUpdateSession($this->request->action);
    	if (empty($anoParam) || $anoParam != 'true') {
    		$connection = ConnectionManager::get('default');
    		try {
    			// ログイン済み
    			$connection->begin();

    			// レコードをロック
    			$this->AdministratorDataSession->findByIdForUpdate($sessionNo);

    			// session番号を再生成
    			$newSessionNo = $this->makeSessionNo();
    			// session番号を更新
    			$this->AdministratorDataSession->updateById($sessionNo, $newSessionNo);
    			$this->setSessionNo($newSessionNo);

    			// 有効期限切れのsessionを削除
    			$this->AdministratorDataSession->deleteInValid();

    			Util::setLoginId($administratorData->administrator_id);

    			$connection->commit();
    		} catch (Exception $e) {
    			$connection->rollback();
    			throw $e;
    		}
    	}

    	return true;
    }

    /**
     * .ctpファイルの呼び出し.
     *
     * @param string $pageName
     *        	ページタイトル
     * @param string $layout
     *        	レイアウトファイル名
     * @param string $render
     *        	レンダー名
     */
    protected function move($clickUrl, $layout = null, $render = null) {
    	if ($layout == null) {
    		$this->viewBuilder()->setLayout(Layout::ADMIN_AFTER_LOGIN_LAYOUT);
    	} else {
    		$this->viewBuilder()->setLayout($layout);
    	}

    	$this->set('click_url', $clickUrl[CodePattern::$CODE]);
    	$this->set("title_for_layout", $clickUrl[CodePattern::$VALUE]);
    	if (! empty($render)) {
    		$this->render($render);
    	}
    }

    /**
     * 表示可能なメニューかチェック.
     */
    protected function checkShowAbleMenu() {
    	$className = __NAMESPACE__. '\\'. $this->name . 'Controller';
    	$instance = new $className();
    	$ano = new AnnotationReader($instance);
    	$clickUrl = $ano->getClickUrl($this->request->action);
    	if (empty($clickUrl)) {
    		$this->Flash->set('操作が許可されていません。');
    		$this->moveTop();
    	} else if ($clickUrl != 'exclude' && $clickUrl != 'ajax') {
    		// 検索
    		$boo = $this->MenuParent->isShowMenu(Util::getLoginId(), Inflector::camelize($this->name), $clickUrl);
    		if ($boo !== true) {
    			$this->Flash->set('操作が許可されていません。');
    			$this->moveTop();
    		}
    	}
    }

    /**
     * メニュー情報を取得します.
     */
    public function getMenu() {
    	// メニュー情報を取得します.
    	return $this->MenuParent->findShowMenu(Util::getLoginId());
    }

    /**
     * ログインsession用文字列生成.
     */
    protected function makeSessionNo() {
    	// ランダムな文字列を生成.
    	$str = md5(uniqid(rand(), true));
    	$str .= md5(uniqid(rand(), true));
    	// 重複チェック
    	$count = $this->AdministratorDataSession->findCountById($str);
    	if ($count != 0) {
    		$str = $this->makeSessionNo();
    	}
    	return $str;
    }

    /**
     * セッション番号を取得.
     */
    protected function getSessionNo() {
    	$encrypt = $this->getSession(Constants::SESSION_SYSTEM_USER);
    	return Crypt::decrypt($encrypt, Crypt::SESSION_NO_KEY_NAME);
    }

    /**
     * セッション番号をｾｯﾄ.
     */
    protected function setSessionNo($sessionNo) {
    	$this->setSession(Constants::SESSION_SYSTEM_USER, Crypt::encrypt($sessionNo, Crypt::SESSION_NO_KEY_NAME));
    }

    /**
     * セッションへの値格納.
     *
     * @param string $name セッション名
     * @param string or integer $value 値
     */
    protected function setSession($name, $value, $path = null) {
    	$this->Session->write($name, $value);
    }

    /**
     * セッションの値取得.
     *
     * @param string $name セッション名
     * @return 値
     */
    protected function getSession($name) {
    	return $this->Session->read($name);
    }

}
