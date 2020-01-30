<?php
namespace App\Controller\Component;

use Cake\Controller\Component;

class CsvComponent extends Component {

	public static function init($fileName) {
		// 実行時間の最大値を制限します.
		set_time_limit(0);

		$fileName = mb_convert_encoding($fileName, "SJIS-win", "UTF-8");

		// MIMEタイプの設定
		header("Content-Type: application/octet-stream");
		header("Content-Type: text/html; charset=Shift_JIS");
		//名前を付けて保存のダイアログボックスのファイル名の初期値
		header("Content-Disposition: attachment; filename={$fileName}");
	}

	public static function export_header($headers) {
		@ob_flush();
		@flush();

		$val = '';
		foreach ($headers as $header) {
			$val .= empty($header) ? '' : '"'.str_replace("\r\n", ' ', $header).'"';
			$val .= ',';
		}
		$val = mb_substr($val, 0, mb_strlen($val) - 1);
		$val = mb_convert_encoding($val."\r\n" , "sjis-win" , 'utf-8');

		// 出力
		echo $val;
		unset($val);

		@ob_flush();
		@flush();
	}

	public static function export($datas) {
		@ob_flush();
		@flush();

		$count = count($datas);
		for ($i = 0; $i < $count; $i++) {
			$val = '';
			$data = $datas[$i];
			if (is_array($data)) {
				foreach ($data as $values) {
					if (is_array($values)) {
						foreach ($values as $key=> $value) {
							$val .= StringUtil::isEmpty($value) ? '' : '"'.str_replace("\r\n", ' ', $value).'"';
							$val .= ',';
						}
					} else {
						$val .= StringUtil::isEmpty($values) ? '' : '"'.str_replace("\r\n", ' ', $values).'"';
						$val .= ',';
					}
				}
				$val = mb_substr($val, 0, mb_strlen($val) - 1);
				$val = mb_convert_encoding($val."\r\n" , "sjis-win" , 'utf-8');
			} else {
				$val .= StringUtil::isEmpty($data) ? '' : '"'.str_replace("\r\n", ' ', $data).'"';
				$val .= ',';
				$val = mb_convert_encoding($val, "sjis-win" , 'utf-8');
			}

			// 出力
			echo $val;
			unset($val);

			if ($i%100 == 0) {
				@ob_flush();
				@flush();
			}
		}
	}

	public static function save($datas, $path) {
		$path = str_replace('/', DS, $path);

		if (!file_exists($path)) {
			$folder = new Folder();
			$folder->create(dirname($path));
		}

		$file = new File($path, true);
		$count = count($datas);
		for ($i = 0; $i < $count; $i++) {
			$val = '';
			$data = $datas[$i];
			foreach ($data as $values) {
				foreach ($values as $key=> $value) {
					$val .= StringUtil::isEmpty($value) ? '' : str_replace("\r\n", ' ', $value);
					$val .= ',';
				}
			}
			$val = mb_substr($val, 0, mb_strlen($val) - 1);
			$val = mb_convert_encoding($val."\r\n" , "sjis-win" , 'utf-8');

			$file->append($val);
			unset($val);
		}
		$file->close();
	}

	public static function implode_recursive($glue, array $pieces) {
		$f = function ($r, $p) use ($glue, &$f) {
			return (empty($r) ? '' : "{$r}{$glue}").(is_array($p) ? array_reduce($p, $f) : $p);
		};
		return array_reduce($pieces, $f, '');
	}

	/**
	 * 画面出力処理.
	 */
	public static function output_message($line, $message, $regex) {
		$html = 'var elem = document.createElement("div");';
		$html .= 'elem.innerHTML = "'.$line.'行目	'.$message.'<br />";';
		echo '<script type="text/javascript">'.$html.'document.getElementById(\''.$regex.'\').appendChild(elem);</script>';
		@ob_flush();
		@flush();
	}

	public static function script_message($regex, $count) {
		// 5件ずつ表示
		echo '<script type="text/javascript">document.getElementById(\''.$regex.'\').innerHTML=\''.$count.'\'</script>';

		@ob_flush();
		@flush();
	}

	public static function csv_comp($regex, $count, $importCount, $deleteCount, $errorCount, $proc) {
		echo '<script type="text/javascript">document.getElementById(\''.$regex.'\').innerHTML='
				.'\''
				.'インポートが完了しました。<br /><br />'
				.'合計：'.$count
				.'<br />&nbsp;&nbsp;インポート件数：'.$importCount
				.'<br />&nbsp;&nbsp;削除件数：'.$deleteCount
				.'<br />&nbsp;&nbsp;除外件数：'.$errorCount
				.'\';'
				.'document.getElementById(\''.$proc.'\').style.display = "none"</script>';
		@ob_flush();
		@flush();
	}
}