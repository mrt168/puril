<?php
namespace App\Vendor\Convertor;

use App\Vendor\Code\CodePattern;
use App\Vendor\StringUtil;
use App\Vendor\Crypt;

class ConvertValue {
	public $src;
	public function __construct(&$src) {
		$this->src = &$src;
	}

	/**
	 * コード変換コンバータ.
	 *
	 * @param unknown $codeClass
	 *        	変換に使用するコードクラス
	 * @param string $convetPattern
	 *        	コードの変換パターン
	 * @param string $propertyNames
	 *        	コンバート対象のプロパティ名の配列
	 */
	public function codeConverter($codeClass, $convetPattern, $propertyNames) {
		$this->findCodeConvertPropery ( null, $this->src, $codeClass, $convetPattern, $propertyNames );
		return $this;
	}

	/**
	 * 引数に指定されたデータの中からプロパティ変数を探す.
	 *
	 * @param $modelKey コンバート対象となるデータのキー名
	 * @param $modelValue コンバート対象となるデータ
	 * @param $codeClass コンバートコードクラス
	 * @param string $convetPattern
	 *        	コードの変換パターン
	 * @param string $propertyNames
	 *        	コンバート対象のプロパティ名の配列
	 */
	private function findCodeConvertPropery($modelKey, &$modelValue, $codeClass, $convetPattern, $propertyNames) {
		if (is_array ( $modelValue )) {
			foreach ( $modelValue as $key => &$value ) {
				$this->findCodeConvertPropery ( $key, $value, $codeClass, $convetPattern, $propertyNames );
			}
		} else {
			if (is_array ( $propertyNames )) {
				foreach ( $propertyNames as $propertyName ) {
					$this->codeConvert ( $codeClass, $convetPattern, $modelKey, $modelValue, $propertyName );
				}
			} else {
				$this->codeConvert ( $codeClass, $convetPattern, $modelKey, $modelValue, $propertyNames );
			}
		}
	}
	private function codeConvert($codeClass, $convetPattern, $modelKey, &$modelValue, $propertyName) {
		if ($modelKey === $propertyName) {
			if ($convetPattern === CodePattern::$CODE) {
				$codeClassProps = get_class_vars ( $codeClass );
				foreach ( $codeClassProps as $codeClassProp ) {
					if (! StringUtil::isEmpty ( $modelValue )) {
						if ($codeClassProp [CodePattern::$VALUE] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if (isset ( $codeClassProp [CodePattern::$VALUE2] ) && $codeClassProp [CodePattern::$VALUE2] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if (isset ( $codeClassProp [CodePattern::$VALUE3] ) && $codeClassProp [CodePattern::$VALUE3] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						}
					}
				}
			} else if ($convetPattern === CodePattern::$VALUE) {
				$codeClassProps = get_class_vars ( $codeClass );
				foreach ( $codeClassProps as $codeClassProp ) {
					if (! StringUtil::isEmpty ( $modelValue )) {
						if ($codeClassProp [CodePattern::$CODE] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if (isset ( $codeClassProp [CodePattern::$VALUE2] ) && $codeClassProp [CodePattern::$VALUE2] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if (isset ( $codeClassProp [CodePattern::$VALUE3] ) && $codeClassProp [CodePattern::$VALUE3] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						}
					}
				}
			} else if ($convetPattern === CodePattern::$VALUE2) {
				$codeClassProps = get_class_vars ( $codeClass );
				foreach ( $codeClassProps as $codeClassProp ) {
					if (! StringUtil::isEmpty ( $modelValue )) {
						if ($codeClassProp [CodePattern::$CODE] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if ($codeClassProp [CodePattern::$VALUE] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if (isset ( $codeClassProp [CodePattern::$VALUE3] ) && $codeClassProp [CodePattern::$VALUE3] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						}
					}
				}
			} else if ($convetPattern === CodePattern::$VALUE3) {
				$codeClassProps = get_class_vars ( $codeClass );
				foreach ( $codeClassProps as $codeClassProp ) {
					if (! StringUtil::isEmpty ( $modelValue )) {
						if ($codeClassProp [CodePattern::$CODE] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if ($codeClassProp [CodePattern::$VALUE] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						} else if (isset ( $codeClassProp [CodePattern::$VALUE2] ) && $codeClassProp [CodePattern::$VALUE2] == $modelValue) {
							$modelValue = $codeClassProp [$convetPattern];
						}
					}
				}
			}
		}
	}

	/**
	 * 暗号化(encrypt)コンバータ.
	 */
	public function encryptConverter($encryptKey, $propertyNames, $isStatic = false) {
		$this->findEncryptConvertValue ( null, $this->src, $encryptKey, $propertyNames, $isStatic );
		return $this;
	}

	/**
	 * 暗号化(encrypt)コンバータ用.
	 */
	private function findEncryptConvertValue($modelKey, &$modelValue, $encryptKey, $propertyNames, $isStatic) {
		if (is_array ( $modelValue )) {
			foreach ( $modelValue as $key => &$value ) {
				$this->findEncryptConvertValue ( $key, $value, $encryptKey, $propertyNames, $isStatic );
			}
		} else {
			if (is_array ( $propertyNames )) {
				foreach ( $propertyNames as $propertyName ) {
					$this->encryptConvert ( $modelKey, $modelValue, $encryptKey, $propertyName, $isStatic );
				}
			} else {
				$this->encryptConvert ( $modelKey, $modelValue, $encryptKey, $propertyNames, $isStatic );
			}
		}
	}

	/**
	 * 暗号化(encrypt)コンバータ用.
	 */
	private function encryptConvert($modelKey, &$modelValue, $encryptKey, $propertyName, $isStatic) {
		if ($modelKey == $propertyName && ! StringUtil::isEmpty ( $modelValue )) {
			$modelValue = Crypt::encrypt ( $modelValue, $encryptKey, $isStatic );
		}
	}

	/**
	 * 暗号化(decrypt)コンバータ.
	 */
	public function decryptConverter($decryptKey, $propertyNames) {
		$this->findDecryptConvertValue ( null, $this->src, $decryptKey, $propertyNames );
		return $this;
	}

	/**
	 * 暗号化(decrypt)コンバータ用.
	 */
	private function findDecryptConvertValue($modelKey, &$modelValue, $decryptKey, $propertyNames) {
		if (is_array ( $modelValue )) {
			foreach ( $modelValue as $key => &$value ) {
				$this->findDecryptConvertValue ( $key, $value, $decryptKey, $propertyNames );
			}
		} else {
			if (is_array ( $propertyNames )) {
				foreach ( $propertyNames as $propertyName ) {
					$this->decryptConvert ( $modelKey, $modelValue, $decryptKey, $propertyName );
				}
			} else {
				$this->decryptConvert ( $modelKey, $modelValue, $decryptKey, $propertyNames );
			}
		}
	}

	/**
	 * 暗号化(decrypt)コンバータ用.
	 */
	private function decryptConvert($modelKey, &$modelValue, $decryptKey, $propertyName) {
		if ($modelKey == $propertyName && ! StringUtil::isEmpty ( $modelValue )) {
			$modelValue = Crypt::decrypt ( $modelValue, $decryptKey );
		}
	}

	/**
	 * Hash化コンバータ.
	 */
	public function hashConverter($propertyNames) {
		$this->findHashConvertValue ( null, $this->src, $propertyNames );
		return $this;
	}

	/**
	 * Hash化コンバータ用.
	 */
	private function findHashConvertValue($modelKey, &$modelValue, $propertyNames) {

		if (is_array ( $modelValue )) {
			foreach ( $modelValue as $key => &$value ) {
				$this->findHashConvertValue ( $key, $value, $propertyNames );
			}
		} else {
			if (is_array ( $propertyNames )) {
				foreach ( $propertyNames as $propertyName ) {
					$this->hashConvert ( $modelKey, $modelValue, $propertyName );
				}
			} else {
				$this->hashConvert ( $modelKey, $modelValue, $propertyNames );
			}
		}
	}

	/**
	 * Hash化コンバータ用.
	 */
	private function hashConvert($modelKey, &$modelValue, $propertyName) {
		if ($modelKey == $propertyName && ! StringUtil::isEmpty ( $modelValue )) {
			$modelValue = Crypt::hash ( $modelValue );
		}
	}

	/**
	 * 日付フォーマットコンバータ.
	 */
	public function dateConverter($format, $propertyNames) {
		$this->findDateConvertValue ( null, $this->src, $format, $propertyNames );
		return $this;
	}

	/**
	 * 日付フォーマットコンバータ用.
	 */
	private function findDateConvertValue($modelKey, &$modelValue, $format, $propertyNames) {
		if (is_array ( $modelValue )) {
			foreach ( $modelValue as $key => &$value ) {
				if (is_numeric ( $key )) {
					// 数字の場合
					$key = $modelKey;
				}
				$this->findDateConvertValue ( $key, $value, $format, $propertyNames );
			}
		} else {
			if (is_array ( $propertyNames )) {
				foreach ( $propertyNames as $propertyName ) {
					$this->dateConvert ( $modelKey, $modelValue, $format, $propertyName );
				}
			} else {
				$this->dateConvert ( $modelKey, $modelValue, $format, $propertyNames );
			}
		}
	}

	/**
	 * 日付フォーマットコンバータ用.
	 */
	private function dateConvert($modelKey, &$modelValue, $format, $propertyName) {
		if ($modelKey == $propertyName && ! StringUtil::isEmpty ( $modelValue )) {
			$modelValue = date ( $format, strtotime ( $modelValue ) );
		}
	}

	/**
	 * ３桁区切りのカンマ追加コンバータ.
	 */
	public function addCommaConverter($propertyNames, $format = null) {
		$this->findAddCommaConvertValue ( null, $this->src, $propertyNames, $format );
		return $this;
	}

	/**
	 * ３桁区切りのカンマ追加コンバータ用.
	 */
	private function findAddCommaConvertValue($modelKey, &$modelValue, $propertyNames, $format) {
		if (is_array ( $modelValue )) {
			foreach ( $modelValue as $key => &$value ) {
				$this->findAddCommaConvertValue ( $key, $value, $propertyNames, $format );
			}
		} else {
			if (is_array ( $propertyNames )) {
				foreach ( $propertyNames as $propertyName ) {
					$this->addCommaConvert ( $modelKey, $modelValue, $propertyName, $format );
				}
			} else {
				$this->addCommaConvert ( $modelKey, $modelValue, $propertyNames, $format );
			}
		}
	}

	/**
	 * ３桁区切りのカンマ追加コンバータ用.
	 */
	private function addCommaConvert($modelKey, &$modelValue, $propertyName, $format) {
		if ($modelKey == $propertyName && ! StringUtil::isEmpty ( $modelValue )) {
			$modelValue = number_format ( $modelValue, $format );
		}
	}

	/**
	 * ３桁区切りのカンマを削除するコンバータ.
	 */
	public function removeCommaConverter($propertyNames) {
		$this->findRemoveCommaConvertValue ( null, $this->src, $propertyNames );
		return $this;
	}

	/**
	 * ３桁区切りのカンマを削除するコンバータ用.
	 */
	private function findRemoveCommaConvertValue($modelKey, &$modelValue, $propertyNames) {
		if (is_array ( $modelValue )) {
			foreach ( $modelValue as $key => &$value ) {
				$this->findRemoveCommaConvertValue ( $key, $value, $propertyNames );
			}
		} else {
			if (is_array ( $propertyNames )) {
				foreach ( $propertyNames as $propertyName ) {
					$this->removeCommaConvert ( $modelKey, $modelValue, $propertyName );
				}
			} else {
				$this->removeCommaConvert ( $modelKey, $modelValue, $propertyNames );
			}
		}
	}

	/**
	 * ３桁区切りのカンマを削除するコンバータ用.
	 */
	private function removeCommaConvert($modelKey, &$modelValue, $propertyName) {
		if ($modelKey == $propertyName && ! StringUtil::isEmpty ( $modelValue )) {
			$modelValue = str_replace ( ',', '', $modelValue );
		}
	}
}
?>