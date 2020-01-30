<?php
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\DepilationType;
use Cake\Routing\Router;
use App\Vendor\Messages;
?>
<div class="header"><h1 class="page-title">ブランド登録</h1></div>
<div class="row">
	<div class="col-md-4">
		<?php
		echo $this->Flash->render();
		if (empty($brand)) {
			$brand = "Brand";
		}
		echo $this->ExForm->create($brand, array('url'=> array('action'=> 'edit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<div class="form-group">
					<label>ブランド名<span class="required-mark">※</span></label><br>
					<?php
					echo $this->ExForm->text('Brands.name', array('id'=> 'name', 'class'=> 'form-control'));
					echo $this->ExForm->error('Brands.name');
					?>
				</div>
				<div class="form-group">
					<label>50音</label><br>
					<?php
					echo $this->ExForm->japaneseSyllabary('Brands.japanese_syllabary', array('id'=> 'japanese_syllabary', 'class'=> 'form-control', 'empty'=> true));
					echo $this->ExForm->error('Brands.japanese_syllabary');
					?>
				</div>
				<div class="form-group">
					<label>アルファベット</label><br>
					<?php
					echo $this->ExForm->alphabet('Brands.alphabet', array('id'=> 'alphabet', 'class'=> 'form-control', 'empty'=> true));
					echo $this->ExForm->error('Brands.alphabet');
					?>
				</div>
				<div class="form-group">
					<label>店舗種別</label><br>
					<?php
					echo $this->ExForm->shopType('Brands.shop_type', ['type'=> 'radio', 'id'=> 'shop_type', 'default'=> ShopType::$DEPILATION_SALON[CodePattern::$CODE]]);
					echo $this->ExForm->error('Brands.shop_type');
					?>
				</div>
				<div class="form-group">
					<label>脱毛対象</label><br>
					<?php
					echo $this->ExForm->depilationType('Brands.depilation_type', ['type'=> 'radio', 'id'=> 'depilation_type', 'default'=> DepilationType::$LADIES[CodePattern::$CODE]]);
					echo $this->ExForm->error('Brands.depilation_type');
					?>
				</div>
				<div class="form-group">
					<label>アフィリエイトページURL</label><br>
					<?php
					echo $this->ExForm->text('Brands.affiliate_page_url', array('id'=> 'affiliate_page_url', 'class'=> 'form-control'));
					echo $this->ExForm->error('Brands.affiliate_page_url');
					?>
				</div>
				<div class="form-group">
					<label>アフィリエイトバナーURL</label><br>
					<?php
					echo $this->ExForm->text('Brands.affiliate_banner_url', array('id'=> 'affiliate_banner_url', 'class'=> 'form-control'));
					echo $this->ExForm->error('Brands.affiliate_banner_url');
					?>
				</div>
				<div class="form-group">
					<label>TOP画像</label><br>
					<?php
					if (!empty($this->request->data['Brands']['image_path'])) {
						$url = Router::url(array('controller'=> 'brands', 'action'=> 'imageBrand', $this->request->data['Brands']['brand_id']));
						echo "<img src='{$url}' height='80'>";
						echo $this->Html->link('<i class="fa fa-remove"></i>', ['controller'=> 'brands', 'action'=> 'imgDelete', $this->request->data['Brands']['brand_id']], ['escape'=> false, 'confirm'=> "画像を".Messages::CONFIRM_DELETE]);
					}
					echo $this->ExForm->file("Brands.image_file", array('id'=> "image_file", 'class'=> 'form-control'));
					?>
				</div>
				<div class="form-group">
					<label>脱毛部位</label><br>
					<?php
					echo $this->ExForm->depilationSite('DepilationSites.depilation_site_ids', array('id'=> 'depilation_site_id', 'class'=> 'form-control', 'type'=> 'multiple', 'style'=> 'height: 500px;'));
					?>
				</div>
				<div class="form-group">
					<label>特徴(HTML)</label><br>
					<button type="button" class="sample_html_btn">▼ サンプルHTML</button>
					<div class="sample_html">
					<?php
$a = <<<EOF
<div class="content cf">
	<div class="imgbox">
		<img src="" alt="">
	</div>
	<div class="textbox">
		<p>テキスト</p>
	</div>
</div>
EOF;
					echo "<pre><code>".htmlspecialchars($a). "</code></pre>";
					?>
					</div>

					<?php
					echo $this->ExForm->textarea('Brands.feature_html', array('id'=> 'feature_html', 'class'=> 'form-control', 'style'=> 'height: 300px;'));
					echo $this->ExForm->error('Brands.feature_html');
					?>
				</div>
				<div class="form-group">
					<label>料金プラン(HTML)</label><br>

					<button type="button" class="sample_html_btn">▼ サンプルHTML</button>
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
</table>
EOF;
					echo "<pre><code>".htmlspecialchars($a). "</code></pre>";
					?>
					</div>
					<?php
					echo $this->ExForm->textarea('Brands.price_plan_html', array('id'=> 'price_plan_html', 'class'=> 'form-control', 'style'=> 'height: 300px;'));
					echo $this->ExForm->error('Brands.price_plan_html');
					?>
				</div>
				<div class="form-group">
					<label>キャンペーン(HTML)</label><br>

					<button type="button" class="sample_html_btn">▼ サンプルHTML</button>
					<div class="sample_html">
					<?php
$a = <<<EOF
<div class="scroll">
	<table class="price_list">
		<tr>
			<th>キャンペーン名</th>
			<td>キャンペーン詳細テキスト</td>
		</tr>
		<tr>
			<th>キャンペーン名</th>
			<td>キャンペーン詳細テキスト</td>
		</tr>
		<tr>
			<th>キャンペーン名</th>
			<td>キャンペーン詳細テキスト</td>
		</tr>
	</table>
</div>
EOF;
					echo "<pre><code>".htmlspecialchars($a). "</code></pre>";
					?>
					</div>
					<?php
					echo $this->ExForm->textarea('Brands.campaign_html', array('id'=> 'campaign_html', 'class'=> 'form-control', 'style'=> 'height: 300px;'));
					echo $this->ExForm->error('Brands.campaign_html');
					?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('Brands.brand_id');
			if (isset($this->request->data['Brands']['brand_id']) && !empty($this->request->data['Brands']['brand_id'])) {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			} else {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			}
			?>
		</div>
		<?php
		echo $this->ExForm->end();
		?>
	</div>
</div>

<script>
$(function() {
	$(".sample_html").hide();
	$(".sample_html_btn").on("click", function() {
		$(this).next().slideToggle();
	});
})
</script>
