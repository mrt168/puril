<?php
namespace App\Vendor\Code;

abstract class AAbstractCode {
	public static function valueOf() {
		$reflect = new \ReflectionClass ( get_called_class () );

		$properties = $reflect->getProperties ();
		$vals = array ();
		foreach ( $properties as $property ) {
			array_push ( $vals, $property->getValue () );
		}
		return $vals;
	}
	public static function convert($val, $codePattern) {
		if (empty ( $val )) {
			return $val;
		}
		$reflect = new \ReflectionClass ( get_called_class () );
		$properties = $reflect->getProperties ();
		$codePatterns = CodePattern::valueOf ();

		foreach ( $properties as $property ) {
			$prop = $property->getValue ();
			foreach ( $codePatterns as $code ) {
				if ($code == $codePattern) {
					continue;
				}
				if (isset ( $prop [$code] ) && $val == $prop [$code]) {
					return $prop [$codePattern];
				}
			}
		}
		return $val;
	}
	public static function toString($simple = false) {
		if ($simple) {
			return (new \ReflectionClass(get_called_class()))->getShortName();
		} else {
			return get_called_class();
		}
	}
}