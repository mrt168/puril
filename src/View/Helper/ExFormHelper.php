<?php
namespace App\View\Helper;

use Cake\View\Helper\FormHelper;
use App\Vendor\Code\CodePattern;
use Cake\ORM\TableRegistry;
use function Cake\ORM\toArray;
use App\Vendor\Code\Pref;
use App\Vendor\Code\ShowFlg;
use App\Vendor\Code\Sex;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\OtherConditionType;
use Cake\Routing\Router;
use App\Vendor\Code\JapaneseSyllabary;
use App\Vendor\URLUtil;
use App\Vendor\Code\ContactType;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;
use App\Vendor\Code\DepilationType;
use App\Vendor\Code\Alphabet;

class ExFormHelper extends FormHelper {

	/**
	 * 指定されたｺｰﾄﾞクラスの値を取得.
	 *
	 * @param $value 対象の値
	 * @param $codeClassName Vendor/Code内のクラス名
	 * @param $codePattern 取得したいコードパターン
	 */
	public function getVendorCode($value, $codeClassName, $codePattern) {
		$vars = get_class_vars ( $codeClassName );
		$array = array ();
		foreach ( $vars as $var ) {
			if ($codePattern == CodePattern::$CODE) {
				$code = $var [CodePattern::$VALUE];
				if ($code == $value) {
					return $var [CodePattern::$CODE];
				}
			} else {
				$code = $var [CodePattern::$CODE];
				if ($code == $value) {
					return $var [CodePattern::$VALUE];
				}
			}
		}
		return '';
	}

