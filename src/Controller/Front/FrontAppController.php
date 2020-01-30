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
namespace App\Controller\Front;

use App\Controller\AppController;
use App\Vendor\Layout;
use App\Vendor\SiteInfo;
use Cake\Event\Event;
use Cake\Routing\Router;
use App\Vendor\Constants;

/**
 * Application Controller
 *
 * Add your application-wide methods in the class below, your controllers
 * will inherit them.
 *
 * @link https://book.cakephp.org/3.0/en/controllers.html#the-app-controller
 */
class FrontAppController extends AppController
{

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


        $this->loadComponent('RequestHandler');
        $this->loadComponent('Flash');
        $this->loadComponent('Image');

		// リファラー
        $this->set('refere', $this->referer());

        /*
         * Enable the following components for recommended CakePHP security settings.
         * see https://book.cakephp.org/3.0/en/controllers/components/security.html
         */
        //$this->loadComponent('Security');
        //$this->loadComponent('Csrf');
    }

    public function beforeFilter(Event $event) {
    	// 末尾スラッシュ　リダイレクト
    	if (isset($this->request->url) && empty($_GET)) {
    		$uri = $this->request->url;
    		if (!empty($uri) && substr($uri, -1) != '/') {
    			$this->redirect('/' . $uri . '/', 301);
    		}
    	}

    	parent::beforeFilter($event);
    }

    /**
     * .ctpファイルの呼び出し.
     *
     * @param string $pageName ページタイトル
     * @param string $layout レイアウトファイル名
     * @param string $render レンダー名
     */
    protected function move($siteInfo, $layout = null, $render = null, $replaceTitle = null) {
    	if ($layout == null) {
    		$this->viewBuilder()->setLayout(Layout::USER_LAYOUT);
    	} else {
    		$this->viewBuilder()->setLayout($layout);
    	}

    	$title = $siteInfo[SiteInfo::TITLE];
    	if (!empty($replaceTitle)) {
    		$title = sprintf($title, $replaceTitle);
    	}

    	$this->set('description_for_layout', $siteInfo[SiteInfo::DESCRIPTION]);
    	$this->set('h1_for_layout', $siteInfo[SiteInfo::H1]);
    	$this->set("title_for_layout", $title);
    	$this->set("keyword_for_layout", $siteInfo[SiteInfo::KEYWORD]);

    	if (!empty($render)) {
    		$this->render($render);
    	}

    }

    /**
     * Website構造データ作成
     */
    protected function structuredOrganization() {
    	$array = [
    			'@context'=> "http://schema.org",
    			'@type'=> "Organization",
    			'name'=> Constants::FRONT_TITLE,
    			'url'=> Router::url('/',true),
    			'logo'=> Router::url("/img/log.png", true),
//     			'sameAs'=> [
//     					"https://www.facebook.com/pages/LIG-inc/151284414928781",
//     					"https://twitter.com/LIG_J",
//     					"https://instagram.com/lig_j/"
//     			]

    	];

    	return $this->structuredJsonEncode($array);
    }

    /**
     * Product構造データ作成
     */
    protected function structuredProduct($data = null) {
    	$array = [
    			'@context'=> "http://schema.org",
    			'@type'=> "Product",
    			'url'=> $data['url'],
    			'name'=> $data['name'],
    			'description'=> $data['description'],
    			'releaseDate'=> $data['release_date'],
    	];

    	if (!empty($data['img_url'])) {
    		$array['image'] = [
    					'@type'=> 'ImageObject',
    					'url'=> $data['img_url']
    			];
    	}

    	if (!empty($data['rating_value'])) {
    		$array['review'] = [
    				'@type'=> 'Review',
    				'author'=> [
    						'@type'=> 'Thing',
    						'name'=> Constants::FRONT_TITLE
    				],
    				'reviewRating'=> [
    						'@type'=> 'Rating',
    						'ratingValue'=> number_format($data['rating_value'],1)
    				]

    		];
    	}

    	return $this->structuredJsonEncode($array);
    }

    /**
     * Website構造データ作成
     */
    protected function structuredLocalBusiness($data = null) {
    	$array = [
    			'@context'=> "http://schema.org",
    			'@type'=> "LocalBusiness",
    			'name'=> $data['name'],
    			'image'=> $data['image_url'],
    			'aggregateRating'=> [
    					'@type'=> "AggregateRating",
    					'ratingValue'=> $data['star'],
    					'ratingCount'=> $data['review_cnt'],
    			],

    	];

    	return $this->structuredJsonEncode($array);
    }

    /**
     * BreadcrumbList構造データ作成
     */
    protected function structuredBreadcrumbList($breads = [], $isSearchPage = true) {
    	$array = [
    			'@context'=> "http://schema.org",
    			'@type'=> "BreadcrumbList",
    			'itemListElement'=> [
    					[
    							'@type'=> 'ListItem',
    							'position'=> '1',
    							'item'=> [
    									'@id'=> Router::url('/',true),
    									'name'=> 'TOP'
    							]
    					],
// 	    				[
// 		    					'@type'=> 'ListItem',
// 		    					'position'=> '2',
// 		    					'item'=> [
// 		    							'@id'=> Router::url(['controller'=> 'searchs', 'action'=> 'search'],true). "/",
// 		    							'name'=> '全国の脱毛施設'
// 	    						]
//     					]
    			]
    	];

    	if ($isSearchPage) {
    		array_push($array['itemListElement'], [
		    					'@type'=> 'ListItem',
		    					'position'=> '2',
		    					'item'=> [
		    							'@id'=> Router::url(['controller'=> 'searchs', 'action'=> 'search'],true). "/",
		    							'name'=> '全国の脱毛施設'
	    						]
    					]);
    	}

    	if (!empty($breads)) {
	    	foreach ($breads as $bread) {
	    		array_push($array['itemListElement'], $bread);
	    	}
    	}

    	return $this->structuredJsonEncode($array);
    }

    /**
     * 構造データ用json_encode
     */
    protected function structuredJsonEncode($array = []) {

		return json_encode($array, JSON_PRETTY_PRINT|JSON_UNESCAPED_UNICODE|JSON_UNESCAPED_SLASHES);
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
