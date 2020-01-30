<?php
namespace App\Shell;

use Cake\Console\Shell;
use Mail_mimeDecode;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\ContactStatus;
use App\Vendor\Code\CodePattern;

class ReceiveMailShell extends Shell {

	public function main() {
		$this->log('【メール受信処理開始】', 'debug');

		$this->receiveMail();

		$this->log('【メール受信処理終了】', 'debug');

	}

	function receiveMail() {
		try {
			$mail = "";
			$image_filename = "";
			$to = array ();
			$headers = array ();

			/**
			 * 本番用From
			 */
			$mail = file_get_contents('php://stdin');

			/**
			 * 本番用用To
			 */
			if (empty($mail)) {
				$this->log('【受信メールなし】', 'debug');
				return;
			} else {
				// $this->log($mail, LOG_DEBUG);
			}
			// デコード処理
			// デコード方法の指定
			$params = array ();
			$params['include_bodies'] = true;
			$params['decode_bodies'] = true;
			$params['decode_headers'] = true;
			$params['crlf'] = "\r\n";

			$decoder = new Mail_mimeDecode($mail, "\n");
			$structure = $decoder->decode($params);

// 			$this->log($mail, 'debug');
// 			$this->log("=================================================================================================================================================", 'debug');
// 			$this->log($decoder, 'debug');
// 			$this->log("=================================================================================================================================================", 'debug');
			$this->log($structure, 'debug');

			$from = null;
			$subject = null;
			$body = null;

			// Fromメールアドレス取得
			if (!empty($structure->headers['from'])) {
				$from = preg_replace('/^.*<([^<>]+?)>.*$/', '$1', $structure->headers['from']);
			}

			$isIso = false;
			$isGmail = false;
			$gmailPos = strpos ($from, "@gmail.com");
			if ($gmailPos !== false) {
				$isGmail = true;
			}
			if (!empty($structure->headers ['content-type'])) {
				$contentTypePos = strpos($structure->headers['content-type'], "iso-2022-jp");
				if ($contentTypePos !== false) {
					$isIso = true;
				}
			}

			//　件名取得
// 			$subject = $structure->headers['subject'];
// 			$fromCharcode = mb_detect_encoding($subject, "ISO-2022-JP,UTF-8");
// 			$subject = mb_convert_encoding($subject, "UTF-8", $fromCharcode);

			/**
			if (!empty($structure->headers ['subject'])) {
// 				$subject = mb_convert_encoding($structure->headers['subject'], "UTF-8", "ISO-2022-JP");
				$subject = $structure->headers ['subject'];
				if (!$isGmail) {
					if (!empty($subject)) {
// 						$subject = mb_convert_encoding($subject, "UTF-8", "iso-2022-jp");
						$subject = mb_convert_encoding($subject, "UTF-8", "ISO-2022-JP");
					}
				} else {
					// gmailであってもiPhoneから送信の場合はエンコードが必要
					if (!empty($structure->headers['content-type'])) {
						if ($isIso) {
							$subject = mb_convert_encoding($subject, "UTF-8", $structure->headers['content-type']);
						}
					}
				}
			}
			*/

			//　本文取得
			$encode = "ISO-2022-JP";
			if ($structure->ctype_primary == 'multipart') {
				foreach ($structure->parts as $parts) {
					if ($parts->ctype_primary == 'text' and $parts->ctype_secondary == 'plain') {
						$MailBody = $parts->body;
						if ($parts->ctype_parameters['charset']) {
							$encode = $parts->ctype_parameters['charset'];
						}
						break;
					}
				}
			} else {
				if ($structure->ctype_parameters['charset']) {
					$encode = $structure->ctype_parameters['charset'];
				}
				$MailBody = $structure->body;
			}
			$body = mb_convert_encoding($MailBody, "UTF-8", $encode);


			// 件名取得(エンコード)
			$subject = $structure->headers['subject'];
			$subject = mb_convert_encoding($subject, "UTF-8", $encode);

			// エラーチェック
			$result = $this->error_check($body);
			if (!empty($from) && $result === true) {
				// 問い合わせに登録
				$this->Contact = TableRegistry::get('Contacts');
				$contactData = $this->Contact->newEntity();
				$contactData->mail_address = $from;
				$contactData->subject = $subject;
				$contactData->content = $body;
				$contactData->status = ContactStatus::$UNREAD[CodePattern::$CODE];

				$this->Contact->save($contactData);
			}
		} catch (Exception $e) {
			$this->log('【メール受信失敗】', 'debug');
			$this->log($e->getMessage(), 'debug');
			$this->log('ReceiveMailShell Line:' . $e->getLine(), 'debug');
		}
	}

	/**
	 * エラーチェック
	 */
	private function error_check($body) {
		// エラーメールを判別するように、正規表現を実行します
		$regexps = array (
				'user unknown',
				'host unknown',
				'host not found',
				'system error',
				'failure notice',
				'has been infected with the virus',
				'message size exceeds remaining quota',
				'fragmented emails are not permitted',
				'message could not be delivered for 5 days',
				'returned mail: see transcript for details',
				'undelivered mail returned to sender',
				'554 delivery error'
		);

		$isTrue = true;
		if (!empty($body)) {
			foreach ($regexps as $regexp) {
				$pattern = '/' . $regexp . '/i';
				if (preg_match($pattern, $body)) {
					$isTrue = false;
				}
			}
		}

		if ($isTrue === false) {
			return false;
		}

		return $isTrue;
	}
	public function getMail($cnt, &$mail) {
		// 標準入力から受け取ったメールを取得
		while ($row = $this->stdin->read()) {
			$row = trim($row);
			if (empty($row)) {
				break;
			}
			$mail .= $row . "\r\n";
			$cnt = 0;
		}
		if ($cnt < 2) {
			// ヘッダーと本文の間に改行が入ったり、本文に空白行があるので２行以上空くまで続ける.
			$mail .= "\r\n";
			$this->getMail ( $cnt + 1, $mail );
		}
	}
}