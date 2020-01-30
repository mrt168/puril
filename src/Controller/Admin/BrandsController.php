<?php
namespace App\Controller\Admin;

use App\Controller\Admin\AdminAppController;
use App\Vendor\Layout;
use App\Vendor\Code\ClickUrl;
use App\Vendor\PagingUtil;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use App\Vendor\Messages;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\ShowFlg;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use App\Vendor\Code\DepilationType;
use App\Vendor\Code\ShopType;
use Cake\Filesystem\File;

class BrandsController extends AdminAppController {

	const INDEX_PAGE = 'index';
	const EDIT_PAGE = 'edit';
	const URL_EDIT_PAGE = 'url_edit';
	const DETAIL_PAGE = 'detail';

	const SEARCH_SESSION_NAME = "hEDRmYtpY2ig0Nsl";

	/**
	 * ブランド一覧画面へ遷移します.
	 *
	 * @click_url(brand_view)
	 */
	public function index() {
		$this->Session->delete(self::SEARCH_SESSION_NAME);
		$this->search();
	}

	/**
	 * ブランド検索処理をします.
	 *
	 * @click_url(brand_view)
	 */
	public function search() {
		$wheres = array();
		if (isset($this->request->data['search'])) {
			$wheres = $this->request->data['Brands'];

		} else {
			if ($this->Session->check(self::SEARCH_SESSION_NAME)) {
				$wheresJson = parent::getSession(self::SEARCH_SESSION_NAME);
				$wheres = json_decode($wheresJson, true);

				$this->request->data['Brands'] = $wheres;
			} else {
				$wheres = array();
			}
		}
		$wheresJson = json_encode($wheres);
		parent::setSession(self::SEARCH_SESSION_NAME, $wheresJson);

		$this->set('wheres', $wheres);

		$brandTable = TableRegistry::get('Brands');
		$this->paginate = $brandTable->makeFindByDelFlgOrderById($wheres, PagingUtil::BRAND_APP);
		$brands = $this->paginate('Brands');

		ConvertItems::convertObjectValue($brands)
			->codeConverter(ShopType::toString(), CodePattern::$VALUE, 'shop_type')
			->codeConverter(DepilationType::toString(), CodePattern::$VALUE, 'depilation_type');

		$this->set('brands', $brands);

		parent::move(ClickUrl::$BRAND_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::INDEX_PAGE);
	}

	/**
	 * ブランド詳細画面へ遷移します.
	 *
	 * @click_url(brand_view)
	 */
	public function detail($brandId) {
		$brandTable= TableRegistry::get('Brands');
		$brand = $brandTable->findByIdAndDelFlg($brandId);
		if (empty($brandId) || empty($brand)) {
			$this->redirect(array('controller'=> 'reviews', 'action'=> 'index'));
			return;
		}

		$this->set('brand', $brand);

		parent::move(ClickUrl::$BRAND_VIEW, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::DETAIL_PAGE);
	}

