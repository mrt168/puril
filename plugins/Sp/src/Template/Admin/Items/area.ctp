<?php
use App\Vendor\Code\AreaType;
use App\Vendor\Code\CodePattern;
?>
<div class="header"><h1 class="page-title">市区町村一覧</h1></div>
<?php
echo $this->ExForm->create('Menu', array('url'=> array('action'=> 'areaSearch'), 'type'=> 'post'));
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

if (!empty($areas) && count($areas) != 0) {
?>

<hr>
<table class="table">
	<thead>
		<tr>
			<th width="80">ID</th>
			<th width="200">名前</th>
			<th width="200">市区町村タイプ</th>
			<th>HTML</th>
		</tr>
		<?php
		foreach ($areas as $area) {
			$designated = $area['area_type'] == AreaType::$DESIGNATED[CodePattern::$VALUE] ? ' style="background: #F3F781"' : null;
		?>
		<tr<?php echo $designated?>>
			<td><?php echo $area['area_id']?></td>
			<td><?php echo $area['name']?></td>
			<td><?php echo $area['area_type']?></td>
			<td>
			<?php
			echo $this->Html->link('HTML編集', ['controller'=> 'items', 'action'=> 'moveAreaEdit', $area['area_id']], array('class'=> 'btn btn-primary', 'escape'=> false));
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