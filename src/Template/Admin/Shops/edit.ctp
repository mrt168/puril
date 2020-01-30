<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShowFlg;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShopType;
use App\Vendor\Messages;
?>
<div class="header"><h1 class="page-title">店舗登録</h1></div>
<?php
echo $this->Flash->render();
?>
<div class="row">
	<div class="col-md-4">
		<?php
		echo $this->Flash->render();
		if (empty($shop)) {
			$shop = "Shops";
		}
		echo $this->ExForm->create($shop, array('url'=> array('action'=> 'edit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="main"><br>
				<div class="form-group">
					<label>店舗名<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->text('Shops.name', array('id'=> 'name', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.name');
					?>
				</div>
				<div class="form-group">
					<label>施設種類<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->shopType('Shops.shop_type', array('id'=> 'shop_type', 'type'=> 'radio', 'default'=> ShopType::$DEPILATION_SALON[CodePattern::$CODE]));
					echo $this->ExForm->error('Shops.shop_type');
					?>
				</div>
				<div class="form-group">
					<label>ブランド（登録ブランドから選択）</label><br>
					<?php
					echo $this->ExForm->brand('Shops.brand_id', array('id'=> 'brand_id', 'class'=> 'form-control', 'empty'=> true));
					echo $this->ExForm->error('Shops.brand_id');
					?>
				</div>
				<div class="form-group">
					<label>都道府県<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->pref('Shops.pref', array('id'=> 'pref', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.pref');
					?>
				</div>
				<div class="form-group">
					<label>市区町村<span class="required-mark">※</span></label><br>
					<?php
					$disabled = false;
					if (empty($areas)) {
						$areas = ["都道府県を選択してください"];
						$disabled = true;
					}

					echo $this->ExForm->input('Shops.area_id', [
							'id'=> 'area_id',
							'type'=> 'select',
							'label'=>false,
							'class'=> 'form-control',
							'options'=> $areas,
							'disabled'=> $disabled
					]);
					echo $this->ExForm->error('Shops.area_id');
					?>
				</div>
				<div class="form-group">
					<label>住所<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->text('Shops.address', array('id'=> 'address', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.address');
					?>
				</div>
				<div class="form-group">
					<label>アクセス/道案内（詳細情報を記述）</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.access', array('id'=> 'name', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.access');
					?>
				</div>
				<div class="form-group">
					<label>営業時間</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.business_hours', array('id'=> 'business_hours', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.business_hours');
					?>
				</div>
				<div class="form-group">
					<label>定休日</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.holiday', array('id'=> 'holiday', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.holiday');
					?>
				</div>
				<div class="form-group">
					<label>クレジットカード</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.credit_card', array('id'=> 'credit_card', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.credit_card');
					?>
				</div>
				<div class="form-group">
					<label>設備</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.facility', array('id'=> 'facility', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.facility');
					?>
				</div>
				<div class="form-group">
					<label>スタッフ数</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.staff', array('id'=> 'staff', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.staff');
					?>
				</div>
				<div class="form-group">
					<label>駐車場</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.parking', array('id'=> 'parking', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.parking');
					?>
				</div>
				<div class="form-group">
					<label>こだわり条件（フロントでは非表示）</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.conditions', array('id'=> 'conditions', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.conditions');
					?>
				</div>
				<div class="form-group">
					<label>備考（フロントでは非表示）</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.memo', array('id'=> 'memo', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.memo');
					?>
				</div>
				<div class="form-group">
					<label>最寄り駅/バスetc（「駅から徒歩1分」など詳細情報を記述）</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.station', array('id'=> 'station', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.station');
					?>
				</div>
				<div class="form-group">
					<label>
						<?php
						$shopId = null;
						if (isset($this->request->data['Shops']['shop_id']) && !empty($this->request->data['Shops']['shop_id'])) {
							$shopId = $this->request->data['Shops']['shop_id'];
						}

						echo $this->Html->link('最寄駅（選択してください）', array('controller'=> 'shops', 'action'=> 'extraction', $shopId), array('id'=> 'popup_station_cd'));
						?>
					</label><br>
					<div id="station_cd">
						<?php
						if (!empty($shopStations)) {
							foreach ($shopStations as $shopStation) {

								$sationName = "{$shopStation['StationCompany']['company_name']}/{$shopStation['StationLine']['line_name']}/{$shopStation['Station']['station_name']}駅";

								echo $this->ExForm->input('ShopStations.station_cds.', ['id'=> false, 'type'=> 'hidden', 'value'=> $shopStation['station_cd'], 'class'=> "station_cd station_cd{$shopStation['station_cd']}"]);
								echo "<p class='station_cd{$shopStation['station_cd']}'>・{$sationName} <a onclick='deleteStation({$shopStation['station_cd']})'><i class='fa fa-times-circle-o'></i></a></p>";
							}
						}
						?>
					</div>
				</div>
				<div class="form-group">
					<label>スクレイピングURL</label><br>
					<?php
					echo $this->ExForm->text('Shops.scraping_url', array('id'=> 'scraping_url', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.scraping_url');
					?>
				</div>
				<div class="form-group">
					<label>店舗説明文 件名</label><br>
					<?php
					echo $this->ExForm->text('Shops.description_subject', array('id'=> 'description_subject', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.description_subject');
					?>
				</div>
				<div class="form-group">
					<label>店舗説明文 内容</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.description_content', array('id'=> 'description_content', 'class'=> 'form-control', 'style'=> 'height: 50px;'));
					echo $this->ExForm->error('Shops.description_content');
					?>
				</div>
				<div class="form-group">
					<label>アフィリエイトページURL</label><br>
					<?php
					echo $this->ExForm->text('Shops.affiliate_page_url', array('id'=> 'affiliate_page_url', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.affiliate_page_url');
					?>
				</div>
				<div class="form-group">
					<label>アフィリエイトバナーURL</label><br>
					<?php
					echo $this->ExForm->text('Shops.affiliate_banner_url', array('id'=> 'affiliate_banner_url', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.affiliate_banner_url');
					?>
				</div>
				<div class="form-group">
					<label>料金プラン(HTML)</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.price_plan_html', array('id'=> 'price_plan_html', 'class'=> 'form-control inline', 'style'=> 'height: 300px;'));
					echo $this->ExForm->error('Shops.price_plan_html');
					?>
				</div>
				<div class="form-group">
					<button type="button" id="sample_html_btn">▼料金プラン サンプルHTML</button>
					<div class="sample_html">
					<?php
$a = <<<EOF
<table class="price_list">
	<tr>
		<th>プラン名</th>
		<td class="price">00,000円</td>
		<td>プラン内容プラン内容プラン内容プラン内容</td>
	</tr>
	<tr>
		<th>プラン名</th>
		<td class="price">00,000円</td>
		<td>プラン内容プラン内容プラン内容プラン内容</td>
	</tr>
	<tr>
		<th>プラン名</th>
		<td class="price">00,000円</td>
		<td>プラン内容プラン内容プラン内容プラン内容</td>
	</tr>
	<tr>
		<th>プラン名</th>
		<td class="price">00,000円</td>
		<td>プラン内容プラン内容プラン内容プラン内容</td>
	</tr>
</table>
EOF;
					echo "<pre><code>".htmlspecialchars($a). "</code></pre>";
					?>
					</div>
				</div>
				<div class="form-group">
					<label>店舗画像(店舗からのひとこと)</label><br>
					<?php
					if (!empty($this->request->data['Shops']['shop_image_path'])) {
						$url = Router::url(array('controller'=> 'shops', 'action'=> 'imageWord', $this->request->data['Shops']['shop_id']));
						echo "<img src='{$url}' height='80'>";
						echo $this->Html->link('<i class="fa fa-remove"></i>', ['controller'=> 'shops', 'action'=> 'shopImgDelete', $this->request->data['Shops']['shop_id']], ['escape'=> false, 'confirm'=> "画像を".Messages::CONFIRM_DELETE]);
					}
					echo $this->ExForm->file("Shops.shop_image_file", array('id'=> "shop_image_file", 'class'=> 'form-control'));
					?>
				</div>
				<div class="form-group">
					<label>店舗からのひとこと</label><br>
					<?php
					echo $this->ExForm->textarea('Shops.word', array('id'=> 'word', 'class'=> 'form-control'));
					echo $this->ExForm->error('Shops.word');
					?>
				</div>
				<div class="form-group">
					<label>脱毛部位</label><br>
					<?php
					echo $this->ExForm->depilationSite('DepilationSites.depilation_site_ids', array('id'=> 'depilation_site_id', 'class'=> 'form-control', 'type'=> 'multiple', 'style'=> 'height: 500px;'));
					?>
				</div>
				<div class="form-group">
					<label>支払方法</label><br>
					<?php
					echo $this->ExForm->payment('Payments.payment_ids', array('id'=> 'payment_id', 'class'=> 'form-control','type'=> 'multiple', 'style'=> 'height: 150px;'));
					?>
				</div>
				<div class="form-group">
					<label>特典・割引</label><br>
					<?php
					echo $this->ExForm->discount('Discounts.discount_ids', array('id'=> 'discount_id', 'class'=> 'form-control', 'type'=> 'multiple', 'style'=> 'height: 130px;'));
					?>
				</div>
				<div class="form-group">
					<label>その他こだわり条件</label><br>
					<?php
					echo $this->ExForm->otherCondition('OtherConditions.other_condition_ids', array('id'=> 'other_condition_id', 'class'=> 'form-control', 'type'=> 'multiple', 'style'=> 'height: 920px;'));
					?>
				</div>
				<div class="form-group">
					<label>価格</label><br>
					<?php
					echo $this->ExForm->price('Prices.price_ids', array('id'=> 'price_id', 'class'=> 'form-control', 'type'=> 'multiple'));
					?>
				</div>
				<div class="form-group">
					<label>表示フラグ<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->showFlg('Shops.show_flg', array('id'=> 'show_flg', 'type'=> 'radio', 'default'=> ShowFlg::$SHOW[CodePattern::$CODE]));
					echo $this->ExForm->error('Shops.show_flg');
					?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('Shops.shop_id');
			if (isset($this->request->data['Shops']['shop_id']) && !empty($this->request->data['Shops']['shop_id'])) {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			} else {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			}
			?>
		</div>
		<?php
		if (!empty($referer)) {
			echo $this->ExForm->hidden('referer', ['value'=> $referer]);
		}

		echo $this->ExForm->end();
		?>
	</div>
</div>

<script>
$(function() {
	<?php
	if (empty($areas)) {
	?>
	$('#pref').change(function() {
	    var pref = $(this).val();
	    getArea(pref)
	}).eq(0).trigger('change');
	<?php
	} else {
	?>
	$('#pref').change(function() {
	    var pref = $(this).val();
	    getArea(pref)
	}).eq(0);
	<?php
	}
	?>

	$('#popup_station_cd').click(function() {
		window.open($(this).attr('href'), 'subwin', 'width=800,height=600');
		return false;
	});

	$(".sample_html").hide();
	$("#sample_html_btn").on("click", function() {
		$(this).next().slideToggle();
	});
})

function deleteStation(stationCd) {
	$(".station_cd"+ stationCd).remove();
	return false;
}

function getArea(pref) {
	$.ajax({
		url: '<?php echo Router::url(array('controller'=> 'shops', 'action'=> 'getArea'))?>',
		type: 'post',
		data: {pref: pref},
		dataType: 'json',
        success: function(result, textStatus, xhr) {
	        if (result != "empty") {
				$('#area_id > option').remove();
	        	$.each(result, function(i, data) {
					var area_id = data.area_id;
					var name = data.name;

					$('#area_id').append($('<option>').html(name).val(area_id));
	        	});
	        	$('#area_id').prop('disabled', false);
	        }
        }
    });
}

</script>