	/**
	 * ブランド登録画面へ遷移します.
	 *
	 * @click_url(brand_reg)
	 */
	public function moveRegist() {

		parent::move(ClickUrl::$BRAND_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
	}

	/**
	 * ブランド編集画面へ遷移します.
	 *
	 * @click_url(brand_reg)
	 */
	public function moveEdit($brandId = null) {
		if (!empty($brandId)) {
			$brandTable = TableRegistry::get('Brands');
			$brand = $brandTable->findByIdAndDelFlg($brandId);

			if (!empty($brand)) {
				$this->request->data['Brands'] = $brand;

				//脱毛部位
				$this->request->data['DepilationSites']['depilation_site_ids'] = [];
				foreach ($brand['depilation_sites'] as $depilationSite) {
					array_push($this->request->data['DepilationSites']['depilation_site_ids'], $depilationSite['depilation_site_id']);
				}
			}
		}

		parent::move(ClickUrl::$BRAND_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::EDIT_PAGE);
	}

	/**
	 * ブランド更新処理を実施します
	 *
	 * @click_url(brand_reg)
	 */
	public function edit() {
		$brandTable = TableRegistry::get('Brands');
		$isUpdate = false;

		if (isset($this->request->data['regist'])) {
			// 新規登録
			$brand = $brandTable->newEntity($this->request->getData(), ['validate'=> 'edit']);
		} else if (isset($this->request->data['update'])) {
			// 更新
			$brand = $brandTable->get($this->request->getData('Brands.brand_id'));
			$brandTable->patchEntity($brand, $this->request->getData(), ['validate'=> 'edit']);
			$isUpdate = true;
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('moveRegist');
			return;
		}

		$depilationSiteIds = $this->request->getData('DepilationSites.depilation_site_ids');

		if (!$brand->getErrors()) {
			$saveBrand = $brandTable->save($brand);

			// 画像保存
			if (!empty($this->request->data['Brands']['image_file']['name'])) {
				$isImgEdit = false;
				if (!empty($brand['brand_id'])) {
					$beforeBrand = $brandTable->get($brand['brand_id']);
					if (!empty($beforeBrand->image_path)) {
						move_uploaded_file($this->request->data['Brands']['image_file']['tmp_name'], $beforeBrand->image_path);
						$isImgEdit = true;
					}
				}

				if (!$isImgEdit) {
					$pathInfo = pathinfo($this->request->data['Brands']['image_file']['name']);
					$extension = '.'.$pathInfo['extension'];

					$filePath = $this->Image->upload($this->request->data['Brands']['image_file']['tmp_name'], $this->Image->getBrandImageFolder(), true, $extension, null, true);

					$saveData = [];
					$saveData = $brandTable->get($saveBrand['brand_id']);
					$saveData['image_path'] = $filePath;
					$brandTable->save($saveData);
				}
			}

			// 脱毛部位
			$bdsTable = TableRegistry::get('BrandDepilationSites');
			$bdsTable->deleteByBrandId($saveBrand['brand_id']);
			if (!empty($depilationSiteIds)) {
				foreach ($depilationSiteIds as $depilationSiteId) {
					$brandDepilationSite = [];
					$brandDepilationSite['brand_id'] = $saveBrand['brand_id'];
					$brandDepilationSite['depilation_site_id'] = $depilationSiteId;

					$brandDepilationSite = $bdsTable->newEntity($brandDepilationSite);
					$bdsTable->save($brandDepilationSite);
				}
			}

			// xml編集
			if (!$isUpdate) {
				//追加
				$file = new File(WWW_ROOT."sitemap_brands.xml");
				$xml = $file->read();
				$addxml = <<<EOF
	<url id="{$saveBrand['brand_id']}"><loc>https://puril.net/brands/{$saveBrand['brand_id']}/</loc><changefreq>daily</changefreq></url>
</urlset>
EOF;
				$xml = str_replace('</urlset>', $addxml, $xml);
				$file->write($xml);
			}

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'brands', 'action'=> 'index'));
			return;
		}
		$this->set('brand', $brand);
		$this->setAction('moveRegist');
	}

	/**
	 * 関連URL登録画面へ遷移します.
	 *
	 * @click_url(brand_reg)
	 */
	public function moveUrlRegist($brandId) {

		$this->request->data['BrandUrls']['brand_id'] = $brandId;

		$brandTable = TableRegistry::get('Brands');
		$brand = $brandTable->findByIdAndDelFlg($brandId);

		$this->set('brand', $brand);

		parent::move(ClickUrl::$BRAND_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::URL_EDIT_PAGE);
	}

	/**
	 * 関連URL編集画面へ遷移します.
	 *
	 * @click_url(brand_reg)
	 */
	public function moveUrlEdit($brandUrlId, $brandId) {


		$brandTable = TableRegistry::get('Brands');
		$brand = $brandTable->findByIdAndDelFlg($brandId);

		$brandUrlTable = TableRegistry::get('BrandUrls');
		$brandUrl = $brandUrlTable->findByIdAndDelFlg($brandUrlId);

		$this->request->data['BrandUrls'] = $brandUrl;

		$this->set('brand', $brand);

		parent::move(ClickUrl::$BRAND_REG, Layout::ADMIN_AFTER_LOGIN_LAYOUT, self::URL_EDIT_PAGE);
	}

	/**
	 * スタッフ更新処理を実施します
	 *
	 * @click_url(brand_reg)
	 */
	public function urlEdit() {

		$brandUrlTable = TableRegistry::get('BrandUrls');

		if (isset($this->request->data['regist'])) {
			// 新規登録
			$brandUrl = $brandUrlTable->newEntity($this->request->getData());
		} else if (isset($this->request->data['update'])) {
			// 更新
			$brandUrl = $brandUrlTable->get($this->request->getData()['BrandUrls']['brand_url_id']);
			$brandUrlTable->patchEntity($brandUrl, $this->request->getData());
		} else {
			// 新規登録ボタンも更新ボタンも押してない場合は登録画面へ
			$this->setAction('moveUrlRegist');
			return;
		}

		if (!$brandUrl->getErrors()) {
			$saveStaff = $brandUrlTable->save($brandUrl);

			$this->Flash->set(Messages::UPDATE);
			$this->redirect(array('controller'=> 'brands', 'action'=> 'moveUrlRegist', $brandUrl['brand_id']));
			return ;
		}
		$this->set('brandUrl', $brandUrl);
		$this->setAction('moveUrlRegist', $brandUrl['brand_id']);
	}

	/**
	 * 削除処理を実施します.
	 *
	 * @click_url(brand_view)
	 */
	public function delete($brandId = null) {
		if (!empty($brandId)) {
			$brandTable = TableRegistry::get('Brands');
			$brandTable->deleteById($brandId);

			// xml編集
			$file = new File(WWW_ROOT."sitemap_brands.xml");
			$xml = $file->read();

			$delxml = '<url id="'.$brandId.'"><loc>https://puril.net/brands/'.$brandId.'/</loc><changefreq>daily</changefreq></url>';
			$xml = str_replace($delxml, "", $xml);
			$xml = preg_replace('/\n(\s|\n)*\n/u',"\n",$xml);
			$file->write($xml);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(array('controller'=> 'brands', 'action'=> 'index'));
	}

	/**
	 * 関連URL削除処理を実施します.
	 *
	 * @click_url(brand_view)
	 */
	public function deleteUrl($brandUrlId = null) {
		if (!empty($brandUrlId)) {
			$brandUrlTable = TableRegistry::get('BrandUrls');
			$brandUrl = $brandUrlTable->get($brandUrlId);
			$brandId = $brandUrl['brand_id'];
			$brandUrlTable->delete($brandUrl);

			$this->Flash->set(Messages::DELETE);
		}
		$this->redirect(array('controller'=> 'brands', 'action'=> 'moveUrlRegist', $brandId));
	}

	/**
	 * 画像削除処理を実施します.
	 *
	 * @click_url(brand_view)
	 */
	public function imgDelete($brandId = null) {
		if (!empty($brandId)) {
			$brandTable = TableRegistry::get('Brands');

			$brand = $brandTable->get($brandId);
			unlink($brand['image_path']);
			$brandTable->patchEntity($brand, ['image_path'=>NULL]);
			$brandTable->save($brand);

			$this->Flash->set("画像を". Messages::DELETE);
			$this->redirect(array('controller'=> 'brands', 'action'=> 'moveEdit', $brandId));
			return ;
		}
		$this->redirect(array('controller'=> 'brands', 'action'=> 'index'));
	}

	/**
	 * ブランド画像の取得.
	 *
	 * @click_url(exclude)
	 */
	public function imageBrand($brandId) {
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