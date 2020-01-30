<?php
use App\Vendor\Code\AreaType;
use App\Vendor\Code\CodePattern;
?>
<div class="header"><h1 class="page-title">駅一覧</h1></div>
<?php
echo $this->ExForm->create('Menu', array('url'=> array('action'=> 'stationSearch'), 'type'=> 'post'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="panel panel-default">
		<table class="table">
			<tr>
				<th width="120">都道府県</th>
				<td width="200">
					<?php
					echo $this->ExForm->pref('pref', array('class' => 'form-control', 'empty'=> '選択して下さい'));
					?>
				</td>
				<td>
					<?php
					echo $this->ExForm->button('<i class="fa fa-search"></i> 検 索', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php
echo $this->ExForm->end();
echo $this->Flash->render();

if (!empty($stations) && count($stations) != 0) {
?>

<hr>
<table class="table">
	<thead>
		<tr>
			<th width="80">ID</th>
			<th width="200">名前</th>
			<th>HTML</th>
		</tr>
		<?php
		foreach ($stations as $station) {
		?>
		<tr>
			<td><?php echo $station['station_cd']?></td>
			<td><?php echo $station['station_name']?>駅</td>
			<td>
			<?php
			echo $this->Html->link('HTML編集', ['controller'=> 'items', 'action'=> 'moveStationEdit', $station['station_cd']], array('class'=> 'btn btn-primary', 'escape'=> false));
			?>
			</td>
		</tr>
		<?php
		}
		?>
	</thead>
</table>
<?php
}
?>