	/**
	 * 画像位置タイプ
	 */
	public function imagePositionType($name, $array = array()) {
		return $this->makeHTML(ImagePositionType::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 店舗画像タイプ
	 */
	public function imageType($name, $array = array()) {
		return $this->makeHTML(ImageType::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 年齢
	 */
	public function age($name, $array = array()) {
		$min = 16;
		$max = 64;
		$values = [];
		for ($i = $min; $i <= $max; $i++) {
			if ($i === $min) {
				$values[$i - 1] = sprintf('%s歳未満', $min - 1);
			}

			$values[$i] = $i."歳";

			if ($i === $max) {
				$values[$i + 1] = sprintf('%s歳以上', $max  + 1);
			}
		}
		return $this->select($name, $values, $array);
	}

	/**
	 * 評価
	 */
	public function evaluation($name, $array = array('default'=> 3.0)) {
		$starValues = [];
		$star = 0.0;
		while ($star <= 5) {
			$starValues[(string) $star] = (string) number_format($star, 1);
			$star += 0.5;
		}
		return $this->select($name, $starValues, $array);
	}

	/**
	 * お問い合わせ種別
	 */
	public function contactType($name, $array = array()) {
		return $this->makeHTML(ContactType::toString (), $name, $array);
	}

	/**
	 * 都道府県ごとの駅
	 */
	public function station($name, $prefCode, $array = []) {
		$stationTable = TableRegistry::get('Stations');
		$stations = $stationTable->findByPref($prefCode);

		$array['type'] = 'select';
		$array['multiple'] = 'checkbox';
		$array['label'] = false;
		$array['hiddenField'] = false;
		$array['escape'] = false;

		$options = [];
		foreach ($stations as $station) {

			//	0件は非表示
			if ($station['cnt'] <= 0) {
				continue;
			}

			$options[$station['station_g_cd']] = "{$station['station_name']}駅";
		}
		$array['options'] = $options;
		return parent::control($name, $array);
	}

	/**
	 * 市区町村.
	 */
	public function cityLink($name, $prefCode, $array = [], $isLink = true, $baseUrl = null) {
		$areaTable = TableRegistry::get('Areas');
		$prefTable = TableRegistry::get('PrefDatas');
// 		$areas = $areaTable->findByPref($prefCode);
// 		$prefData = $prefTable->findByPref($prefCode);

		$array['type'] = 'select';
		$array['multiple'] = 'checkbox';
		$array['label'] = false;
		$array['div'] = false;
		$array['hiddenField'] = false;
		$array['escape'] = false;

		$isRanking = false;
		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		} else if ($baseUrl == URLUtil::RANKING){
			$isRanking = true;
		}

		$areas = $areaTable->findByPref($prefCode, $isRanking);
		$prefData = $prefTable->findByPref($prefCode);

		$urls = explode($baseUrl, urldecode(Router::url(null, true)));
		if (!empty($this->request->getQuery())) {
			$urls[1] = $urls[1]. "/";
		}

		$bun = $urls[1];
		$start = mb_strpos($urls[1], $prefData['url_text']);
		$para = mb_substr($urls[1], $start);
		$end = mb_strpos($para,'/');
		$para = mb_substr($para, $end);

		$options = [];
		foreach ($areas as $area) {
			//	0件は非表示
			if ($area['cnt'] <= 0) {
				continue;
			}

			if (!empty($urls[1])) {

				$shopType = "";
				if(strpos($urls[1], ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]) !== false){
					$shopType = "/". ShopType::$DEPILATION_SALON[CodePattern::$VALUE2];
					if (strpos($urls[1], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]) !== false) {
						$shopType .= "/". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2];
					}
				} else if (strpos($urls[1], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]) !== false) {
					$shopType = "/". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2];
				}

				$params = explode('/', $urls[1]);
				if (preg_grep("/^".URLUtil::CITY. "/", $params)) {
					$city = preg_grep("/^".URLUtil::CITY. "/", $params);

					if (!in_array(URLUtil::CITY. $area['area_id'], $city)) {
						array_push($city, URLUtil::CITY. $area['area_id']);
					}

					foreach ($city as $c) {
						$para = str_replace($c."/", "", $para);
					}

					natsort($city);
					$url = $shopType. "/". $prefData['url_text']. "/".implode("/", $city). $para;
				} else {
					$url = $shopType. "/". $prefData['url_text']. "/". URLUtil::CITY. $area['area_id']. $para;
				}

				$url = $urls[0]. $baseUrl. $url;

// 				$url = str_replace(URLUtil::CITY. $area['area_id']."/", "", $urls[1]);
// 				$url = $urls[0]. $baseUrl. $url. URLUtil::CITY. $area['area_id'];
			} else {
				$url = Router::url("/{$baseUrl}/{$prefData['url_text']}/". URLUtil::CITY. $area['area_id']);
			}

			if ($isLink) {
				$options[$area['area_id']] = "<a href='{$url}'>{$area['name']}</a>";
			} else {
				$options[$area['area_id']] = $area['name'];
			}
		}

		$array['options'] = $options;

		return parent::control($name, $array);

	}

	/**
	 * 市区町村.
	 */
	public function city($name, $prefCode, $array = array()) {
		$areaTable = TableRegistry::get('Areas');
		$datas = $areaTable->findByPref($prefCode);
		$options = $this->getKeyValueByDBData($datas, 'area_id', 'name');

		return $this->make($options, $name, $array);
	}

	/**
	 * 地域別都道府県.
	 */
	public function byRegion($name, $array = [], $isLink = true, $baseUrl = null) {
		$datas = Pref::getRegionOptions();
		$array['type'] = 'select';
		$array['multiple'] = 'checkbox';
		$array['label'] = false;
		$array['hiddenField'] = false;
		$array['escape'] = false;

		$array['templates'] = [
				'nestingLabel' => '{{input}}{{text}}',
				'checkboxWrapper' => '<li>{{label}}</li>'
		];

		$isRanking = false;
		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		} else if ($baseUrl == URLUtil::RANKING) {
			$isRanking = true;
		}

		$i=0;
		$prefTable = TableRegistry::get('prefDatas');
		foreach ($datas as $region => $data) {

			// 地域名
			echo "<div class='area_tit'>{$region}</div>";
			echo "<ul class='cf'>";

			$urls = explode($baseUrl, urldecode(Router::url(null, true)));
			if (!empty($this->request->getQuery())) {
				$urls[1] = $urls[1]. "/";
			}

			foreach ($data as $prefCode => $prefName) {
				$prefData = $prefTable->findByPref($prefCode);

				if (!empty($urls[1])) {

					$shopType = "";
					$para = "";

					if(strpos($urls[1], ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]) !== false){

						$para = str_replace(ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]."/", "", $urls[1]);
						$shopType = "/". ShopType::$DEPILATION_SALON[CodePattern::$VALUE2];

						if (strpos($urls[1], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]) !== false) {
							$para = str_replace(ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]."/", "", $para);
							$shopType .= "/". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2];
						}
					} else if (strpos($urls[1], ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]) !== false) {
						$para = str_replace(ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]."/", "", $urls[1]);
						$shopType = "/". ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2];
					} else {
						$para = $urls[1];
					}

					$url = $urls[0]. $baseUrl. $shopType. "/". $prefData['url_text']. $para;

