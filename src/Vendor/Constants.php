<?php
namespace App\Vendor;

class Constants {
	const ADMIN_ROOT = "admin"; // 管理画面のルーティングプリフィクス
	const ADMIN_ROOT_URL = "adminVRqVgGOjswLrCLGe"; // 管理画面にアクセスする際のURL(URLを変えたい場合はここを変更)
	const ADMIN_VALIABLE_PATH = "admin"; // 管理画面のクッキー及び、セッションの有効パス

	const PC_ROOT = "pc";

	const ADMIN_SYSYTEM_NAME = 'Puril';
	const CONSUME_TITLE = 'Puril';
	const FRONT_TITLE = 'Puril';

	const DEVEROP_STR = 'development';
	const PRODUCT_STR = 'production';
	const PRODUCT_TEST_STR = 'product_test';
	const ACTION_STATUS = 'action_status';
	const SSL_STATUS = 'ssl_status';
	const SSL_STATUS_ON = true;
	const SSL_STATUS_OFF = false;

	// 未ﾛｸﾞｲﾝの場合のCREATE_USER値
	const NO_LOGIN_CREATE_USER = '0';

	// 自動ログインパラメーター有効期限
	// const AUTO_LOGIN_PARAM_LIMIT = 60 * 60 * 24 * 7; // 1週間
	const AUTO_LOGIN_PARAM_LIMIT = 604800; // 1週間
	const AUTO_RETURN_MINUTE_MIN = 3;
	const AUTO_RETURN_MINUTE_MAX = 10;

	const CURL_CONNECTION_TIMEOUT = 10;
	const MIN_VOLUME = 0.005;

	const USER_SESSION_NUMBER_LENGTH = 50;
	const USER_CRYPT_KEY_LENGTH = 16;

	const NOIMAGE_PATH = ROOT.DS.FileUtil::OUTSIDE_WEBROOT.DS."img".DS."prof".DS."noimage.png";

	/**
	 * *********************************************
	 * セッション保存名 FROM
	 * *********************************************
	 */
	const COOKIE_NAME_ADMIN = 'YYKJHGL3s07lZhp9';

	// session有効期限
	const SESSION_VALID_MINUTE = '5256000'; // 1日(単位:分)
	const SESSION_VALID_TIME = '315360000'; // 1日(単位:秒)

	// 会員画面Session有効期限
// 	const SESSION_VALID_MINUTE_USER = '1440'; // 1日(単位:分)
	const SESSION_VALID_MINUTE_USER = '5256000'; // 10年(単位:分)
	// 	const SESSION_VALID_TIME_USER = '86400'; // 1日(単位:秒)
	const SESSION_VALID_TIME_USER = '315360000'; // 10年(単位:秒)

	// 管理画面ログインユーザID保存Session名
	const SESSION_SYSTEM_USER = "EZ13jFVyEh8NQc94";

	// フロント画面ログインユーザID保存Session名
	const SESSION_USER = "wbt7T8hNMIJ0X2FD";

	/**
	 * *********************************************
	 * セッション保存名 TO
	 * *********************************************
	 */
}

?>