<?php
namespace App\Vendor;

class DateUtil {

	/**
	 * 引数に指定された日付の週の初めを返します.
	 *
	 * @param string $ymd
	 *        	日付
	 */
	public static function getWeekFirst($ymd) {
		$w = date("w", strtotime($ymd)) - 1; // 始まりを月曜とする、日曜の場合は-1を消す
		return date('Y-m-d', strtotime("-{$w} day", strtotime($ymd)));
	}

	/**
	 * 引数に指定された日付の差分(日)を取得します.
	 *
	 * @param string $from
	 *        	日付
	 * @param string $to
	 *        	日付
	 */
	public static function getDifByFromTo($from, $to) {
		// 日付をUNIXタイムスタンプに変換
		$timestamp1 = strtotime($from);
		$timestamp2 = strtotime($to);

		// 何秒離れているかを計算
		$seconddiff = abs($timestamp2 - $timestamp1);

		// 日数に変換
		return $seconddiff / (60 * 60 * 24);
	}

	public static function getWeekName($date) {
		$weekjp = array(
				'日', //0
				'月', //1
				'火', //2
				'水', //3
				'木', //4
				'金', //5
				'土'  //6
		);
		return $weekjp[date('w', strtotime($date))];
	}
}
