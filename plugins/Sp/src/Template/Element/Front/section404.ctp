<?php
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
?>
<div class="section_404">
	<h2>
		<?php
		echo $this->Html->link("<span class='title_arrow'>></span>脱毛店舗を全国から探す", ['controller'=> 'searchs', 'action'=> 'index'], ['escape'=> false]);
		?>
	</h2>
	<?php
	$shopTypes = ShopType::valueOf();
	foreach ($shopTypes as $shopType) {
	?>
		<div class="find_salon">
			<h3>
				<?php
				echo $this->Html->link("<span class='title_arrow'>></span>". $shopType[CodePattern::$VALUE]."を全国から探す", ['controller'=> 'searchs', 'action'=> 'search', $shopType[CodePattern::$VALUE2]], ['escape'=> false]);
				?>
			</h3>
			<table class="area_table">
				<?php
				foreach ($regionPrefs as $region => $prefDatas) {
				?>
					<tr>
						<th><?php echo $region?></th>
						<?php
						foreach ($prefDatas as $prefCode => $prefUrlText) {
						?>
							<td>
								<?php
								$prefVal = Pref::convert($prefCode, CodePattern::$VALUE);
								echo $this->Html->link($prefVal, ['controller'=> 'searchs', 'action'=> 'search', $prefUrlText, $shopType[CodePattern::$VALUE2]]);
								?>
							</td>
						<?php
						}
						?>
					</tr>
				<?php
				}
				?>
			</table>
		</div>
	<?php
	}
	?>
</div>
<div class="section_404">
	<h2><a href="https://puril.net/column/"><span class="title_arrow">></span>みんなの脱毛コラム</a></h2>
	<ul class="list_vertical">
		<li><a href="https://puril.net/column/useful/">・脱毛お役立ち情報</a></li>
		<li><a href="https://puril.net/column/salon/">・脱毛サロン</a></li>
		<li><a href="https://puril.net/column/clinic/">・医療脱毛</a></li>
		<li><a href="https://puril.net/column/special/">・Puril特選記事</a></li>
		<li><a href="https://puril.net/column/epilator/">・家庭用脱毛器</a></li>
		<li><a href="https://puril.net/column/cream/">・脱毛クリーム</a></li>
		<li><a href="https://puril.net/column/soap/">・脱毛石鹸</a></li>
		<li><a href="https://puril.net/column/wax/">・ブラジリアンワックス</a></li>
		<li><a href="https://puril.net/column/mens/">・メンズ脱毛</a></li>
		<li><a href="https://puril.net/column/qa/">・脱毛QA</a></li>
		<li><a href="https://puril.net/column/campaign/">・脱毛オトク情報</a></li>
	</ul>
</div>
<div class="section_404">
	<h2 class="nolink">お問い合わせ</h2>
	<ul class="list_vertical">
		<?php
		echo "<li>". $this->Html->link('・ユーザーレビューのお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact_user']). "</li>";
		echo "<li>". $this->Html->link('・施設情報掲載のお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact']). "</li>";
		?>
	</ul>
</div>
<div class="section_404">
	<h2 class="nolink">その他</h2>
	<ul class="list_vertical">
		<?php
		echo "<li>". $this->Html->link('・プライバシーポリシー', ['controller'=> 'indexes', 'action'=> 'privacyPolicy']). "</li>";
		echo "<li>". $this->Html->link('・利用規約', ['controller'=> 'indexes', 'action'=> 'terms']). "</li>";
		?>
	</ul>
</div>