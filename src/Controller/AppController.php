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
namespace App\Controller;

use Cake\Controller\Controller;
use Cake\Event\Event;
use Cake\Routing\Route\Route;
use Cake\Routing\Router;
use Cake\Log\Log;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class AppController extends Controller {

    /**
     * Initialization hook method.
     *
     * Use this method to add common initialization code like loading components.
     *
     * e.g. `$this->loadComponent('Security');`
     *
     * @return void
     */
    public function initialize() {
        parent::initialize();

        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Image');
        $this->loadComponent('Csv');
        $this->loadComponent('Mail');

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');

        $this->Session = $this->request->session();
    }

    public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);

        if ($this->request->is('get')) {
            Log::debug('【GET】 '.Router::url().' '.var_export($_GET, true));
        } else {
            Log::debug('【POST】 '.Router::url().' '.var_export($_POST, true));
        }
    }

    public function beforeRender(Event $event)
    {
        parent::beforeRender($event);

        // PC／スマホのview切り替え
        if ($this->request->isMobile()) {
            // plugins/Sp/Template内のviewが読み込まれる
            $this->viewBuilder()->theme('Sp');
        }
    }
}
