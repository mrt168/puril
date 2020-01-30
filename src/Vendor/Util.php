<?php
namespace App\Vendor;

class Util {

	private static $LOGIN_ID = null;
	private static $USER_DATA = null;

	public static function getLoginId() {
		return self::$LOGIN_ID;
	}
	public static function setLoginId($loginId) {
		self::$LOGIN_ID = $loginId;
	}

	/**
	 * HTMLを出力.
	 */
	public static function outputHTML($html) {
		$html = strip_tags($html);
		$html = htmlentities(html_entity_decode($html, ENT_QUOTES, 'UTF-8'), ENT_QUOTES, 'UTF-8');
		$html = str_replace(' ', '&nbsp;', $html);

		$html = html_entity_decode($html, ENT_QUOTES, 'UTF-8');
		return str_replace("\xc2\xa0"," ", $html);
	}
}
?>