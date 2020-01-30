<?php
namespace App\Model\Table;

use Cake\ORM\Table;
use App\Vendor\Crypt;
use App\Vendor\Code\DelFlg;
use App\Vendor\Code\CodePattern;
use App\Vendor\Util;
use Cake\Datasource\EntityInterface;
use Cake\Datasource\ConnectionManager;
use Cake\ORM\TableRegistry;

class AppTable extends Table {

	public function newEntity($data = null, array $options = []) {
		$entity = parent::newEntity($data, $options);
		if ($this->hasField('del_flg')) {
			$entity->set(array('del_flg'=> DelFlg::$MI_SAKUJO[CodePattern::$CODE]));
		}
		if ($this->hasField('create_user')) {
			$createUser = 0;
			if (!empty(Util::getLoginId())) {
				$createUser = Util::getLoginId();
			}
			$entity->set(array('create_user'=> $createUser));
		}
		if ($this->hasField('modify_user')) {
			$modifyUser = 0;
			if (!empty(Util::getLoginId())) {
				$modifyUser = Util::getLoginId();
			}
			$entity->set(array('modify_user'=> $modifyUser));
		}
		return $entity;
	}

	public function patchEntity(EntityInterface $entity, array $data, array $options = []) {
		$entity = parent::patchEntity($entity, $data, $options);

		if ($this->hasField('modify_user')) {
			$modifyUser = 0;
			if (!empty(Util::getLoginId())) {
				$modifyUser = Util::getLoginId();
			}
			$entity->set(array('modify_user'=> $modifyUser));
		}
		return $entity;
	}

	public function saveAllAtOnce($datas) {
		if (count($datas) > 0 && !empty($datas[0])) {
			$fields = array_keys($datas[0]);

			$query = TableRegistry::get($this->_table)->query();
			$query->insert($fields);

			foreach ($datas as $data) {
				$query->values($data);
			}
			$query->execute();

			return true;
		}
		return false;
	}

	protected function crypt_binary($query, $regexes) {
		if (isset($query['conditions']) && !empty($query['conditions'])) {
			$conditions = $query['conditions'];
			$returnValues = array();
			foreach ($conditions as $key=> $condition) {
				if (empty($condition)) {
					// 空の場合は無視
					continue;
				}
				$key = key($condition);
				$newVal = $condition;
				foreach ($regexes as $regex=> $cryptKeyVal) {
					if (strpos($key, $regex) !== false && strpos($key, $regex.'_') === false) {
						$newKey = "Binary {$regex}";
						if ($cryptKeyVal == 'hash') {
							$encVal = Crypt::hash($condition[$key]);

						} else {
							$encVal = Crypt::encrypt($condition[$key], $cryptKeyVal, true);
						}
						$newVal = "{$newKey} = '{$encVal}'";
						break;
					}
				}
				array_push($returnValues, $newVal);
			}
			$query['conditions'] = $returnValues;
		}
		return $query;
	}

	/**
	 * 検索条件 = を生成
	 *
	 * @param string $columnName カラム名
	 * @param unknown $value 値
	 * @param string $isEmpty $valueが空文字列でも条件として使用するかどうか
	 *                trueの場合、空文字列でも検索条件として使用する
	 *                それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function eq($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName"=>$value);
	}

	protected function hash_eq($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		$value = Crypt::hash($value);

		return array("$columnName"=>$value);
	}

	/**
	 * 検索条件 <= を生成
	 *
	 * @param string $columnName
	 *        	カラム名
	 * @param unknown $value
	 *        	値
	 * @param string $isEmpty
	 *        	$valueが空文字列でも条件として使用するかどうか
	 *        	trueの場合、空文字列でも検索条件として使用する
	 *        	それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function le($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName <= " => $value);
	}

	/**
	 * 検索条件 < を生成
	 *
	 * @param string $columnName
	 *        	カラム名
	 * @param unknown $value
	 *        	値
	 * @param string $isEmpty
	 *        	$valueが空文字列でも条件として使用するかどうか
	 *        	trueの場合、空文字列でも検索条件として使用する
	 *        	それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function lt($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName < " => $value);
	}

	/**
	 * 検索条件 >= を生成
	 *
	 * @param string $columnName カラム名
	 * @param unknown $value 値
	 * @param string $isEmpty $valueが空文字列でも条件として使用するかどうか
	 *                trueの場合、空文字列でも検索条件として使用する
	 *                それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function ge($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName >= "=>$value);
	}

	/**
	 * 検索条件 > を生成
	 *
	 * @param string $columnName
	 *        	カラム名
	 * @param unknown $value
	 *        	値
	 * @param string $isEmpty
	 *        	$valueが空文字列でも条件として使用するかどうか
	 *        	trueの場合、空文字列でも検索条件として使用する
	 *        	それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function gt($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName > " => $value);
	}

	/**
	 * 検索条件 like 'string%' を生成
	 *
	 * @param string $columnName
	 *        	カラム名
	 * @param unknown $value
	 *        	値
	 * @param string $isEmpty
	 *        	$valueが空文字列でも条件として使用するかどうか
	 *        	trueの場合、空文字列でも検索条件として使用する
	 *        	それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function likeBegin($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName" . ' like' => $value . '%');
	}

	/**
	 * 検索条件 like '%string' を生成
	 *
	 * @param string $columnName
	 *        	カラム名
	 * @param unknown $value
	 *        	値
	 * @param string $isEmpty
	 *        	$valueが空文字列でも条件として使用するかどうか
	 *        	trueの場合、空文字列でも検索条件として使用する
	 *        	それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function likeEnd($columnName, $value, $flg = false) {
		if (!is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName" . ' like' => '%' . $value);
	}

	/**
	 * 検索条件 like '%string%' を生成
	 *
	 * @param string $columnName
	 *        	カラム名
	 * @param unknown $value
	 *        	値
	 * @param string $isEmpty
	 *        	$valueが空文字列でも条件として使用するかどうか
	 *        	trueの場合、空文字列でも検索条件として使用する
	 *        	それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function likeContain($columnName, $value, $flg = false) {
		if (! is_null($flg) || $flg == true) {
			if (is_null($value) || $value == '') {
				return null;
			}
		}
		return array("$columnName" . ' like' => '%' . $value . '%');
	}

	/**
	 * 検索条件 in($values) を生成
	 *
	 * @param string $columnName
	 *        	カラム名
	 * @param unknown $values
	 *        	配列値
	 * @param string $isEmpty
	 *        	$valueが空文字列でも条件として使用するかどうか
	 *        	trueの場合、空文字列でも検索条件として使用する
	 *        	それ以外は空文字列の場合は検索条件として使用しない
	 */
	protected function in($columnName, $values, $flg = false) {
		if (is_null($values)) {
			return;
		}
		if (!is_array($values) || count($values) == 0) {
			return null;
		}
		$params = array ();
		foreach ($values as $value) {
			if (is_null($value) || $value == '') {
				continue;
			}
			array_push($params, $value);
		}
		if (count($params) == 0) {
			return null;
		}
		return array("$columnName". " IN" => $params);
	}
}
