<?php
/**
 * ModelとRequestされてきたパラメータのマッピング.
 *
 * @memo key=> カラム名  value=>Requestパラメータ名
 */
namespace App\Vendor;

class RequestMapping {

	public static function getDecryptParamter() {
		return array(
				"terminal_number"
			);
	}

	public static function getProfile() {
		return array(
				'terminal_number'=> "terminal_number"
		);
	}

	public static function getMydata() {
		return array(
				'user_id'=> "user_id"
		);
	}

	public static function getUser() {
		return array(
				'terminal_number'=> "terminal_number"
				,'nickname'=> "nickname"
				,'age'=> "age"
				,'sex'=> "gender"
			);
	}

	public static function getEditUser() {
		return array(
				'user_id'=> "user_id"
				,'nickname'=> "nickname"
				,'message'=> "message"
		);
	}

	public static function getEditId() {
		return array(
				'user_id'=> "user_id"
		);
	}

	public static function geSearchFriend() {
		return array(
				'user_id'=> "user_id"
				,'uxtime'=> "uxtime"
				,'order'=> "order"
				,'sex'=> "gender"
				,'from_age'=> "from_age"
				,'to_age'=> "to_age"
				,'photo'=> "photo"
				,'purpose'=> "purpose"
		);
	}

	public static function geTimeline() {
		return array(
				'user_id'=> "user_id"
				,'uxtime'=> "uxtime"
		);
	}

	public static function getPostTimeline() {
		return array(
				'user_id'=> "user_id"
				,'message'=> "message"
		);
	}

	public static function getSend() {
		return array(
				'sender'=> "sender"
				,'receiver'=> "receiver"
				,"id_label"=> "sendlabel"
				,'id_value'=> "sendid"
				,'message'=> "message"
		);
	}

	public static function getNotifications() {
		return array(
				'user_id'=> "user_id"
				,'uxtime'=> "uxtime"
				,'order'=> "order"
		);
	}

	public static function getReceive() {
		return array(
				'user_id'=> "user_id"
				,'send_id'=> "recid"
		);
	}

	public static function getPurchase() {
		return array(
				'user_id'=> "user_id"
				,'purchase'=> "purchase"
		);
	}
}