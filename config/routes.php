<?php
/**
 * Routes configuration
 *
 * In this file, you set up routes to your controllers and their actions.
 * Routes are very important mechanism that allows you to freely connect
 * different URLs to chosen controllers and their actions (functions).
 *
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */

use Cake\Core\Plugin;
use Cake\Routing\RouteBuilder;
use Cake\Routing\Router;
use Cake\Routing\Route\DashedRoute;
use App\Vendor\Constants;
use App\Vendor\URLUtil;

Router::defaultRouteClass(DashedRoute::class);

Router::scope('/', function (RouteBuilder $routes) {
    /**
     * **********************************************
     * 管理画面用のルーティングプリフィクス
     * **********************************************
     */
    $routes->connect('/'. Constants::ADMIN_ROOT_URL, array(
        'controller' => 'logins',
        'action' => 'index',
        'prefix' => Constants::ADMIN_ROOT,
        Constants::ADMIN_ROOT=> true
    ));
    $routes->connect('/'. Constants::ADMIN_ROOT_URL. '/:controller/:action/*', array(
        'controller' => ':controller',
        'action' => 'action',
        'prefix' => Constants::ADMIN_ROOT,
        Constants::ADMIN_ROOT => true
    ));
    $routes->connect('/'. Constants::ADMIN_ROOT_URL. '/:controller/*', array(
        'controller' => ':controller',
        'prefix' => Constants::ADMIN_ROOT,
        Constants::ADMIN_ROOT => true
    ));

    /**
     * **********************************************
     * フロント用のルーティングプリフィクス
     * **********************************************
     */
     
     // Puril TOP
    $routes->connect('/', array(
        'controller' => 'puril',
        'action' => 'index',
        'prefix' => "front",
        "front" => true
    ));

    // TOP
    $routes->connect('/datsumou', array(
        'controller' => 'tops',
        'action' => 'index',
        'prefix' => "front",
        "front" => true
    ));

    // 検索
    $routes->connect('/datsumou/'. URLUtil::SEARCH, array(
        'controller' => 'searchs',
        'action' => 'index',
        'prefix' => "front",
    ));
    $routes->connect('/datsumou/'. URLUtil::SEARCH. '/*', array(
        'controller' => 'searchs',
        'action' => 'search',
        'prefix' => "front",
    ));

    // 店舗詳細
    $routes->connect('/datsumou/shop/detail/*/', array(
        'controller' => 'shops',
        'action' => 'detail',
        'prefix' => "front",
    ));
    // 口コミ投稿
    $routes->connect('/datsumou/shop/send/', array(
        'controller' => 'shops',
        'action' => 'send',
        'prefix' => "front",
    ));

    // 予約フォーム
    $routes->connect('/datsumou/shop/reserve/', array(
        'controller' => 'shops',
        'action' => 'reserve',
        'prefix' => "front",
    ));

    // ブログ一覧
    $routes->connect('/datsumou/shop/detail/:shop_id/blog/', array(
        'controller' => 'shops',
        'action' => 'blogIndex',
        'prefix' => "front",
    ), ['shop_id'=> '[0-9]+']);
    // ブログ詳細
    $routes->connect('/datsumou/shop/detail/:shop_id/blog/*', array(
        'controller' => 'shops',
        'action' => 'blogDetail',
        'prefix' => "front",
    ), ['shop_id'=> '[0-9]+', 'blog_id'=> '[0-9]+']);

    // ブランド一覧
    $routes->connect('/datsumou/brands', array(
        'controller' => 'brands',
        'action' => 'index',
        'prefix' => "front",
    ));
    // ブランド詳細
    $routes->connect('/datsumou/brands/*/', array(
        'controller' => 'brands',
        'action' => 'detail',
        'prefix' => "front",
    ));
    // 口コミ一覧
    $routes->connect('/datsumou/brands/:brand_id/kuchikomi/', array(
        'controller' => 'brands',
        'action' => 'reviewIndex',
        'prefix' => "front",
    ), ['brand_id'=> '[0-9]+']);

    // ランキング
    $routes->connect('/datsumou/'. URLUtil::RANKING, array(
        'controller' => 'rankings',
        'action' => 'index',
        'prefix' => "front",
    ));
    // ランキング検索
    $routes->connect('/datsumou/'. URLUtil::RANKING. '/*/', array(
        'controller' => 'rankings',
        'action' => 'search',
        'prefix' => "front",
    ));
    // ブランドランキング
    $routes->connect('/datsumou/'. URLUtil::RANKING. '/brand/', array(
        'controller' => 'rankings',
        'action' => 'brandRanking',
        'prefix' => "front",
    ));

    // プライバシーポリシー
    $routes->connect('/privacy-policy', array(
        'controller' => 'indexes',
        'action' => 'privacyPolicy',
        'prefix' => "front",
    ));
    // サイトマップ
    $routes->connect('/sitemap', array(
        'controller' => 'indexes',
        'action' => 'siteMap',
        'prefix' => "front",
    ));
    // 利用規約
    $routes->connect('/regulation', array(
        'controller' => 'indexes',
        'action' => 'terms',
        'prefix' => "front",
    ));

    // 問合せ
    $routes->connect('/form_facility', array(
        'controller' => 'contacts',
        'action' => 'contact',
        'prefix' => "front",
    ));
    // 問合せサンクスページ
    $routes->connect('/form_facility/thanks', array(
        'controller' => 'contacts',
        'action' => 'contactThanks',
        'prefix' => "front",
    ));
    // ユーザー問合せ
    $routes->connect('/form_user', array(
        'controller' => 'contacts',
        'action' => 'contact_user',
        'prefix' => "front",
    ));
    // ユーザー問合せサンクスページ
    $routes->connect('/form_user/thanks', array(
        'controller' => 'contacts',
        'action' => 'contactUserThanks',
        'prefix' => "front",
    ));


    // 店舗画像データ
    $routes->connect('/shop_img/*', array(
        'controller' => 'images',
        'action' => 'shopImage',
        'prefix' => "front",
    ));
    // ひとこと用店舗画像データ
    $routes->connect('/word_shop_img/*', array(
        'controller' => 'images',
        'action' => 'wordShopImage',
        'prefix' => "front",
    ));
    // スタッフ画像データ
    $routes->connect('/staff_img/*', array(
        'controller' => 'images',
        'action' => 'staffImage',
        'prefix' => "front",
    ));
    // インタビュー画像データ
    $routes->connect('/interview_shop_img/*', array(
        'controller' => 'images',
        'action' => 'interviewShopImage',
        'prefix' => "front",
    ));
    // インタビュー画像データ
    $routes->connect('/interview_img/*', array(
        'controller' => 'images',
        'action' => 'interviewImage',
        'prefix' => "front",
    ));
    // ブログ画像データ
    $routes->connect('/blog_img/*', array(
        'controller' => 'images',
        'action' => 'blogImage',
        'prefix' => "front",
    ));
    // 画像データ
    $routes->connect('/img/*', array(
        'controller' => 'images',
        'action' => 'image',
        'prefix' => "front",
    ));
    // ブランド画像データ
    $routes->connect('/brand_img/*', array(
        'controller' => 'images',
        'action' => 'brandImage',
        'prefix' => "front",
    ));

    // 検索
    $routes->connect('/searches/search_map/*', array(
        'controller' => 'searchs',
        'action' => 'searchMap',
        'prefix' => "front",
    ));


    // サイドバー取得
    $routes->connect('/getSidebar', array(
        'controller' => 'indexes',
        'action' => 'getSidebar',
        'prefix' => "front",
    ));

    $routes->connect('/:controller/:action', array(
        'controller' => ':controller',
        'action' => ':action',
        'prefix' => "front",
// 			"front" => true
    ));

    $routes->connect('/:controller/*', array(
        'controller' => ':controller',
        'prefix' => "front",
// 			"front" => true
    ));
});

Router::prefix(Constants::ADMIN_ROOT, array('path'=> "/". Constants::ADMIN_ROOT_URL), function($routes) {
    $routes->fallbacks('DashedRoute');
});

Router::prefix('front/sp', function($routes) {
    $routes->fallbacks('DashedRoute');
});

Plugin::routes();
