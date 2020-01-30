<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;

?>
<div id="pcsearch" class="search_wrap pc">
	<h2 class="tit">さらに条件を絞り込む</h2>
		<div class="search_inner">
			<div class="check_box">
				<h3 class="sub_tit">施設の種類で絞り込む</h3>
				<ul class="cf">
					<?php
					echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>']]);
					?>
				</ul>
			</div>
			<div class="check_box w20">
				<?php
				if (isset($prefCodes)) {
// 					echo $this->element('Front/area_link', ['prefCode'=> $prefCodes[0], 'areas'=> $areas]);
					echo $this->element('Front/area_link', ['prefCode'=> $prefCodes]);
				} else {
					echo $this->ExForm->byRegion('Make.pref');

				}
				?>
			</div>
			<div class="form_btn">
				<?php
				echo $this->ExForm->input('この条件で検索！', ['name'=> 'search', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
				?>
			</div>
		</div>
		<?php
		$activeClass = null;
		$url = Router::url(null);
		$shopTypes = ShopType::valueOf();
		foreach ($shopTypes as $shopType) {
			$shopTypeUrl = Router::url(['controller'=> 'searchs', 'action'=> 'search', $shopType[CodePattern::$VALUE2]]);
			if ($url == $shopTypeUrl) {
				$activeClass = " active";
				break;
			}
		}

		if ($this->Paginator->current() >= 2) {
			$activeClass = null;
		}
		?>
		<div class="more_btn pc <?=$activeClass?>"><span>さらに条件を絞って探す</span></div>
		<div class="more_btn_sp sp"><span>さらに詳しい条件で絞る</span></div>
		<div class="search_inner slide_down <?=$activeClass?>">
			<div class="modal-content">
				<div class="md_inner">
					<div class="depilation_site pc check_box w33">
						<h3 class="sub_tit">脱毛部位</h3>
						<ul class="prt cf">
							<?php
							$this->ExForm->depilationSiteCnt('Make.depilation_site_id.', null, true, $searchWheres);
							?>
						</ul>
					</div>
					<div class="check_box">
						<h3 class="sub_tit">価格</h3>
						<ul class="cf"><?php echo $this->ExForm->priceCnt('Make.price_id.', null, true, $searchWheres); ?></ul>
					</div>
					<div class="check_box">
						<h3 class="sub_tit">支払い方法</h3>
						<ul class="cf"><?php echo $this->ExForm->paymentCnt('Make.payment_id.', null, true, $searchWheres); ?></ul>
					</div>
					<div class="check_box">
						<h3 class="sub_tit">特典・割引</h3>
						<ul class="cf"><?php echo $this->ExForm->discountCnt('Make.discount_id.', null, true, $searchWheres); ?></ul>
					</div>
					<div class="check_box w50">
						<h3 class="sub_tit">その他こだわり</h3>
						<?php
						echo $this->ExForm->otherConditionCnt('Make.other_condition_id', ['type'=> 'checkbox', 'hiddenField'=> false,
								'templates'=> ['nestingLabel' => '{{input}}{{text}}', 'checkboxWrapper' => '<li>{{label}}</li>', ]
						], true, $searchWheres);
						?>
					</div>
				</div>
				<div class="form_btn">
					<?php
					echo $this->ExForm->input('この条件で検索！', ['name'=> 'search', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
					?>
				</div>
			</div>
		</div>
</div><!--/#pcsearch-->