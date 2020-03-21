<?php
use App\Vendor\Messages;
?>
<div class="header"><h1 class="page-title"><?php echo "【ID：{$shop['shop_id']}】". $shop['name']?> の詳細画面</h1></div>
<?php
echo $this->Flash->render();
echo $this->Html->link('<i class="fa fa-chevron-left"></i> 一覧に戻る', ['controller'=> 'shops', 'action'=> 'index'], array('class'=> 'btn btn-primary', 'escape'=> false));
?>
<div class="row">
	<div class="col-md-7">
		<table class="table">
			<tr>
				<th width="200">ID</th>
				<td><?php echo $shop['shop_id']?></td>
			</tr>
			<tr>
				<th>名前</th>
				<td><?php echo $shop['name']?></td>
			</tr>
			<tr>
				<th>施設種類</th>
				<td><?php echo $shop['shop_type']?></td>
			</tr>
			<tr>
				<th>住所</th>
				<td><?php echo $shop['address']?></td>
			</tr>
			<tr>
				<th>アクセス/道案内</th>
				<td><?php echo $shop['access']?></td>
			</tr>
			<tr>
				<th>営業時間</th>
				<td><?php echo $shop['business_hours']?></td>
			</tr>
			<tr>
				<th>定休日</th>
				<td><?php echo $shop['holiday']?></td>
			</tr>
			<tr>
				<th>クレジットカード</th>
				<td><?php echo $shop['credit_card']?></td>
			</tr>
			<tr>
				<th>設備</th>
				<td><?php echo $shop['facility']?></td>
			</tr>
			<tr>
				<th>スタッフ数</th>
				<td><?php echo $shop['staff']?></td>
			</tr>
			<tr>
				<th>駐車場</th>
				<td><?php echo $shop['parking']?></td>
			</tr>
			<tr>
				<th>こだわり条件</th>
				<td><?php echo $shop['conditions']?></td>
			</tr>
			<tr>
				<th>備考</th>
				<td><?php echo $shop['memo']?></td>
			</tr>
			<tr>
				<th>最寄駅/バスetc</th>
				<td><?php echo $shop['station']?></td>
			</tr>
			<tr>
				<th>最寄駅</th>
				<td>
					<?php
					foreach ($shopStations as $shopStation) {
						echo "・{$shopStation['StationCompany']['company_name']}/{$shopStation['StationLine']['line_name']}/{$shopStation['Station']['station_name']}駅<br>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>URL</th>
				<td>
					<?php
					echo $this->Html->link($shop['scraping_url'], null, ['target'=> '_blank']);
					?>
				</td>
			</tr>
			<tr>
				<th>店舗説明文 件名</th>
				<td><?php echo $shop['description_subject']?></td>
			</tr>
			<tr>
				<th>店舗説明文 内容</th>
				<td><?php echo $shop['description_content']?></td>
			</tr>
			<tr>
				<th>ブランド名</th>
				<td><?php echo $shop['Brand']['name']?></td>
			</tr>
			<tr>
				<th>アフィリエイトページURL</th>
				<td><?php echo $shop['affiliate_page_url']?></td>
			</tr>
			<tr>
				<th>アフィリエイトバナーURL</th>
				<td><?php echo $shop['affiliate_banner_url']?></td>
			</tr>
			<tr>
				<th>脱毛部位</th>
				<td>
					<?php
					foreach ($shop['depilation_sites'] as $depilationSite) {
						echo "・{$depilationSite['name']}<br>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>支払方法</th>
				<td>
					<?php
					foreach ($shop['payments'] as $payment) {
						echo "・{$payment['name']}<br>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>特典・割引</th>
				<td>
					<?php
					foreach ($shop['discounts'] as $discount) {
						echo "・{$discount['name']}<br>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>その他こだわり条件</th>
				<td>
					<?php
					foreach ($shop['other_conditions'] as $otherCondition) {
						echo "・{$otherCondition['name']}<br>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>価格</th>
				<td>
					<?php
					foreach ($shop['prices'] as $price) {
						echo "・{$price['name']}<br>";
					}
					?>
				</td>
			</tr>
			<tr>
				<th>表示フラグ</th>
				<td><?php echo $shop['show_flg']?></td>
			</tr>
			<tr>
				<th></th>
				<td>
					<?php
					echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller'=> 'shops', 'action'=> 'moveEdit', $shop['shop_id']), array('class'=> 'btn btn-primary', 'escape'=> false));
					echo '&nbsp;&nbsp;&nbsp;';
					echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('controller'=> 'shops', 'action'=> 'delete', $shop['shop_id']), array('class'=> 'btn btn-primary', 'escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
					?>
				</td>
			</tr>
		</table>
	</div>
</div>

