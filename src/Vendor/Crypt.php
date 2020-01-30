<?php
namespace App\Vendor;

use Cake\Utility\Security;
use Cake\Core\Configure;
use Cake\Core\Exception\Exception;

class Crypt {

	const ENCRYPT = "encrypt";
	const DECRYPT = "decrypt";

	const CRYPT_TYPE = "sha512";
	const STRECH_COUNT = 1000;

	const ENCRYPT_KEY = "jTW9MwQlRyXmyCgY";

	/**
	 * *********************************************
	 * セキュリティー鍵名 FROM
	 * *********************************************
	 */

	// 管理画面セッション番号暗号化キー名.
	const SESSION_NO_KEY_NAME = "Security.session_id_key";
	// 管理画面ログインID暗号化キー名.
	const SYSTEM_LOGIN_ID_KEY_NAME = "Security.system_login_id_key";
	// 管理画面ログインPASS暗号化キー名.
	const SYSTEM_LOGIN_PASS_KEY_NAME = "Security.system_login_pass_key";


	// 会員画面セッション番号暗号化キー名
	const USER_SESSION_NO_KEY_NAME = "Security.user_session_id_key";
	// 会員ログインID暗号化キー名.
	const USER_ID_KEY_NAME = "Security.user_id_key";
	// 会員ログインID暗号化キー名.
	const USER_LOGIN_ID_KEY_NAME = "Security.user_login_id_key";
	// 会員ログインPASS暗号化キー名.
	const USER_LOGIN_PASS_KEY_NAME = "Security.user_login_pass_key";

	// 一覧プロ―フィール画像暗号化キー名.
	const FRONT_IMAGE_URL_KEY = "Security.front_image_url_key";

	// API KEY暗号化キー名.
	const API_KEY_KEY_NAME = "Security.api_key_key";
	// API Secret暗号化キー名.
	const API_SECRET_KEY_NAME = "Security.api_secret_key";

	/**
	 * *********************************************
	 * セキュリティー鍵名 TO
	 * *********************************************
	 */

	/**
	 * 暗号化処理.
	 *
	 * @param string $value 暗号化対象の文字列
	 * @param string $encryptKey 暗号化の際に使用するランダムな文字列のキー名
	 * @param boolean trueの場合はivを付加する  それ以外はivを付加しない
	 * @return string
	 */
	public static function encrypt($value, $encryptKey, $isIv = true) {
		return base64_encode(Security::encrypt($value, Configure::read($encryptKey), null, $isIv));
	}

	/**
	 * 複合化処理.
	 *
	 * @param string $value 複合化対象の文字列
	 * @param string $encryptKey 複合化の際に使用するランダムな文字列のキー名
	 * @param boolean $static trueの場合はivを不可しな、それ以外はivを付加しない複合化
	 * @return string
	 */
	public static function decrypt($value, $decryptKey) {
		return Security::decrypt(base64_decode($value), Configure::read($decryptKey));
	}

	/**
	 * 引数に指定された値を暗号化し、且つURLに不可できる形に変換する
	 */
	public static function encryptBin2hex($value, $encrytpKey, $static = false) {
		$value = self::encrypt($value, $encrytpKey, $static);
		return bin2hex($value);
	}

	/**
	 * encryptBin2hexで変換された値を元に戻す
	 */
	public static function decryptHex2bin($value, $encrytpKey, $static = false) {
		$value = hex2bin($value);
		return self::decrypt($value, $encrytpKey, $static);
	}

	/**
	 * ハッシュ化処理を実施します.
	 *
	 * @param ハッシュ化対象の文字列 $value
	 * @return string
	 */
	public static function hash($value) {
		if (mb_strlen($value) < 2) {
			throw  new Exception();
		}
		$id = mb_substr($value, 0, 2);
		$salt = $id.Configure::read('Security.salt');
		return Security::hash($value, self::CRYPT_TYPE, $salt);
	}

	public static function mc_decrypt($sStr) {
		$sKey = self::ENCRYPT_KEY;
		$sStr = str_replace(" ","+",$sStr);
		$sStr = str_replace("-","+",$sStr);
		$decrypted = mcrypt_decrypt(
				MCRYPT_RIJNDAEL_128,
				$sKey,
				base64_decode($sStr),
				MCRYPT_MODE_ECB
		);
		$dec_s = strlen($decrypted);
		$padding = ord($decrypted[$dec_s-1]);
		$decrypted = substr($decrypted, 0, -$padding);
		return $decrypted;
	}
}
?>