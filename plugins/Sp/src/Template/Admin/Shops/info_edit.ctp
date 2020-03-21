<?php
use Cake\Routing\Router;
use App\Vendor\Messages;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\CodePattern;
?>
<div class="header">
	<h1 class="page-title">
	<?php
	echo "{$shop['name']}(ID:{$shop['shop_id']})";
	?>
	お知らせ登録
	</h1>
</div>
<?php
echo $this->Flash->render();
if (empty($info)) {
	$info = "Infos";
}
echo $this->ExForm->create($info, array('url'=> array('action'=> 'infoEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="form-group">
		<label>日付</label><br>
		<?php
		echo $this->ExForm->text('Infos.date', ['id'=> 'date', 'class'=> 'form-control inline datetimepicker', 'style'=>'width: 250px']);
		echo $this->ExForm->error('Infos.date');
		?>
	</div>
	<div class="form-group">
		<label>タイトル<span class="required-mark">※</span></label><br>
		<?php
		echo $this->ExForm->text('Infos.title', ['id'=> 'title', 'class'=> 'form-control inline', 'style'=> 'width: 250px;']);
		echo $this->ExForm->error('Infos.title');
		?>
	</div>
	<div class="form-group">
		<label>本文<span class="required-mark">※</span></label><br>
		<?php
		echo $this->ExForm->textarea('Infos.content', ['id'=> 'content', 'class'=> 'form-control', 'style'=> 'width: 500px;']);
		echo $this->ExForm->error('Infos.content');
		?>
	</div>
</div>
<?php
echo $this->ExForm->hidden('Infos.shop_id');
echo $this->ExForm->hidden('Infos.info_id');
if (isset($this->request->data['Infos']['info_id']) && !empty($this->request->data['Infos']['info_id'])) {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
} else {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
}


echo $this->ExForm->end();
?>
<?php
if (!empty($infos->toArray())) {
?>
<hr>
<h2>お知らせ一覧</h2>
<table class="table">
	<thead>
		<tr>
			<th width="200">日付</th>
			<th width="200">タイトル</th>
			<th width="500">本文</th>
			<th></th>
		</tr>
		<?php
		foreach ($infos as $info) {
		?>
		<tr>
			<td><?php echo $info['date']?></td>
			<td><?php echo $info['title']?></td>
			<td><?php echo nl2br(htmlspecialchars($info['content']));?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=> 'shops', 'action'=> 'moveInfoEdit', $info['shop_id'], $info['info_id']], ['escape'=> false]);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', ['controller'=> 'shops', 'action'=> 'deleteInfo', $info['shop_id'], $info['info_id']], ['escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE]);
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