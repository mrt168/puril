<?php
namespace App\Controller\Front\Sp;

use App\Vendor\SiteInfo;

/**
 * Index.
 */
class IndexesController extends SpAppController {

	public $uses = false;

	public function index() {
		parent::move(SiteInfo::$TOP, null, 'index');
	}
}