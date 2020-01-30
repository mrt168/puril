<?php
namespace App\Controller\Front;

use App\Vendor\SiteInfo;
use App\Controller\Front\FrontAppController;
use App\Vendor\Layout;
use Cake\Mailer\MailerAwareTrait;
use App\Vendor\Convertor\ConvertItems;
use App\Vendor\Code\ContactType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\Pref;
use App\Vendor\ValidationUtil;
use Cake\Event\Event;

/**
 * お問合せ.
 */
class ContactsController extends FrontAppController {

	public $uses = false;

	use MailerAwareTrait;

	const CONTACT_PAGE = 'contact';
	const CONTACT_USER_PAGE = 'contact_user';
	const THANKS_PAGE = 'thanks';

	public function beforeFilter(Event $event) {
// 		parent::initialize();
	}

	/**
	 * 施設情報掲載のお問い合わせ
	 */
	public function sendContact() {
		$data = $this->request->data;

		if (!preg_match(ValidationUtil::CHECK_EMAIL, $data['mail'])) {

			$this->Flash->set("メールアドレスが正しくありません");
			$this->contact();
			return ;
		}

		$this->getMailer('Contact')->send('contact', [$data]);
		// リメール
		$this->getMailer('Contact')->send('remail', [$data]);

		$this->redirect(['controller'=> 'contacts', 'action'=> 'contactThanks']);
		return ;
	}

	/**
	 * ユーザーレビューのお問い合わせ
	 */
	public function sendContactUser() {
		$data = $this->request->data;

		if (!preg_match(ValidationUtil::CHECK_EMAIL, $data['mail'])) {

			$this->Flash->set("メールアドレスが正しくありません");
			$this->contactUser();
			return ;
		}

		ConvertItems::convertValue($data)
			->codeConverter(ContactType::toString(), CodePattern::$VALUE, "type")
			->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, "question1")
			->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, "question2")
			->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, "question3")
			->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, "question4")
			->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, "question5")
			->codeConverter(Satisfaction::toString(), CodePattern::$VALUE, "question6")
			->codeConverter(Sex::toString(), CodePattern::$VALUE, "sex");

		$this->getMailer('Contact')->send('contactUser', [$data]);
		// リメール
		$this->getMailer('Contact')->send('remail', [$data]);

		$this->redirect(['controller'=> 'contacts', 'action'=> 'contactUserThanks']);
		return ;
	}

	public function contact() {
$this->set('noIndex', true);
		parent::move(SiteInfo::$CONTACT, Layout::USER_LAYOUT, self::CONTACT_PAGE);
	}

	public function contactUser() {
$this->set('noIndex', true);
		parent::move(SiteInfo::$CONTACT_USER, Layout::USER_LAYOUT, self::CONTACT_USER_PAGE);
	}

	/**
	 * 予約フォームの送信を受けるメソッド
	 */
	public function reserve() {
		$data = $this->request->data;

		if (!preg_match(ValidationUtil::CHECK_EMAIL, $data['mail'])) {
			$this->Flash->set("メールアドレスが正しくありません");
	        $this->redirect($this->referer('/shop/detail'));
	        return;
		}

		$data['sex'] = $data['sex'] === '1' ? '男性' : '女性';

		$depilationSiteTable = TableRegistry::get('DepilationSites');
		$datas = $depilationSiteTable->findByDelFlgOrderById();
		$options = $this->getKeyValueByDBData($datas, 'depilation_site_id', 'name');

		foreach ($data['depilation_site'] as $i => $depilation_site_id) {
			$data['depilation_site'][$i] = $options[$depilation_site_id];
		}

        // 店舗予約URL（すぐにどの店舗か追えるようにするため）
        $data['referer'] = $this->referer();

		$this->getMailer('Contact')->send('reserve', [$data]);
		$this->redirect(['action'=> 'reserveThanks']);
		return;
	}

	/**
	 * サンクスページ
	 */
	public function contactThanks() {
		// 地域別都道府県
		$prefTable = TableRegistry::get('PrefDatas');
		$prefDatas = $prefTable->find('all');
		$regionPrefs = Pref::getRegionOptions();
		foreach ($regionPrefs as $region => $pref) {
			foreach ($pref as $prefCode => $value) {
				foreach ($prefDatas as $prefData) {
					if($prefData['pref'] == $prefCode) {
						$regionPrefs[$region][$prefCode] = $prefData['url_text'];
					}
				}
			}
		}

		$this->set('regionPrefs', $regionPrefs);

		parent::move(SiteInfo::$CONTACT_TAHNKS, Layout::USER_LAYOUT, self::THANKS_PAGE);
	}
	public function contactUserThanks() {
		// 地域別都道府県
		$prefTable = TableRegistry::get('PrefDatas');
		$prefDatas = $prefTable->find('all');
		$regionPrefs = Pref::getRegionOptions();
		foreach ($regionPrefs as $region => $pref) {
			foreach ($pref as $prefCode => $value) {
				foreach ($prefDatas as $prefData) {
					if($prefData['pref'] == $prefCode) {
						$regionPrefs[$region][$prefCode] = $prefData['url_text'];
					}
				}
			}
		}

		$this->set('regionPrefs', $regionPrefs);

		parent::move(SiteInfo::$CONTACT_TAHNKS, Layout::USER_LAYOUT, self::THANKS_PAGE);
	}

	public function reserveThanks() {
		// 地域別都道府県
		$prefTable = TableRegistry::get('PrefDatas');
		$prefDatas = $prefTable->find('all');
		$regionPrefs = Pref::getRegionOptions();
		foreach ($regionPrefs as $region => $pref) {
			foreach ($pref as $prefCode => $value) {
				foreach ($prefDatas as $prefData) {
					if($prefData['pref'] == $prefCode) {
						$regionPrefs[$region][$prefCode] = $prefData['url_text'];
					}
				}
			}
		}

		$this->set('regionPrefs', $regionPrefs);
        $this->set('noindex', true);

		parent::move(SiteInfo::$CONTACT_TAHNKS, Layout::USER_LAYOUT, 'reserve_'.self::THANKS_PAGE);
	}

	private function getKeyValueByDBData($datas, $keyName, $valueName) {
		$array = array ();
		foreach ($datas as $data) {
			$setKey = null;
			$setValue = null;
			foreach ($data->toArray() as $key => $value) {
				if ($key == $keyName) {
					$setKey = $value;
				} else if ($key == $valueName) {
					$setValue = $value;
				}
				if ($key != null && $setValue != null) {
					break;
				}
			}
			if ($setKey != null && $setValue != null) {
				$array[$setKey] = $setValue;
			}
		}

		return $array;
	}
}
