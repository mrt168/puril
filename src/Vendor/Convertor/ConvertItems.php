<?php
namespace App\Vendor\Convertor;

class ConvertItems {
	private function __construct() {
	}
	public static function convertValue(&$src) {
		return new ConvertValue ( $src );
	}

	public static function convertObjectValue(&$src) {

		$datas = $src->toArray();
		$src = array();
		foreach ($datas as $key => $data) {
			$src[$key] = $data->toArray();
		}

		return new ConvertValue($src);
	}
}
?>