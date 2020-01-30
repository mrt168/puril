<?php

namespace App\Vendor;

class FileUtil {

	/***********************************************
	 * アップロードフォルダ FROM
	 ***********************************************/

	// 外部非公開用フォルダ名
	const OUTSIDE_WEBROOT = 'outside_webroot';

	// ユーザアップロード画像保存先
	const USER_PHOTO = 'u_photo';


	/***********************************************
	 * アップロードフォルダ TO
	 ***********************************************/

	const DEFAULT_PROF_IMAGE = '/img/profimage/default.png';

	const MAKE_DIR_PERMIT = 0707;

	/**
	 * ファイルアップロード処理を実施します.
	 * @param file $tmp 添付ファイル
	 * @param string $folder
	 * @param boolean $isOutside trueの場合はapp/outside_webrootフォルダにアップ、それ以外はapp/webroot内にアップする
	 * @param string $extension 拡張子(.を含む)
	 * @param string $fileName ファイル名(空の場合はランダムな文字列で生成)※.は含めない
	 *
	 * @return 保存先パス
	 */
	public static function upload($tmp, $folder, $isOutside, $extension, $fileName = null, $isDatePath = true) {
		try {
			if ($isOutside === true) {
				// app/outside_webrootへアップロード
				$path = APP.self::OUTSIDE_WEBROOT.DS.$folder.DS.date('Y').DS.date('n').DS.date('j').DS;

			} else {
				if ($isDatePath) {
					// app/webrootへアップロード
					$path = APP.WEBROOT_DIR.DS.$folder.DS.date('Y').DS.date('n').DS.date('j').DS;
				} else {
					$path = APP.WEBROOT_DIR.DS.$folder.DS;
				}
			}
			$path = str_replace('/', DS, $path);
			if (!is_dir($path)) {
				mkdir($path, self::MAKE_DIR_PERMIT, TRUE);
			}
			// ファイルパス取得
			$filePath = self::makeFileName($path, $extension, $fileName);

			move_uploaded_file($tmp, $filePath);

			return $filePath;
		} catch (Exception $e) {
			throw $e;
		}
	}

	/**
	 * ファイル名を生成します.
	 *
	 * @return ファイルパス
	 */
	public static function makeFileName($path, $extension, $fileName = null) {
		if (empty($fileName)){
			$fileName = StringUtil::makeRandomStr(30).$extension;
		} else {
			$fileName .= $extension;
		}

		$filePath = $path.$fileName;
		if (is_file($filePath)) {
			// ファイルが既に存在している場合は再生成
			self::makeFileName($path, $extension);
		}
		return $filePath;
	}

	/**
	 * 引数に指定されたパスのURLを取得します.
	 */
	public static function getPathToUrl($path) {
		$fileUrl = str_replace(ROOT, '', $path);
		return str_replace(DS, '/', $fileUrl);
	}

	/**
	 * ユーザ画像フォルダを取得します.
	 */
	public static function getUserPhoto() {
		return self::USER_PHOTO;
	}

	/**
	 * ユーザホーム画像フォルダを取得します.
	 */
	public static function getUserHomePhoto() {
		return self::USER_HOME_PHOTO;
	}

	/**
	 * ユーザー画像フォルダを取得します.
	 */
	public static function getUserImage($userId, $created) {
		$date = (date('Hidmy', strtotime($created)))*32;
		$id = $userId*1024*17;
		return self::USER_PHOTO.DS.$date.DS.$id;
	}

	/**
	 * アプリアイコン画像フォルダを取得します.
	 */
	public static function getApplicationIcon($applicationId, $created) {
		$date = (date('Hidmy', strtotime($created)))*32;
		$id = $applicationId*1024*17;
		return self::APP_ICON.DS.$date.DS.$id;
	}

	/**
	 * インストール画像フォルダを取得します.
	 */
	public static function getInstallImage($applicationId, $created) {
		$date = (date('Hidmy', strtotime($created)))*32;
		$id = $applicationId*1024*17;
		return self::APP_INSTALL.DS.$date.DS.$id;
	}
}

?>