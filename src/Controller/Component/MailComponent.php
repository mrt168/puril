<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Mailer\Email;

const CONFIF_DEFAULT = "default";

/**
 * メール　コンポーネント
 */
class MailComponent extends Component {

	public static function send_mail($configs = array()) {
		set_time_limit(0);

		$mail = new Email();
		if (empty($configs['config'])) {
			$mail->setProfile(self::CONFIF_DEFAULT);
		} else {
			$mail->setProfile($configs['config']);
		}

		try {

			// 送信先
			if (!empty($configs['to'])) {
				$mail->setTo($configs['to']);
			}

			// 件名
			if (!empty($configs['subject'])) {
				$mail->setSubject($configs['subject']);
			}

			// 送信(本文)
			if(!$mail->send($configs['content'])){
				return 'メールの送信に失敗しました。';
			}
		} catch (Exception $e) {
			return $e->getMessage();
		}

		return true;
	}
}