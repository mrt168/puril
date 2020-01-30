<?php
namespace App\Controller\Front;

use App\Vendor\SiteInfo;
use App\Controller\Front\FrontAppController;
use App\Vendor\Layout;
use Cake\ORM\TableRegistry;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;

/**
 * 画像取得.
 */
class ImagesController extends FrontAppController {

	public $uses = false;

	const NO_IMG_URL = "img/noimage.jpg";
	const NO_IMG_ICON_URL = "img/noimgicon.jpg";

	/**
	 * 店舗画像の取得.
	 */
	public function shopImage($shopImgId) {
		$this->autoRender = false;
		if (!empty($shopImgId)) {
			$shopImgTable = TableRegistry::get('ShopImages');
			$shopImg = $shopImgTable->get($shopImgId);

			if (!empty($shopImg->image_path)) {
				$this->Image->output_image($shopImg->image_path);
			}
		}
		exit;
	}

	/**
	 * ひとこと用店舗画像の取得.
	 */
	public function wordShopImage($shopId) {
		$this->autoRender = false;
		if (!empty($shopId)) {
			$shopTable = TableRegistry::get('Shops');
			$shop = $shopTable->get($shopId);

			if (!empty($shop->shop_image_path)) {
				$this->Image->output_image($shop->shop_image_path);
			}
		}
		exit;
	}

	/**
	 * スタッフ画像の取得.
	 */
	public function staffImage($staffId) {
		$this->autoRender = false;
		if (!empty($staffId)) {
			$staffTable = TableRegistry::get('Staffs');
			$staff = $staffTable->get($staffId);

			if (!empty($staff->image_path)) {
				$this->Image->output_image($staff->image_path);
			} else {
				$this->Image->output_image(self::NO_IMG_ICON_URL);
			}
		}
		exit;
	}

	/**
	 * インタビューアイキャッチ画像の取得.
	 */
	public function interviewShopImage($shopId) {
		$this->autoRender = false;
		if (!empty($shopId)) {
			$shopTable = TableRegistry::get('Shops');
			$shop = $shopTable->get($shopId);

			if (!empty($shop->interview_image_path)) {
				$this->Image->output_image($shop->interview_image_path);
			}
		}
		exit;
	}

	/**
	 * インタビュー画像の取得.
	 */
	public function interviewImage($interviewId) {
		$this->autoRender = false;
		if (!empty($interviewId)) {
			$interviewTable = TableRegistry::get('Interviews');
			$interview = $interviewTable->get($interviewId);

			if (!empty($interview->image_path)) {
				$this->Image->output_image($interview->image_path);
			}
		}
		exit;
	}

	/**
	 * ブログ画像の取得.
	 */
	public function blogImage($blogId) {
		$this->autoRender = false;
		if (!empty($blogId)) {
			$blogTable = TableRegistry::get('Blogs');
			$blog = $blogTable->get($blogId);

			if (!empty($blog->image_path)) {
				$this->Image->output_image($blog->image_path);
			} else {
				$this->Image->output_image(self::NO_IMG_URL);
			}
		}
		exit;
	}

	/**
	 * 店舗画像の取得.
	 */
	public function image($imgId) {
		$this->autoRender = false;
		if (!empty($imgId)) {
			$imgTable = TableRegistry::get('Images');
			$img = $imgTable->get($imgId);

			if (!empty($img->image_path)) {
				$this->Image->output_image($img->image_path);
			}
		}
		exit;
	}

	/**
	 * ブランド画像の取得.
	 */
	public function brandImage($brandId) {
		$this->autoRender = false;

		if (!empty($brandId)) {
			$brandTable= TableRegistry::get('Brands');
			$brand = $brandTable->get($brandId);

			$path = $brand->image_path;
			if (!empty($path)) {
				$this->Image->output_image($path);
			}
		}
		exit;
	}
}