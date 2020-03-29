<?php
use App\Vendor\URLUtil;
use Cake\Routing\Router;

$baseUrl = null;
$submitName = "search";
if ($this->name == 'Rankings') {
	$baseUrl = URLUtil::RANKING;
	$submitName = "ranking_search";
}
if (!empty($this->request->data['Make']['pref']) && empty($prefCodes)) {
	$prefCodes = $this->request->data['Make']['pref'];
}

if (empty($prefs)) {
?>

<div id="slide_btn_wrap" class="sp">
	<div id="b1" class="slide_btn"><a href="#sp_search_detail1" id="sp_search1"><?php echo isset($prefCodes) ? "市区町村" : "都道府県"?>から絞り込む</a></div>
	<?php if (isset($prefCodes)) {?>
	<div id="b2" class="slide_btn"><a href="#sp_search_detail2" id="sp_search2">駅名から絞り込む</a></div>
	<?php }?>
	<div id="b3" class="slide_btn"><a href="#sp_search_detail3" id="sp_search3">さらに条件を絞り込む</a></div>
	<?php if ($this->name !== 'Rankings') {	?>
	<div id="b4" class="slide_btn"><a href="#sp_search_detail4" id="sp_search4">施設を並び替え</a></div>
	<?php } ?>
</div>
<div id="spsearch" class="search_wrap none sp">
	<?php
// 	if (count($prefCodes) === 1) {
	?>
	<div id="sp_search_detail1" class="search_inner sp_search_detail">
		<div class="modal-content">
			<div class="cat_head v1"><?php echo isset($prefCodes) ? "市区町村" : "都道府県"?>から絞り込む<span class="close-sp_search_detail1 close">×</span></div>
			<div class="md_inner">
				<div class="check_box w33">
				<?php
				if (isset($prefCodes)) {
					// echo $this->element('Front/area_link', ['prefCode'=> $prefCodes[0], 'areas'=> $areas]);
					echo $this->element('Front/area_link', ['prefCodes'=> $prefCodes]);
				} else {
					echo $this->ExForm->byRegion('Make.pref', [], false);
				}
				?>
				</div>
			</div>
			<div class="form_btn02">
				<?php
				echo $this->ExForm->input('この条件で検索！', ['name'=> $submitName, 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
				?>
			</div>
		</div>
	</div>
	<?php
// 	}
	?>
	<div id="sp_search_detail2" class="search_inner sp_search_detail">
		<div class="modal-content">
			<div class="cat_head v2">駅名から絞り込む<span class="close-sp_search_detail2 close">×</span></div>
			<div class="md_inner">
				<div class="check_box w50">
					<?php
					foreach ($prefCodes as $prefCode) {
					?>
					<ul class="cf">
						<?php
						echo $this->ExForm->station('Make.station_cd', $prefCode, ['templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']]);
						?>
					</ul>
					<?php
					}
					?>
				</div>
			</div>
			<div class="form_btn02">
				<?php
				echo $this->ExForm->input('この条件で検索！', ['name'=> $submitName, 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
				?>
			</div>
		</div>
	</div>
	<div id="sp_search_detail3" class="search_inner sp_search_detail">
		<div class="modal-content">
			<div class="cat_head v3">さらに詳しい条件で絞る<span class="close-sp_search_detail3 close">×</span></div>
			<div class="md_inner">
				<div class="check_box">
					<h3 class="sub_tit">施設の種類で絞り込む</h3>
					<ul class="cf">
						<?php
						echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']], false);
						?>
					</ul>
				</div>
				<div class="depilation_site sp check_box">
					<h3 class="sub_tit">脱毛部位</h3>
					<ul class="prt cf">
						<?php
						$this->ExForm->depilationSiteCnt('Make.depilation_site_id.', [], false, $searchWheres, $baseUrl);
						?>
					</ul>
				</div>
				<div class="check_box">
					<h3 class="sub_tit">価格</h3>
					<ul class="cf"><?php echo $this->ExForm->priceCnt('Make.price_id.', [], false, $searchWheres, $baseUrl); ?></ul>
				</div>
				<div class="check_box">
					<h3 class="sub_tit">支払い方法</h3>
					<ul class="cf"><?php echo $this->ExForm->paymentCnt('Make.payment_id.', [], false, $searchWheres, $baseUrl); ?></ul>
				</div>
				<div class="check_box w50">
					<h3 class="sub_tit">特典・割引</h3>
					<ul class="cf"><?php echo $this->ExForm->discountCnt('Make.discount_id.', [], false, $searchWheres, $baseUrl); ?></ul>
				</div>
				<div class="check_box w50 slide">
					<h3 class="sub_tit">その他こだわり</h3>
					<?php
					echo $this->ExForm->otherConditionCnt('Make.other_condition_id', ['type'=> 'checkbox', 'hiddenField'=> false,
							'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']
					], false, $searchWheres, $baseUrl);
					?>
				</div>
				<div class="form_btn02">
					<?php
					echo $this->ExForm->input('この条件で検索！', ['name'=> $submitName, 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	if ($this->name !== 'Rankings') {
	?>
	<div id="sp_search_detail4" class="search_inner sp_search_detail">
		<div class="modal-content">
			<div class="cat_head v4">施設を並び替え<span class="close-sp_search_detail4 close">×</span></div>
			<div class="md_inner">
				<div class="check_box w50">
					<ul class="cf link">
						<li><?php echo $this->Html->link('新着順', '?direction=desc&sort=Shops.created');?></li>
						<li><?php echo $this->Html->link('更新順', '?direction=desc&sort=Shops.modified');?></li>
						<li><?php echo $this->Html->link('口コミ数', '?direction=desc&sort=Shops.review_cnt');?></li>
						<?php
						$rankingUrl = str_replace(URLUtil::SEARCH, URLUtil::RANKING, Router::url(null,true));
						?>
						<li><a href="<?=$rankingUrl?>">ランキング</a></li>
					</ul>
				</div>
				<div class="form_btn02">
					<?php
					echo $this->ExForm->input('この条件で検索！', ['name'=> $submitName, 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
					?>
				</div>
			</div>
		</div>
	</div>
	<?php
	}
	?>
</div><!--/#spsearch-->
<?php
} else {
?>
<div id="spsearch" class="search_wrap sp">
	<h2 class="tit">条件を入力して、ジブンにピッタリの<br>脱毛サロン・クリニックを見つけましょう！</h2>
	<div class="search_inner pad">
		<div class="check_box">
			<h3 class="sub_tit">施設の種類で絞り込む</h3>
			<ul class="cf">
				<?php
				echo $this->ExForm->shopTypeFront('Make.shop_type', ['type'=> 'checkbox', 'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']], false);
				?>
			</ul>
		</div>
		<div class="check_box w20 slide">
			<h3 class="sub_tit">都道府県で絞り込む</h3>
			<?php echo $this->ExForm->byRegion('Make.pref', [], false); ?>
		</div>
		<div class="form_btn">
			<?php
			echo $this->ExForm->input('この条件で検索！', ['name'=> $submitName, 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
			?>
		</div>
	</div>
	<div class="more_btn_sp sp"><a href="#sp_search_detail" id="sp_search"><span>さらに詳しい条件で絞る</span></a></div>
	<div id="sp_search_detail" class="search_inner sp_search_detail">
		<div class="modal-content">
			<div class="cat_head">さらに詳しい条件で絞る<span class="close-sp_search_detail close">×</span></div>
			<div class="md_inner">
				<div class="depilation_site sp check_box w33">
					<h3 class="sub_tit">脱毛部位</h3>
					<ul class="prt cf">
						<?php
						$this->ExForm->depilationSiteCnt('Make.depilation_site_id.', [], false);
						?>
					</ul>
				</div>
				<!-- ↑michikami↑ -->
				<div class="check_box">
					<h3 class="sub_tit">価格</h3>
					<ul class="cf">
						<?php
						echo $this->ExForm->priceCnt('Make.price_id', ['type'=> 'checkbox', 'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>', 'div'=> false]], false);
						?>
					</ul>
				</div>
				<div class="check_box">
					<h3 class="sub_tit">支払い方法</h3>
					<ul class="cf">
						<?php
						echo $this->ExForm->paymentCnt('Make.payment_id', ['type'=> 'checkbox', 'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']], false);
						?>
					</ul>
				</div>
				<div class="check_box">
					<h3 class="sub_tit">特典・割引</h3>
					<ul class="cf">
						<?php
						echo $this->ExForm->discountCnt('Make.discount_id', ['type'=> 'checkbox', 'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']], false);
						?>
					</ul>
				</div>
				<div class="check_box w50 slide">
					<h3 class="sub_tit">その他こだわり</h3>
					<?php
					echo $this->ExForm->otherConditionCnt('Make.other_condition_id', ['type'=> 'checkbox', 'hiddenField'=> false,
							'templates'=> ['checkboxWrapper' => '<li>{{label}}</li>']
					], false);
					?>
				</div>
			</div>
			<div class="form_btn02">
				<?php
				echo $this->ExForm->input('この条件で検索！', ['name'=> $submitName, 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
				?>
			</div>
		</div>
	</div>
</div>
<?php
}
?>