<?php
use App\Vendor\Messages;

echo $this->Flash->render();
?>
<br>
<div class="btn-toolbar list-toolbar">
	<?php
	echo $this->Html->link('<i class="fa fa-plus"></i> 新規登録', array('controller'=> 'administrators', 'action'=> 'move_regist'), array('class'=> 'btn btn-primary', 'escape'=> false));
	?>
	<div class="btn-group"></div>
</div>
<table class="table">
	<thead>
		<tr>
			<th>ID</th>
			<th>管理者名</th>
			<th style="width: 4.0em;"></th>
		</tr>
	</thead>
	<tbody>
		<?php
		foreach ($administratorDatas as $administratorData) {
		?>
		<tr>
			<td><?php echo $administratorData['administrator_id']?></td>
			<td><?php echo $administratorData['name']?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller'=> 'administrators', 'action'=> 'move_edit', $administratorData['administrator_id']), array('escape'=> false));
				echo '&nbsp;&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('controller'=> 'administrators', 'action'=> 'delete', $administratorData['administrator_id']), array('escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
				?>
			</td>
		</tr>
		<?php
		}
		?>
	</tbody>
</table>
