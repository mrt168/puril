<?php
use App\Vendor\Messages;
use Cake\Routing\Router;
use App\Vendor\StringUtil;
use App\Vendor\Constants;
use App\Vendor\Code\UserStatus;
use App\Vendor\Code\CodePattern;
?>
<div class="header"><h1 class="page-title">店舗一覧</h1></div>
<?php
echo $this->Flash->render();
?>
<div class="btn-toolbar list-toolbar">
	<?php
	echo $this->ExForm->create('Shops', array('url'=> array('action'=> 'search'), 'type'=> 'post'));

	$showClass = '';
	foreach ($wheres as $where) {
		if (!StringUtil::isEmpty($where)) {
			$showClass = 'in';
			break;
		}
	}
	?>
	<div class="panel panel-default">
		<a href="#page-stats" class="panel-heading" data-toggle="collapse">絞り込み</a>
		<div id="page-stats" class="panel-collapse panel-body collapse <?php echo $showClass?>" style="height: auto;">
			<?php
			echo $this->ExForm->button('<i class="fa fa-search"></i> 絞り込む', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
			<div  class='form-group'>
			<table class="table">
				<tr>
					<td width="15%">ID</td>
					<td width="35%">
						<?php
						echo $this->ExForm->text('Shop.shop_id_from', array('class'=> 'form-control inline', 'style'=>'width: 40%'));
						echo ' ～ ';
						echo $this->ExForm->text('Shop.shop_id_to', array('class'=> 'form-control inline', 'style'=>'width: 40%'));
						?>
					</td>
					<td width="15%">店舗名<span class="attention">部分一致</span></td>
					<td width="35%"><?php echo $this->ExForm->text('Shop.name', array('class'=> 'form-control inline')); ?></td>
				</tr>
				<tr>
					<td width="15%">都道府県</td>
					<td width="35%"><?php echo $this->ExForm->pref('Shop.pref', array('id'=> 'pref', 'class'=> 'form-control inline', 'style'=>'width: 30%', 'empty'=> true)); ?></td>
					<td width="15%">市区町村</td>
					<td width="35%">
						<?php
						echo $this->ExForm->input('Shop.area_id', [
								'id'=> 'area_id',
								'type'=> 'select',
								'label'=>false,
								'style'=>'width: 30%',
								'empty'=> true,
								'class'=> 'form-control',
								'disabled'=> true
						]);
						?>
					</td>
				</tr>
				<tr>
					<td width="15%">住所<span class="attention">部分一致</span></td>
					<td width="35%"><?php echo $this->ExForm->text('Shop.address', array('class'=> 'form-control inline')); ?></td>
					<td width="15%">フリーワード<span class="attention">部分一致</span></td>
					<td width="35%"><?php echo $this->ExForm->text('Shop.free_word', array('class'=> 'form-control inline')); ?></td>
				</tr>
				<tr>
					<td width="15%">施設種類</td>
					<td width="35%"><?php echo $this->ExForm->shopType('Shop.shop_type', array('type'=> 'checkbox', 'class'=> 'inline')); ?></td>
					<td width="15%">表示フラグ</td>
					<td width="35%"><?php echo $this->ExForm->showFlg('Shop.show_flg', array('type'=> 'checkbox', 'class'=> 'inline')); ?></td>
				</tr>
				<tr>
					<td width="15%">メンズ脱毛</td>
					<td width="35%"><?php echo $this->ExForm->input('Shop.mens', ['label'=>'メンズ脱毛', 'type'=> 'checkbox', 'class'=> 'inline']); ?></td>
				</tr>
			</table>
			</div>
			<?php
			echo $this->ExForm->button('<i class="fa fa-search"></i> 絞り込む', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
		</div>
	</div>
	<?php
	echo $this->ExForm->end();
	?>
</div>


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
<div>
<?php
echo $this->Html->link('CSV EXPORT', ['controller'=> 'shops', 'action'=> 'csvExport'], ['class'=> 'btn btn-primar']);
?>
</div>
<table class="table">
	<thead>
		<tr>
			<th width="50"><?php echo $this->Paginator->sort('Shops.shop_id', 'ID', ['direction' => 'desc']);?></th>
			<th width="100">店舗名</th>
			<th width="120">店舗種類</th>
			<th width="120">都道府県/市区町村</th>
			<th width="200">住所</th>
			<th width="150">駅</th>
			<th width="120">画像<br>画像更新日</th>
			<th width="100">スタッフ</th>
			<th width="100">インタビュー</th>
			<th width="100">お知らせ</th>
			<th width="100">ブログ</th>
			<th width="80">表示/非表示</th>
			<th width="120"><?php echo $this->Paginator->sort('Shops.modified', '更新日', ['direction' => 'desc']);?></th>
			<th style="width: 4.0em;"></th>
		</tr>
	</thead>
	<tbody class='trhover'>
		<?php
		foreach ($shops as $shop) {
		?>
		<tr>
			<td>
				<?php
				echo $this->Html->link($shop['shop_id'], array('controller'=> 'shops', 'action'=> 'detail', $shop['shop_id']), array('class'=> 'btn btn-primary'));
				?>
			</td>
			<td><?php echo $shop['name']?></td>
			<td>
				<?php
				echo $shop['shop_type'];
				if (!empty($shop['ShopOtherCondition']['other_condition_id'])) {
					echo "<br><font color='#A9D0F5'>メンズ脱毛</font>";
				}
				?>
			</td>
			<td><?php echo $shop['pref']. " / ". $shop['Area']['name']?></td>
			<td><?php echo $shop['address']?></td>
			<td>
				<?php
				if (!empty($shop['station_name'])) {
					foreach ($shop['station_name'] as $stationName) {
						echo "・".$stationName."<br>";
					}
				}
				?>
			</td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-image"></i>', ['controller'=> 'shops', 'action'=> 'moveImgEdit', $shop['shop_id']], ['target'=> '_blank', 'escape'=> false]);
				echo "（". $shop['imgCnt']. "）";
				if (!empty($shop['imgModified'])) {
					echo "<br>";
					echo date('Y/m/d H:i', strtotime($shop['imgModified']));
				}
				?>
			</td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-user"></i>', ['controller'=> 'shops', 'action'=> 'moveStaffRegist', $shop['shop_id']], ['target'=> '_blank', 'escape'=> false]);
				echo "（". $shop['staffCnt']. "）";
				?>
			</td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-microphone"></i>', ['controller'=> 'shops', 'action'=> 'moveInterviewRegist', $shop['shop_id']], ['target'=> '_blank', 'escape'=> false]);
				echo "（". $shop['interviewCnt']. "）";
				?>
			</td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-info-circle"></i>', ['controller'=> 'shops', 'action'=> 'moveInfoRegist', $shop['shop_id']], ['target'=> '_blank', 'escape'=> false]);
				echo "（". $shop['infoCnt']. "）";
				?>
			</td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-file-text"></i>', ['controller'=> 'shops', 'action'=> 'moveBlogRegist', $shop['shop_id']], ['target'=> '_blank', 'escape'=> false]);
				echo "（". $shop['blogCnt']. "）";
				?>
			</td>
			<td><?php echo $shop['show_flg']?></td>
			<td><?php echo date('Y/n/d H:i', strtotime($shop['modified']))?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller'=> 'shops', 'action'=> 'moveEdit', $shop['shop_id']), array('escape'=> false));
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('controller'=> 'shops', 'action'=> 'delete', $shop['shop_id']), array('escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
				?>
			</td>
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
	echo $this->Paginator->counter('<p>(<span>{{count}} 件中 </span> <span>{{start}}件～{{end}}件</span> を表示)');
} else {
	echo '<div class="attention">店舗が登録されていません</div>';
}
?>

<script>
$(function() {
	$('#pref').change(function() {
	    var pref = $(this).val();
	    $.ajax({
			url: '<?php echo Router::url(array('controller'=> 'shops', 'action'=> 'getArea'))?>',
			type: 'post',
			data: {pref: pref},
			dataType: 'json',
	        success: function(result, textStatus, xhr) {
		        if (result != "empty") {
					$('#area_id > option').remove();
					$('#area_id').append($('<option>').html("").val(""));
		        	$.each(result, function(i, data) {
						var area_id = data.area_id;
						var name = data.name;

						$('#area_id').append($('<option>').html(name).val(area_id));
		        	});
		        	$('#area_id').prop('disabled', false);
		        }
	        }
	    });
	}).eq(0).trigger('change');
})
</script>
