<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use App\Vendor\StringUtil;

/**
 * Image component
 */
class ImageComponent extends Component
{

	/***********************************************
	 * アップロードフォルダ FROM
	 ***********************************************/

	// 外部非公開用フォルダ名
	const OUTSIDE_WEBROOT = 'outside_webroot';

	// 店舗アップロード画像保存先
	const SHOP_IMAGE_FOLDER = 'shop_img';

	// スタッフアップロード画像保存先
	const STAFF_IMAGE_FOLDER = 'staff_img';

	// インタビューアップロード画像保存先
	const INTERVIEW_IMAGE_FOLDER = 'interview_img';

	// ブログアップロード画像保存先
	const BLOG_IMAGE_FOLDER = 'blog_img';

	// ブランドアップロード画像保存先
	const BRAND_IMAGE_FOLDER = 'brand_img';

	// アップロード画像保存先
	const IMAGE_FOLDER = 'img';

	/***********************************************
	 * アップロードフォルダ TO
	 ***********************************************/

	const MAKE_DIR_PERMIT = 0707;

	public static $URL_PROFILE = "pi";

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = [];

    /**
     * パス指定でPDFファイルをブラウザに出力.
     */
    public function output_pdf($path) {
    	$pathInfo = pathinfo($path);
    	$contentType = $this->getContentType($pathInfo['extension']);
    	header("Content-Type: ".$contentType);
    	header('Content-Disposition: inline; filename="'.basename($path).'"');
    	header('Content-Length: ' . filesize($path));
    	readfile($path);
    }

    /**
     * パス指定でJPGファイルをimgタグに出力出来るよう変換.
     */
    public function output_image($path) {
    	$pathInfo = pathinfo($path);
    	$contentType = $this->getContentType($pathInfo['extension']);
    	header("Content-Type: ".$contentType);
    	header('Content-Disposition: inline; filename="'.basename($path).'"');
    	header('Content-Length: ' . filesize($path));
    	readfile($path);
    }

    /**
     * 画像URLの生成.
     */
    public function makeProfileImgURL($userId) {
    	return self::$URL_PROFILE.$userId; // プロフ画像
    }

    /**
     * 画像URL解析
     */
    public function analysisURL($url) {
    	return str_replace(self::$URL_PROFILE, "", $url);
    }

    private function getContentType($extension) {
    	switch( $extension ) {
    		case "gif": $ctype="image/gif"; break;
    		case "png": $ctype="image/png"; break;
    		case "pdf": $ctype="application/pdf"; break;
    		case "jpeg": $ctype="image/jpg"; break;
    		case "jpg": $ctype="image/jpg"; break;
    		case "txt": $ctype="text/plain"; break;
    		case "text": $ctype="text/plain"; break;
    		default:
    	}
    	return $ctype;
    }


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
    public function upload($tmp, $folder, $isOutside, $extension, $fileName = null, $isDatePath = true) {
    	try {
    		if ($isOutside === true) {
    			// app/outside_webrootへアップロード
    			$path = APP.self::OUTSIDE_WEBROOT.DS.$folder.DS.date('Y').DS.date('n').DS.date('j').DS;

    		} else {
    			if ($isDatePath) {
    				// app/webrootへアップロード
    				$path = WWW_ROOT.$folder.DS.date('Y').DS.date('n').DS.date('j').DS;
    			} else {
    				$path = WWW_ROOT.$folder.DS;
    			}
    		}
    		$path = str_replace('/', DS, $path);
    		if (!is_dir($path)) {
    			mkdir($path, self::MAKE_DIR_PERMIT, TRUE);
    		}
    		// ファイルパス取得
    		$filePath = $this->makeFileName($path, $extension, $fileName);

    		move_uploaded_file($tmp, $filePath);

    		return $filePath;
    	} catch (\Exception $e) {
    		throw $e;
    	}
    }

    /**
     * ファイル名を生成します.
     *
     * @return ファイルパス
     */
    public function makeFileName($path, $extension, $fileName = null) {
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
    public function getPathToUrl($path) {
    	$fileUrl = str_replace(WWW_ROOT, '', $path);
    	return str_replace(DS, '/', $fileUrl);
    }

    /**
     * 店舗画像フォルダを取得します.
     */
    public function getShopImageFolder() {
    	return self::SHOP_IMAGE_FOLDER;
    }

    /**
     * スタッフ画像フォルダを取得します.
     */
    public function getStaffImageFolder() {
    	return self::STAFF_IMAGE_FOLDER;
    }

    /**
     * インタビュー画像フォルダを取得します.
     */
    public function getInterviewImageFolder() {
    	return self::INTERVIEW_IMAGE_FOLDER;
    }

    /**
     * ブログ画像フォルダを取得します.
     */
    public function getBlogImageFolder() {
    	return self::BLOG_IMAGE_FOLDER;
    }

    /**
     * ブランド画像フォルダを取得します.
     */
    public function getBrandImageFolder() {
    	return self::BRAND_IMAGE_FOLDER;
    }

    /**
     * 画像フォルダを取得します.
     */
    public function getImageFolder() {
    	return self::IMAGE_FOLDER;
    }
}