// 					$url = str_replace($prefData['url_text']."/", "", $urls[1]);
// 					$url = $urls[0]. $baseUrl. $url. $prefData['url_text'];
				} else {
					$url = Router::url("/{$baseUrl}/{$prefData['url_text']}/");
				}

				if ($isLink) {
					$data[$prefCode] = "<a href='{$url}'>{$prefName}</a>";
				} else {
// 					$data[$prefCode] = $prefName;
					$data[$prefCode] = "<label for='make-pref-{$prefCode}'>". $prefName. "<lable>";
				}
			}
			$array['options'] = $data;
			echo parent::control($name, $array);
			echo "</ul>";
			$i++;
		}
	}

	/**
	 * 店舗タイプ(施設種類).
	 */
	public function shopType($name, $array = array()) {
		return $this->makeHTML(ShopType::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 店舗タイプ(施設種類) フロント検索用.
	 */
	public function shopTypeFront($name, $array = array(), $isLink = true, $baseUrl = null) {
		$datas = ShopType::valueOf();

		$array['type'] = 'select';
		$array['multiple'] = 'checkbox';
		$array['label'] = false;
		$array['hiddenField'] = false;
		$array['escape'] = false;

		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		}

		$urls = explode($baseUrl, urldecode(Router::url(null, true)));
// 		if (!empty($this->request->getQuery())) {
// 			$urls[1] = $urls[1]. "/";
// 		}

		foreach ($datas as $data) {
			$shopTypeValue = $data[CodePattern::$VALUE];;

			if (!empty($urls[1])) {

				$para = str_replace(ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]."/", "", $urls[1]);
				$para = str_replace(ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]."/", "", $para);
				$url = $urls[0].$baseUrl."/".$data[CodePattern::$VALUE2].$para;

// 				$url = str_replace($data[CodePattern::$VALUE2]."/", "", $urls[1]);
// 				$url = $urls[0]. $baseUrl. $url. $data[CodePattern::$VALUE2];
			} else {
				$url = Router::url('/'. $baseUrl. '/'.$data[CodePattern::$VALUE2]). "/";
			}

			if ($isLink) {
				$data['name'] = "<a href='{$url}'>{$shopTypeValue}</a>";
			} else {
				$data['name'] = $shopTypeValue;
			}
			$array['options'] = [$data[CodePattern::$CODE] => $data['name']];

			echo parent::control($name, $array);
		}
	}

	/**
	 * 脱毛対象
	 */
	public function depilationType($name, $array = array()) {
		return $this->makeHTML(DepilationType::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * アルファベット
	 */
	public function alphabet($name, $array = array()) {
		return $this->makeHTML(Alphabet::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 50音
	 */
	public function japaneseSyllabary($name, $array = array()) {
		return $this->makeHTML(JapaneseSyllabary::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * ブランド.
	 */
	public function brand($name, $array = array()) {
		$brandTable = TableRegistry::get('Brands');
		$datas = $brandTable->findByDelFlgOrderByName();
		$options = $this->getKeyValueByDBData($datas, 'brand_id', 'name');

		return $this->make($options, $name, $array);
	}

	/**
	 * 満足度.
	 */
	public function satisfaction($name, $array = array()) {
		return $this->makeHTML(Satisfaction::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 脱毛部位.
	 */
	public function depilationSite($name, $array = array()) {
		$depilationSiteTable = TableRegistry::get('DepilationSites');
		$datas = $depilationSiteTable->findByDelFlgOrderById();
		$options = $this->getKeyValueByDBData($datas, 'depilation_site_id', 'name');

		return $this->make($options, $name, $array);
	}

	/**
	 * 脱毛部位(件数)
	 */
	public function depilationSiteCnt($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
		$dsTable = TableRegistry::get('DepilationSites');
// 		$datas = $dsTable->findByMoreNarrow($searchWheres, $baseUrl);

		$isRanking = false;
		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		} else if ($baseUrl == URLUtil::RANKING) {
			$isRanking = true;
		}

		$datas = $dsTable->findByMoreNarrow($searchWheres, $isRanking);

		$placeUrls = [];
		$this->getPlaceUrl($placeUrls, $searchWheres);

		foreach ($datas as $data) {
			if ($data['cnt'] <= 0) {
				continue;
			}

			$depilationSiteName = $data['name']. "({$data['cnt']})";

			if (empty($placeUrls)) {
				$url = Router::url('/'.$baseUrl .'/'.$data['url_text']);
			} else {
				$url = "/". $baseUrl. "/". $placeUrls. "/". $data['url_text'];
			}

			$array['value'] = $data['depilation_site_id'];
			$array['label'] = false;
			$array['hiddenField'] = false;
			$array['escape'] = false;
			$array['checked'] = false;
			$array['id'] = "depilation_site_{$data['depilation_site_id']}";

			if (!empty($this->request->data['Make']['depilation_site_id'])) {
				foreach ($this->request->data['Make']['depilation_site_id'] as $depilationSiteId) {
					if ($depilationSiteId == $data['depilation_site_id']) {
						$array['checked'] = true;
						break;
					}
				}
			}

			echo "<li>";
			echo parent::checkbox($name, $array);

			$text = null;
			if (!empty($data['description'])) {
				$text = "<span class='description'><a href='javascript:void(0);' class='memo'><img src='".Router::url('/img/icon_q.png')."' alt=''></a><div class='txt'>{$data['description']}</div></span>";
			}

			if ($isLink) {
				echo "<a href='{$url}/'>{$depilationSiteName}</a>". $text;
			} else {
				echo "<label for='depilation_site_{$data['depilation_site_id']}'>".$depilationSiteName. "</lable>". $text;
			}
			echo "</li>";

			if ($data['depilation_site_id'] == 1) {
				echo "<li><a href='javascript:void(0)' class='toggle'>部分脱毛</a></li>";
				echo "</ul>";
				echo "<ul class='cld all_check_wrap cf'>";
			}

		}
	}

    /**
     * 脱毛部位(件数)
     */
    public function depilationSiteSelect($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
        $dsTable = TableRegistry::get('DepilationSites');
// 		$datas = $dsTable->findByMoreNarrow($searchWheres, $baseUrl);

        $isRanking = false;
        if (empty($baseUrl)) {
            $baseUrl = URLUtil::SEARCH;
        } else if ($baseUrl == URLUtil::RANKING) {
            $isRanking = true;
        }

        $datas = $dsTable->findByMoreNarrow($searchWheres, $isRanking);

        $placeUrls = [];
        $this->getPlaceUrl($placeUrls, $searchWheres);

        foreach ($datas as $data) {
            if ($data['cnt'] <= 0) {
                continue;
            }
            ?>

            <option value="<?php echo $data['depilation_site_id'];?>"><?php echo $data['name']?></option>
            <?php

        }
    }

	/**
	 * 支払方法.
	 */
	public function payment($name, $array = array()) {
		$paymentTable = TableRegistry::get('Payments');
		$datas = $paymentTable->findByDelFlgOrderById();
		$options = $this->getKeyValueByDBData($datas, 'payment_id', 'name');

		return $this->make($options, $name, $array);
	}
	/**
	 * 支払方法(件名).
	 */
	public function paymentCnt($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
		$paymentTable = TableRegistry::get('Payments');
// 		$datas = $paymentTable->findByMoreNarrow($searchWheres);

		$isRanking = false;
		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		} else if ($baseUrl == URLUtil::RANKING) {
			$isRanking = true;
		}

		$datas = $paymentTable->findByMoreNarrow($searchWheres, $isRanking);

		$placeUrls = [];
		$this->getPlaceUrl($placeUrls, $searchWheres);

		$isOne = false;
		foreach ($datas as $data) {
			//	0件は非表示
			if ($data['cnt'] <= 0) {
				continue;
			}
			$isOne = true;

			$priceName = $data['name']. "({$data['cnt']})";

			if (empty($placeUrls)) {
				$url = Router::url('/'. $baseUrl. '/'.$data['url_text']);
			} else {
				$url = "/". $baseUrl. "/". $placeUrls. "/". $data['url_text'];
			}

			$text = null;
			if (!empty($data['description'])) {
				$text = "<span class='description'><a href='javascript:void(0);' class='memo'><img src='".Router::url('/img/icon_q.png')."' alt=''></a><div class='txt'>{$data['description']}</div></span>";
			}
			if ($isLink) {
				$data['name'] = "<a href='{$url}/'>{$priceName}</a>";
				$priceName = "<a href='{$url}/'>{$priceName}</a>". $text;
			} else {
				$data['name'] = $priceName;
				$priceName = "<label for='payment_id_{$data['payment_id']}'>". $priceName. "</label>". $text;
			}

			$array['value'] = $data['payment_id'];
			$array['label'] = false;
			$array['hiddenField'] = false;
			$array['escape'] = false;
			$array['checked'] = false;
			$array['id'] = "payment_id_". $data['payment_id'];

			if (!empty($this->request->data['Make']['payment_id'])) {
				foreach ($this->request->data['Make']['payment_id'] as $priceId) {
					if ($priceId == $data['payment_id']) {
						$array['checked'] = true;
						break;
					}
				}
			}
			echo "<li>";
			echo $this->checkbox($name, $array);
			echo $priceName;
			echo "</li>";
		}
		if (!$isOne) {
			echo "条件に一致する施設がありません。";
		}
	}

    /**
     * 支払方法(option).
     */
    public function paymentSelect($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
        $paymentTable = TableRegistry::get('Payments');
        $isRanking = false;
        $datas = $paymentTable->findByMoreNarrow($searchWheres, $isRanking);
        foreach ($datas as $data) {
            //	0件は非表示
            if ($data['cnt'] <= 0) {
                continue;
            }
            echo "<option value='".$data['payment_id']."'>";
            echo  $data['name'];
            echo "</option>";
        }
    }

	/**
	 * 特典・割引.
	 */
	public function discount($name, $array = array()) {
		$discountTable = TableRegistry::get('Discounts');
		$datas = $discountTable->findByDelFlgOrderByid();
		$options = $this->getKeyValueByDBData($datas, 'discount_id', 'name');

		return $this->make($options, $name, $array);
	}
	/**
	 * 特典・割引(件数).
	 */
	public function discountCnt($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
		$discountTable = TableRegistry::get('Discounts');
// 		$datas = $discountTable->findByMoreNarrow($searchWheres);

		$isRanking = false;
		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		} else if ($baseUrl == URLUtil::RANKING) {
			$isRanking = true;
		}

		$datas = $discountTable->findByMoreNarrow($searchWheres, $isRanking);

		$placeUrls = [];
		$this->getPlaceUrl($placeUrls, $searchWheres);

		$isOne = false;
		foreach ($datas as $data) {
			//	0件は非表示
			if ($data['cnt'] <= 0) {
				continue;
			}
			$isOne = true;

			$priceName = $data['name']. "({$data['cnt']})";

			if (empty($placeUrls)) {
				$url = Router::url('/'. $baseUrl. '/'.$data['url_text']);
			} else {
				$url = "/". $baseUrl. "/". $placeUrls. "/". $data['url_text'];
			}

			$text = null;
			if (!empty($data['description'])) {
				$text = "<span class='description'><a href='javascript:void(0);' class='memo'><img src='".Router::url('/img/icon_q.png')."' alt=''></a><div class='txt'>{$data['description']}</div></span>";
			}
			if ($isLink) {
				$data['name'] = "<a href='{$url}'>{$priceName}</a>";
				$priceName = "<a href='{$url}/'>{$priceName}</a>". $text;
			} else {
				$data['name'] = $priceName;
				$priceName = "<label for='discount_id_{$data['discount_id']}'>{$priceName}</label>". $text;
			}

			$array['value'] = $data['discount_id'];
			$array['label'] = false;
			$array['hiddenField'] = false;
			$array['escape'] = false;
			$array['checked'] = false;
			$array['id'] = "discount_id_". $data['discount_id'];

			if (!empty($this->request->data['Make']['discount_id'])) {
				foreach ($this->request->data['Make']['discount_id'] as $priceId) {
					if ($priceId == $data['discount_id']) {
						$array['checked'] = true;
						break;
					}
				}
			}
			echo "<li>";
			echo $this->checkbox($name, $array);
			echo $priceName;
			echo "</li>";
		}
		if (!$isOne) {
			echo "条件に一致する施設がありません。";
		}
	}

    /**
     * 特典・割引(件数).
     */
    public function discountSelect($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
        $discountTable = TableRegistry::get('Discounts');
        $isRanking = false;
        $datas = $discountTable->findByMoreNarrow($searchWheres, $isRanking);
        foreach ($datas as $data) {
            //	0件は非表示
            if ($data['cnt'] <= 0) {
                continue;
            }
            echo "<option value='".$data['discount_id']."'>";
            echo  $data['name'];
            echo "</option>";
        }
    }

	/**
	 * その他こだわり条件.
	 */
	public function otherCondition($name, $array = array()) {
		$ocTable = TableRegistry::get('OtherConditions');
		$datas = $ocTable->findByDelFlgOrderById();
		$options = $this->getKeyValueByDBData($datas, 'other_condition_id', 'name');

		return $this->make($options, $name, $array);
	}
	/**
	 * その他こだわり条件(件数).
	 */
	public function otherConditionCnt($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
		$ocTable = TableRegistry::get('OtherConditions');

		$isLinkRanking = false;
		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		} else if ($baseUrl == URLUtil::RANKING) {
			$isLinkRanking = true;
		}

		$placeUrls = [];
		$this->getPlaceUrl($placeUrls, $searchWheres);

		$types = OtherConditionType::valueOf();
		foreach ($types as $type) {
			$datas = [];
			$datas = $ocTable->findByMoreNarrow($type['code'], $searchWheres, $isLinkRanking);

			$datas = $datas->toArray();
			foreach ($datas as $key=> $data) {
				//	0件は非表示
				if ($data['cnt'] <= 0) {
					unset($datas[$key]);
					continue ;
				}

				$otherConditionName = $data['name']. "({$data['cnt']})";

				if (empty($placeUrls)) {
					$url = Router::url('/'. $baseUrl. '/'.$data['url_text']);
				} else {
					$url = "/". $baseUrl. "/". $placeUrls. "/". $data['url_text'];
				}

				$text = null;
				if (!empty($data['description'])) {
					$text = "<span class='description'><a href='javascript:void(0);' class='memo'><img src='".Router::url('/img/icon_q.png')."' alt=''></a><div class='txt'>{$data['description']}</div></span>";
				}
				if ($isLink) {
					$data['name'] = "<a href='{$url}/'>{$otherConditionName}</a>" . $text;
				} else {
					$data['name'] = $otherConditionName. $text;
				}
			}

			$options = $this->getKeyValueByDBData($datas, 'other_condition_id', 'name');
			$array['escape'] = false;

			echo "<div class='area_tit'>{$type['value']}</div>";
			echo "<ul class='cf'>";
			echo $this->make($options, $name, $array);
			echo "</ul>";
		}
	}

	/**
	 * 価格.
	 */
	public function price($name, $array = array()) {
		$priceTable = TableRegistry::get('Prices');
		$datas = $priceTable->findByDelFlgOrderById();
		$options = $this->getKeyValueByDBData($datas, 'price_id', 'name');

		return $this->make($options, $name, $array);
	}
	/**
	 * 価格(件数).
	 */
	public function priceCnt($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
		$priceTable = TableRegistry::get('Prices');
// 		$datas = $priceTable->findByMoreNarrow($searchWheres);

		$isRanking = false;
		if (empty($baseUrl)) {
			$baseUrl = URLUtil::SEARCH;
		} else if ($baseUrl == URLUtil::RANKING) {
			$isRanking = true;
		}

		$datas = $priceTable->findByMoreNarrow($searchWheres, $isRanking);

		$placeUrls = [];
		$this->getPlaceUrl($placeUrls, $searchWheres);

		$isOne = false;
		$i = 0;
		foreach ($datas as $data) {
			//	0件は非表示
			if ($data['cnt'] <= 0) {
				continue;
			}
			$isOne = true;

			$priceName = $data['name']. "({$data['cnt']})";

			if (empty($placeUrls)) {
				$url = Router::url('/'. $baseUrl. '/'.$data['url_text']);
			} else {
				$url = "/". $baseUrl. "/". $placeUrls. "/". $data['url_text'];
			}

			$text = null;
			if (!empty($data['description'])) {
				$text = "<span class='description'><a href='javascript:void(0);' class='memo'><img src='".Router::url('/img/icon_q.png')."' alt=''></a><div class='txt'>{$data['description']}</div></span>";
			}
			if ($isLink) {
				$priceName = "<a href='{$url}/'>{$priceName}</a>". $text;
			} else {
				$priceName = "<label for='price_id_{$data['price_id']}'>". $priceName. "</label>". $text;
			}
			$array['value'] = $data['price_id'];
			$array['label'] = false;
			$array['hiddenField'] = false;
			$array['escape'] = false;
			$array['checked'] = false;
			$array['id'] = "price_id_{$data['price_id']}";

			if (!empty($this->request->data['Make']['price_id'])) {
				foreach ($this->request->data['Make']['price_id'] as $priceId) {
					if ($priceId == $data['price_id']) {
						$array['checked'] = true;
						break;
					}
				}
			}

			echo "<li>";
			echo $this->checkbox($name, $array);
			echo $priceName;
			echo "</li>";
		}
		if (!$isOne) {
			echo "条件に一致する施設がありません。";
		}
	}

    /**
     * 価格(<option>).
     */
    public function priceSelect($name, $array = array(), $isLink = true, $searchWheres = null, $baseUrl = null) {
        $priceTable = TableRegistry::get('Prices');
        $isRanking = false;
        $datas = $priceTable->findByMoreNarrow($searchWheres, $isRanking);

        foreach ($datas as $data) {
            //	0件は非表示
            if ($data['cnt'] <= 0) {
                continue;
            }
            echo "<option value='".$data['price_id']."'>";
            echo $data['name'];
            echo "</option>";
        }
    }

	/**
	 * 性別.
	 */
	public function sex($name, $array = array()) {
		return $this->makeHTML(Sex::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 都道府県.
	 */
	public function pref($name, $array = array()) {
		return $this->makeHTML(Pref::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 表示フラグ.
	 */
	public function showFlg($name, $array = array()) {
		return $this->makeHTML(ShowFlg::toString (), $name, $array, CodePattern::$VALUE);
	}

	/**
	 * 管理ユーザ.
	 */
	public function AdministratorData($name, $array = array()) {
		$this->AdministratorData = TableRegistry::get('AdministratorDatas');
		$datas = $this->AdministratorData->findByDelFlgOrderByName();
		$options = $this->getKeyValueByDBData($datas, 'administrator_id', 'name');

		return $this->make($options, $name, $array);
	}

	private function getPlaceUrl(&$url, $where) {

		if (!empty($where['shop_type'])) {
			foreach ($where['shop_type'] as $shopType) {
				array_push($url, ShopType::convert($shopType, CodePattern::$VALUE2));
			}
		}

		if (!empty($where['pref'])) {
			$prefDataTable = TableRegistry::get('PrefDatas');
			foreach ($where['pref'] as $pref) {
				$prefData = $prefDataTable->findByIdAndDelFlg($pref);
				array_push($url, $prefData['url_text']);
			}
		}

		if (!empty($where['area_id'])) {
			foreach ($where['area_id'] as $areaId) {
				array_push($url, URLUtil::CITY.$areaId);
			}
		}

		if (!empty($where['station_cd'])) {
			foreach ($where['station_cd'] as $stationCd) {
				array_push($url, URLUtil::STATION.$stationCd);
			}
		}

		if (!empty($where['station_g_cd'])) {
			$stationTable = TableRegistry::get('Stations');
			$stationGCds = [];
			foreach ($where['station_g_cd'] as $stationGCd) {
				$station = $stationTable->findById($stationGCd);
				if (!in_array($station['station_g_cd'], $stationGCds)) {
					array_push($stationGCds, $station['station_g_cd']);
					array_push($url, URLUtil::STATION_G.$station['station_g_cd']);
				}
			}
		}

		$url = implode('/', $url);
	}

	private function exclusion(&$options, $code) {
		foreach ( $options as $key => $value ) {
			if ($key == $code) {
				unset ( $options [$key] );
				break;
			}
		}
	}

	private function getKeyValueByClassName($codeClassName, $valuePattern) {
		if ($valuePattern == null) {
			$valuePattern = CodePattern::$VALUE;
		}

		$vars = get_class_vars($codeClassName);
		$array = array();
		foreach ($vars as $var) {
			$code = $var[CodePattern::$CODE];
			$value = $var[$valuePattern];
			$array[$code] = $value;
		}
		return $array;
	}

	private function makeHTML($codeClassName, $name, $array, $valuePattern = null) {
		$options = $this->getKeyValueByClassName($codeClassName, $valuePattern);
		return $this->make($options, $name, $array);
	}

	public function make($options, $name, $array) {
		if ($array == null) {
			$array = array();
		}
		if (!empty($array['type'])) {
			$type = $array['type'];
			$array['type'] = null;
		}
		if (empty($type) || $type == 'select') {
			return parent::select($name, $options, $array);
		} else if ($type == 'radio') {
			$array['type'] = 'radio';
			$array['legend'] = false;
			$array['label'] = false;
			$array['options'] = $options;

			return parent::input($name, $array);
		} else if ($type == 'checkbox') {
			$array['type'] = 'select';
			$array['multiple'] = 'checkbox';
			$array['options'] = $options;
			$array['label'] = false;

			return parent::input($name, $array);
		} else if ($type == 'multiple') {
			$array['type'] = 'select';
			$array['multiple'] = true;
			$array['options'] = $options;
			$array['label'] = false;

			return parent::input($name, $array);
		}
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
?>