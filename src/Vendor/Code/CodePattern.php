<?php
namespace App\Vendor\Code;

class CodePattern {
	public static $CODE = 'code';
	public static $VALUE = 'value';
	public static $VALUE2 = 'value2';
	public static $VALUE3 = 'value3';
	public static function valueOf() {
		$reflect = new \ReflectionClass ( __CLASS__ );

		$properties = $reflect->getProperties ();
		$vals = array ();
		foreach ( $properties as $property ) {
			array_push ( $vals, $property->getValue () );
		}
		return $vals;
	}
}
?>