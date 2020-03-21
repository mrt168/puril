<?php
use Cake\Routing\Router;
?>
<style>
#error_msg {
	color: red;
}
</style>

<div class="header"><h1 class="page-title">駅抽出</h1></div>
<?php
echo $this->ExForm->create('Shops', array('url'=> array('action'=> 'extraction_search'), 'type'=> 'post'));
?>
<div>駅名<span class="attention">部分一致</span></div>
<div>
	<?php
	echo $this->ExForm->text('Stations.station_name', array('class'=> 'form-control inline', 'style'=> 'width: 60%'));
	echo '&nbsp;';
	echo $this->ExForm->button('<i class="fa fa-search"></i> 絞り込む', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
	?>
</div>
<?php
if (!empty($shopId)) {
	echo $this->ExForm->hidden('Stations.shop_id', ['value'=> $shopId]);
}
echo $this->ExForm->end();
?>

<hr>

<?php
if (!empty($stations)) {
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
<div id="error_msg"></div><br>
<?php
echo $this->ExForm->button('選択', array('name'=> 'check', 'class'=> 'btn btn-primary select-station', 'type'=> 'submit'));
?>
<table class="table">
	<thead>
		<tr>
			<th width="20"></th>
			<th width="90">都道府県</th>
			<th width="120">鉄道会社/路線/駅名</th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($stations as $station) {
		?>
		<tr>
			<td>
				<?php
				/**
				echo $this->Html->link('選択', '/',
						[
								'escape'=> false,
								'class'=> 'btn btn-primary select-station',
								'data-station-cd'=> $station['station_cd'],
								'data-station-name'=> "{$station['Company']['company_name']}/{$station['Line']['line_name']}/{$station['station_name']}駅"
				]);
				echo '&nbsp;&nbsp;&nbsp;';
				*/

				if (empty($station['ShopStation']['station_cd'])) {
					echo $this->ExForm->checkbox('station_cd',
							[
									'value'=> $station['station_cd'],
									'class'=> 'station_cd',
									'data-station-name'=> "{$station['Company']['company_name']}/{$station['Line']['line_name']}/{$station['station_name']}駅",
									'label'=>false,
							]
					);
				} else {
					echo "選択済み";
				}

				?>
			</td>
			<td><?php echo $station['pref_cd']?></td>
			<td><?php echo "{$station['Company']['company_name']}/{$station['Line']['line_name']}/{$station['station_name']}"?>駅</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
<?php
echo $this->ExForm->button('選択', array('name'=> 'check', 'class'=> 'btn btn-primary select-station', 'type'=> 'submit'));
?>
<br>
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
	if (isset($userDatas)) {
		echo '<div class="attention">駅が見つかりませんでした</div>';
	}
}
?>

<script type="text/javascript">
$(function() {

	$('.select-station').click(function() {
		var reg_station_cds = [];
		$('#error_msg').text("");
		window.opener.$('.station_cd').map(function() {
			reg_station_cds.push($(this).val())
		});

		var isClose = true;
		$('.station_cd:checked').map(function() {
			var stationCd = $(this).val();
			var stationName = $(this).data('station-name');

			var r = $.inArray(stationCd, reg_station_cds);
			if (r !== -1) {
				isClose = false;
				$('#error_msg').append(stationName + "は選択済みです<br>");
				return ;
			}

			window.opener.document.getElementById('station_cd').innerHTML += '<input type="hidden" name="ShopStations[station_cds][]" value="' + stationCd + '" class="station_cd station_cd'+ stationCd +'">';
			window.opener.document.getElementById('station_cd').innerHTML += '<p class="station_cd'+ stationCd +'">・' + stationName + '  <a onclick="deleteStation('+ stationCd +')"><i class="fa fa-times-circle-o"></i></a></p>';
		});

		if (isClose) {
			window.close();
			return false;
		}
	});

	<?php
	/**
	$('.select-station').click(function() {
		var stationCd = $(this).data('station-cd');
		var stationName = $(this).data('station-name');
		window.opener.document.getElementById('station_cd').innerHTML += '<input type="hidden" name="ShopStations[station_cds][]" value="' + stationCd + '" class="station_cd'+ stationCd +'">';
		window.opener.document.getElementById('station_cd').innerHTML += '<p class="station_cd'+ stationCd +'">・' + stationName + '  <a onclick="deleteStation('+ stationCd +')"><i class="fa fa-times-circle-o"></i></a></p>';

		window.opener.document.getElementById('station_cd').value = stationCd;
		window.opener.document.getElementById('station_name').value = stationName;
		window.close();
		return false;
	});
	*/?>

});
</script>

