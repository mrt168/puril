<?php
namespace App\Vendor;

use ReflectionClass;

class AnnotationReader {
	/**
	 * ReflectionClass
	 * @var ReflectionClass
	 */
	private $clazz;

	public function __construct($name) {
		$this->clazz = new ReflectionClass($name);
	}
	public function getClassAnnotation() {
		$comment = $this->getDocComment($this->clazz->getDocComment());
		return $this->getAnnotation($comment);
	}

	public function getMethodAnnotation($name) {
		$method = $this->clazz->getMethod($name);
		$comment = $this->getDocComment($method->getDocComment());
		return $this->getAnnotation($comment);
	}

	public function getFieldAnnotation($name) {
		$field = $this->clazz->getProperty($name);
		$comment = $this->getDocComment($field->getDocComment());
		return $this->getAnnotation($comment);
	}

	private function getDocComment($docComment) {
		return preg_split("/[\n\r]/", $docComment, -1, PREG_SPLIT_NO_EMPTY);
	}

	private function getAnnotation($comments) {
		$returnValues = array();
		foreach ($comments as $line) {
			$line = $this->_removeCommentSlashAster($line);
			if (preg_match("/^@\w+$/",$line) || preg_match("/^@\w+\s*\(/",$line)) {
				array_push($returnValues, $line);
			}
		}
		return $returnValues;
	}
	private function _removeCommentSlashAster($line) {
		$line = trim($line);
		$line = preg_replace("/^\/\*\*/","",$line);
		$line = preg_replace("/\*\/$/","",$line);
		$line = preg_replace("/^\*/","",$line);
		return trim($line);
	}

	public function getClickUrl($methodName) {
		$annos = $this->getMethodAnnotation($methodName);
		$regex = '@click_url(';
		foreach ($annos as $anno) {
			if (strpos($anno, $regex) !== false) {
				$str = str_replace($regex, '', $anno);
				return str_replace(')', '', $str);
			}
		}
		return null;
	}

	public function getNoUpdateSession($methodName) {
		$annos = $this->getMethodAnnotation($methodName);
		$regex = '@no_update_session(';
		foreach ($annos as $anno) {
			if (strpos($anno, $regex) !== false) {
				$str = str_replace($regex, '', $anno);
				return str_replace(')', '', $str);
			}
		}
		return null;
	}
}