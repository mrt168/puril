<?php
use App\Vendor\Messages;
?>
<div class="header"><h1 class="page-title">ブランドの詳細画面</h1></div>
<?php
echo $this->Flash->render();
echo $this->Html->link('<i class="fa fa-chevron-left"></i> 一覧に戻る', ['controller'=> 'brands', 'action'=> 'index'], array('class'=> 'btn btn-primary', 'escape'=> false));
?>
<div class="row">
	<div class="col-md-7">
		<table class="table">
			<tr>
				<th width=350>ID</th>
				<td><?php echo $brand['brand_id']?></td>
			</tr>
			<tr>
				<th>ブランド名</th>
				<td><?php echo $brand['name']?></td>
			</tr>
			<tr>
				<th></th>
				<td>
					<?php
					echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller'=> 'brands', 'action'=> 'moveEdit', $brand['brand_id']), array('class'=> 'btn btn-primary', 'escape'=> false));
					echo '&nbsp;&nbsp;&nbsp;';
					echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('controller'=> 'brands', 'action'=> 'delete', $brand['brand_id']), array('class'=> 'btn btn-primary', 'escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
					?>
				</td>
			</tr>
		</table>
	</div>
</div>

