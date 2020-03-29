<?php
use Cake\Routing\Router;
use App\Vendor\Messages;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ImagePositionType;
?>
<div class="header">
	<h1 class="page-title">
	<?php
	echo "{$shop['name']}(ID:{$shop['shop_id']})";
	?>
	インタビュー登録
	</h1>
</div>

<?php
echo $this->Flash->render();
if (empty($interview)) {
	$interview = "Interviews";
}
echo $this->ExForm->create($interview, array('url'=> array('action'=> 'interviewEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>

<div class="btn-toolbar list-toolbar" style="background-color : #F2F2F2;">
	<div class="form-group">
		<label>インタビュータイトル</label><br>
		<?php
		echo $this->ExForm->text('Shops.interview_title', array('id'=> 'interview_title', 'class'=> 'form-control', 'style'=> 'width: 500px;'));
		echo $this->ExForm->error('Shops.interview_title');
		?>
	</div>
	<div class="form-group">
		<label>インタビューアイキャッチ画像</label><br>
		<?php
		if (!empty($this->request->data['Shops']['interview_image_path'])) {
			$url = Router::url(array('controller'=> 'shops', 'action'=> 'imageInterviewShop', $this->request->data['Shops']['shop_id']));
			echo "<img src='{$url}' height='80'>";
			echo $this->Html->link('<i class="fa fa-remove"></i>', ['controller'=> 'shops', 'action'=> 'interviewImgDelete', $this->request->data['Shops']['shop_id']], ['escape'=> false, 'confirm'=> "画像を".Messages::CONFIRM_DELETE]);
		}
		echo $this->ExForm->file("Shops.interview_image_file", array('id'=> "interview_image_file", 'class'=> 'form-control', 'style'=> 'width: 250px;'));
		?>
	</div>
	<div class="form-group">
		<label>動画URL</label><br>
		<?php
		echo $this->ExForm->text('Shops.interview_video_url', array('id'=> 'interview_video_url', 'class'=> 'form-control', 'style'=> 'width: 500px;'));
		echo $this->ExForm->error('Shops.interview_video_url');
		?>
	</div>
	<?php
	echo $this->ExForm->hidden('Shops.shop_id');
	echo $this->ExForm->button('<i class="fa fa-pencil"></i> 編集', array('name'=> 'shop_edit', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
	?>
</div>

<hr>
<?php
echo $this->Flash->render('interview');
?>
<h2>インタビュー内容</h2>
<div class="btn-toolbar list-toolbar">
	<div class="form-group">
		<label>インタビュー画像</label><br>
		<?php
		echo $this->ExForm->file("Interviews.image_file", array('id'=> "image_file", 'class'=> 'form-control', 'style'=> 'width: 250px;'));
		?>
	</div>
	<div class="form-group">
		<label>画像表示位置</label><br>
		<?php
		echo $this->ExForm->imagePositionType('Interviews.image_position_type', ['id'=> 'image_position_type', 'class'=> 'inline', 'type'=> 'radio', 'default'=> ImagePositionType::$RIGHT[CodePattern::$CODE]]);
		echo $this->ExForm->error('Interviews.image_position_type');
		?>
	</div>
	<div class="form-group">
		<label>タイトル</label><br>
		<?php
		echo $this->ExForm->text('Interviews.title', array('id'=> 'title', 'class'=> 'form-control', 'style'=> 'width: 500px;'));
		echo $this->ExForm->error('Interviews.title');
		?>
	</div>
	<div class="form-group">
		<label>本文</label><br>
		<?php
		echo $this->ExForm->textarea('Interviews.content', array('id'=> 'content', 'class'=> 'form-control', 'style'=> 'width: 500px;'));
		echo $this->ExForm->error('Interviews.content');
		?>
	</div>
</div>
<?php
echo $this->ExForm->hidden('Interviews.shop_id');
echo $this->ExForm->hidden('Interviews.interview_id');
if (isset($this->request->data['Interviews']['interview_id']) && !empty($this->request->data['Interviews']['interview_id'])) {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
} else {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
}


echo $this->ExForm->end();
?>
<?php
if (!empty($interviews->toArray())) {
?>
<hr>
<h2>インタビュー一覧</h2>
<table class="table">
	<thead>
		<tr>
			<th width="200"></th>
			<th width="200">画像表示位置</th>
			<th width="200">タイトル</th>
			<th width="500">説明文</th>
			<th></th>
		</tr>
		<?php
		foreach ($interviews as $interview) {
		?>
		<tr>
			<td>
			<?php
			$url = Router::url(array('controller'=> 'shops', 'action'=> 'imageInterview', $interview['interview_id']));
			if (!empty($interview['image_path'])) {
				echo "<img src='{$url}' height='80'>";
			}
			?>
			</td>
			<td><?php echo ImagePositionType::convert($interview['image_position_type'], CodePattern::$VALUE)?></td>
			<td><?php echo $interview['title']?></td>
			<td><?php echo nl2br($interview['content']);?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=> 'shops', 'action'=> 'moveInterviewEdit', $interview['shop_id'], $interview['interview_id']], ['escape'=> false]);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', ['controller'=> 'shops', 'action'=> 'deleteInterview', $interview['shop_id'], $interview['interview_id']], ['escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE]);
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