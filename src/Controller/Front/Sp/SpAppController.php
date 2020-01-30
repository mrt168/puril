<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller\Front\Sp;

use App\Controller\Front\FrontAppController;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ResultStatus;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\Gender;
use App\Vendor\Convertor\ConvertItems;
use Cake\Routing\Router;
use App\Model\Entity\User;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class SpAppController extends FrontAppController
{

	/**
	 * @var User
	 */
	protected $loginUserData;

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize()
    {
        parent::initialize();
    }

    protected function output($data, $status, $errors = null) {

    	$result = array(
    			'status'=> $status[CodePattern::$CODE]
    		);
    	$result['data'] = $data;
    	if (!empty($errors)) {
    		if (is_array($errors)) {
	    		$message = "";
	    		foreach ($errors as $columnName=> $messes) {
	    			foreach ($messes as $mess) {
	    				$message .= "{$columnName}: {$mess}\n";
	    			}
	    		}
    		} else {
    			$message = $errors;
    		}
    		$result['message'] = $message;
    	}
    	echo json_encode($result);
    }

    protected function _check_user($sessionNumber, $userId) {
    	if (empty($sessionNumber) || empty($userId) || !is_numeric($userId)) {
    		$this->output(null, ResultStatus::$ERROR_2001, ResultStatus::$ERROR_2001[CodePattern::$CODE]);
    		return false;
    	}

    	$userTable = TableRegistry::get('Users');
    	$this->loginUserData = $userTable->get($userId);
    	if (empty($this->loginUserData) && $this->loginUserData->session_number != $sessionNumber) {
    		$this->output(null, ResultStatus::$ERROR_2002, ResultStatus::$ERROR_2002[CodePattern::$CODE]);
    		return false;
    	}
    	return true;
    }

    protected function _scanning_user($user, &$return) {
    	$created = new \DateTime();
    	$created->setTimestamp($user->created->toUnixString());
    	$created->setTimezone(new \DateTimeZone('UTC'));

    	$lastLoginTime = new \DateTime();
    	$lastLoginTime->setTimestamp($user->last_login_time->toUnixString());
    	$lastLoginTime->setTimezone(new \DateTimeZone('UTC'));

    	$return['user_id'] = $user->user_id;
    	$return['nickname'] = $user->nickname;
    	$return['created'] = $created->format('U').'000';
    	$return['last_login_time'] = $lastLoginTime->format('U').'000';
    	$return['message'] = empty($user->message) ? "" : $user->message;
    	$return['sex'] = $user->sex;
    	$return['thumbnail'] = Router::url('/thumb/', true).$this->Image->makeProfileImgURL($user->user_id);
    	$return['age'] = $user->age;

    	ConvertItems::convertValue($return)
    		->codeConverter(Gender::toString(), CodePattern::$VALUE, 'sex');

   		return $return;
    }
}
