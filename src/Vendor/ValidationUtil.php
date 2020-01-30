<?php
namespace App\Vendor;
/**
 * バリデーションに関する定数及び、関数を宣言するクラス.
 * @author yagi
 *
 */
class ValidationUtil {
	const IMAGE_FILE_LIMIT = '1MB';

	/**
	 * *********************************************
	 * 正規表現 FROM
	 * *********************************************
	 */

	// 半角英数チェック時の正規表現文字列
	const CHECK_ALPHA_NUMERIC = '/^[a-z\d]*\z/i';

	// 半角英数(スペース有り)チェック時の正規表現文字列
	const CHECK_ALPHA_NUMERIC_SPACE = '/^[ a-z\d]*\z/i';

	// ﾛｸﾞｲﾝID&ﾊﾟｽﾜｰﾄﾞチェック時の正規表現文字列
	const CHECK_PASSWORD = '/^[a-z\d_-]*\z/i';

	// 半角数値チェック時の正規表現文字列
	const CHECK_NUMERIC = '/^[0-9]+\z/';

	// 半角数値＆全角チェック時の正規表現文字列
	const CHECK_NUMERIC_ZENKAKU = '/^[0-9０-９]+\z/u';

	// 身長、体重のようなタイプをチェック時の正規表現文字列
	const CHECK_DECIMAL_NUMBER = '/^[0-9]{1,3}.?[0-9]\z/';

	// 半角英数字と(_)の正規表現文字列
	const CHECK_ALPHA_NUMERIC_BAR = '/^[a-z\d_]*\z/i';

	// 電話番号の正規表現文字列
	const CHECK_TEL_NO = '/^[\d-]*\z/i';

	// 全角カナチェック
	const CHECK_ZENKAKU_KANA = '/^[ァ-ヶー]+\z/u';

	// 全角ひらがなチェック
	const CHECK_ZENKAKU_HIRAGANA = '/^[ぁ-んー]+\z/u';

	// 画像データかどうか
	const CHECK_IMAGE_PASS = "/^([-_.!~*\'()a-zA-Z0-9;\/?:\@&=+\$,%#]+)\.(jpeg|jpg|gif|png)\z/";

	// 連続した..を許可する場合のメールアドレスチェック正規表現
	const CHECK_EMAIL = '/^[-+.\\w]+@[-a-z0-9]+(\\.[-a-z0-9]+)*\\.[a-z]{2,6}\z/i';
	const FILE_LIMIT = '10MB';

	/**
	 * *********************************************
	 * 正規表現 TO
	 * *********************************************
	 */

	// システムユーザログインIDの最大桁数
	const SYSTEM_USER_LOGIN_ID_MAX_LEN = 32;
	// システムユーザログインIDの最小桁数
	const SYSTEM_USER_LOGIN_ID_MIN_LEN = 5;

	// システムユーザログインパスの最大桁数
	const SYSTEM_USER_LOGIN_PASS_MAX_LEN = 32;
	// システムユーザログインパスの最小桁数
	const SYSTEM_USER_LOGIN_PASS_MIN_LEN = 8;

	// ユーザログインIDの最大桁数
	const USER_LOGIN_ID_MAX_LEN = 32;
	//ユーザログインIDの最小桁数
	const USER_LOGIN_ID_MIN_LEN = 5;

	// ユーザログインパスの最大桁数
	const USER_LOGIN_PASS_MAX_LEN = 32;
	// ユーザログインパスの最小桁数
	const USER_LOGIN_PASS_MIN_LEN = 8;

	// intの最大値
	public static $INT_RANGE = array (
			'range',
			0,
			2147483647
	);

	/**
	 * アップロードを許可する画像ファイル拡張子.
	 */
	public static function imageExt() {
		return array (
				'jpg',
				'jpeg',
				'png',
				'gif'
		);
	}

	/**
	 * アップロードを許可する動画ファイル拡張子.
	 */
	public static function movieExt() {
		return array (
				'mp4',
				'mp3',
				'avi',
				'flv'
		);
	}
}

?>