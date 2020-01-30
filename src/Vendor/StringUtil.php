<?php
namespace App\Vendor;

class StringUtil {
	private static $CHAR = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789_';

	/**
	 * 引数に指定された引数でランダムな文字列を生成します
	 */
	public static function makeRandomStr($len = 30) {
		mt_srand ();
		$returnStr = "";
		$strlen = strlen ( self::$CHAR );
		for($i = 0; $i < $len; $i ++) {
			$returnStr .= self::$CHAR [mt_rand ( 0, $strlen - 1 )];
		}
		return $returnStr;
	}
	public static function isEmpty($value = null) {
		if ($value === null || $value === '') {
			return true;
		}
		return false;
	}

	/**
	 * 文字列の置き換え処理を実施します.
	 */
	public static function replaceAll($str, $keyPairs) {
		foreach ( $keyPairs as $key => $value ) {
			$str = str_replace ( $key, $value, $str );
		}
		return $str;
	}

	/**
	 * tokenで渡すランダムな文字列を生成します.
	 */
	public static function makeTokenStr() {
		return self::makeRandomStr ( 50 );
	}

	/**
	 * マルチバイト文字列を逆にします.
	 */
	public static function mb_strrev($data, $code) {
		$n = mb_strlen ( $data, $code );
		for($i = 0; $i < $n; $i ++) {
			$r_array [$i] = mb_substr ( $data, $i, 1, $code );
		}
		$r_array = array_reverse ( $r_array );
		$data = NULL;
		for($i = 0; $i < $n; $i ++) {
			$data .= $r_array [$i];
		}
		return $data;
	}
	public static function unicode_decode($str) {
		return preg_replace_callback ( "/((?:[^\x09\x0A\x0D\x20-\x7E]{3})+)/", "decode_callback", $str );
	}
}
function decode_callback($matches) {
	$char = mb_convert_encoding ( $matches [1], "UTF-16", "UTF-8" );
	$escaped = "";
	for($i = 0, $l = strlen ( $char ); $i < $l; $i += 2) {
		$escaped .= "\u" . sprintf ( "%02x%02x", ord ( $char [$i] ), ord ( $char [$i + 1] ) );
	}
	return $escaped;
}
?>