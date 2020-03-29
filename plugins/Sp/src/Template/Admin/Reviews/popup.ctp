<?php
use Cake\Routing\Router;
?>
<div class="header"><h1 class="page-title">店舗抽出</h1></div>
<?php
echo $this->ExForm->create('Reviews', array('url'=> array('action'=> 'extraction_search'), 'type'=> 'post'));
?>
<div>店舗名<span class="attention">部分一致</span></div>
<div>
	<?php
	echo $this->ExForm->text('Shops.name', array('class'=> 'form-control inline', 'style'=> 'width: 60%'));
	?>
</div>
<div>店舗種類</div>
<div>
	<?php
	echo $this->ExForm->shopType('Shops.shop_type', array('type'=> 'checkbox', 'class'=> 'inline'));
	echo $this->ExForm->input('Shops.mens', ['label'=>'メンズ脱毛', 'type'=> 'checkbox', 'class'=> 'inline']);
	?>
</div>
<div>
	<?php
	echo $this->ExForm->button('<i class="fa fa-search"></i> 絞り込む', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
	?>
</div>
<?php
echo $this->ExForm->end();
?>

<hr>

<?php
if (!empty($shops)) {
	echo $this->Paginator->counter('<p>(<span>{{count}} 件中 </span> <span>{{start}}件～{{end}}件</span> を表示)');
?>
<ul class="pagination">
	<?php
	if ($this->Paginator->hasPrev()) {
		echo $this->Paginator->prev('<<', array('rel'=> 'prev', 'class'=> 'prev', 'tag'=> 'li'));
	}
	echo $this->Paginator->numbers(array('separator'=> false, 'tag'=> 'li'));
	if ($this->Paginator->hasNext()) {
		echo $this->Paginator->next('>>', array('rel'=> 'next', 'class'=> 'next', 'tag'=> 'li'));
	}
	?>
</ul>
<table class="table">
	<thead>
		<tr>
			<th width="60"></th>
			<th width="90">ID</th>
			<th width="90">店舗名</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($shops as $shop) {
		?>
		<tr>
			<td>
				<?php
				echo $this->Html->link('選択', '/',
						[
								'escape'=> false,
								'class'=> 'btn btn-primary select-station',
								'data-shop-id'=> $shop['shop_id'],
								'data-shop-name'=> $shop['name'],
				]);
				?>
			</td>
			<td><?php echo $shop['shop_id']?></td>
			<td><?php echo $shop['name']?></td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<ul class="pagination">
	<?php
	if ($this->Paginator->hasPrev()) {
		echo $this->Paginator->prev('<<', array('rel'=> 'prev', 'class'=> 'prev', 'tag'=> 'li'));
	}
	echo $this->Paginator->numbers(array('separator'=> false, 'tag'=> 'li'));
	if ($this->Paginator->hasNext()) {
		echo $this->Paginator->next('>>', array('rel'=> 'next', 'class'=> 'next', 'tag'=> 'li'));
	}
	?>
</ul>
<?php
} else {
	if (isset($shops)) {
		echo '<div class="attention">店舗が見つかりませんでした</div>';
	}
}
?>

<script type="text/javascript">
$(function() {
  $('.select-station').click(function() {
	  var shopId = $(this).data('shop-id');
	  var shopName = $(this).data('shop-name');
	  window.opener.document.getElementById('shop_id').value = shopId;
	  window.opener.document.getElementById('shop_name').value = shopName;
	  window.close();
	  return false;
  });
});
</script>

