<?php
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;
?>
<script src="//maps.googleapis.com/maps/api/js?key=AIzaSyCMXTyYIMqJTZPtem60iMfu3ZKYn3Nj0wI"></script>
<div id="bread">
	<div class="inner cf">
		<span class="breaditem"><a href="<?=Router::url('/')?>"><span>TOP</span></a></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>全国の脱毛施設</span>", ['controller'=> 'searchs'], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>全国の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>{$shop['pref']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>{$shop['Area']['name']}の".ShopType::convert($shop['shop_type'], CodePattern::$VALUE)."</span>", ['controller'=> 'searchs', 'action'=> 'search', $shop['PrefData']['url_text'], URLUtil::CITY.$shop['Area']['area_id'], ShopType::convert($shop['shop_type'], CodePattern::$VALUE2)], ['escape'=> false])?></span>
		<span class="breaditem"><?php echo $this->Html->link("<span>{$shop['name']}</span>", ['controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']], ['escape'=> false]);?></span>
		<span class="breaditem"><?php echo $this->Html->link('<span>ブログ</span>', ['controller'=> 'shops', 'action'=> 'blogIndex', 'shop_id'=> $shop['shop_id']], ['escape'=> false]);?></span>
		<span class="breaditem"><?=$blog['title']?></span>
	</div>
</div>
<div id="container">
	<div class="inner">
		<div class="undercontentwrap cf">
			<main id="maincolumn">
				<div class="commonyellowbox">
					<div id="columdtwarp">
						<h1 class="columntit_01"><?=$blog['title']?></h1>
						<div class="brogday"><span><?= !empty($blog['date']) ? date('Y.m.d', strtotime($blog['date'])) : null?></span></div>
						<?php
						if (!empty($blog['image_path'])) {
						?>
						<div class="eyecat">
							<?php
							$imgUrl = Router::url(['controller'=> 'images', 'action'=> 'blogImage', $blog['blog_id']]);
							?>
							<img src="<?=$imgUrl?>" class="attachment-full size-full wp-post-image" alt="" srcset="<?=$imgUrl?> 750w, <?=$imgUrl?> 300w" sizes="(max-width: 750px) 100vw, 750px" />
						</div>
						<?php
						}
						?>
						<div class="editorwrap">
							<?php echo $blog['content']?>
						</div>
						<?php /**
						<div class="editorwrap">
							<p>
							テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキスト。<br>
							<b><span class="borderline-yellow">テキストテキストテキストテキストテキストテキストテキストテキスト</span></b>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキストテキスト
							</p>

							<h2>h2タイトルタイトルタイトルタイトル</h2>
							<p>
							テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキスト。<br>
							<span class="font-red">テキストテキストテキスト</span>テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキストテキスト
							</p>

							<h3>h3タイトルタイトルタイトルタイトル</h3>
							<p>
							テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキストテキスト。<br>
							テキストテキストテキストテキストテキストテキストテキストテキスト
							</p>
						</div>
						*/?>
						<?php
						echo $this->Html->link('一覧ページへ戻る', ['controller'=> 'shops', 'action'=> 'blogIndex', 'shop_id'=> $blog['shop_id']], ['class'=> 'back']);
						?>
					</div>
				</div>
			</main>
			<?= $this->element('Front/SearchResult/side')?>
		</div>
	</div>
</div>
<?php
if (!empty($shop['affiliate_page_url'])) {
?>
<div id="dtfixbtnarea">
	<a href="<?php echo $shop['affiliate_page_url']?>" class="green" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">公式サイトへ</a>
</div>
<?php
}
?>