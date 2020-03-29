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
	スタッフ登録
	</h1>
</div>
<?php
echo $this->Flash->render();
if (empty($staff)) {
	$staff = "Staffs";
}
echo $this->ExForm->create($staff, array('url'=> array('action'=> 'staffEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="form-group">
		<label>スタッフ画像</label><br>
		<?php
		echo $this->ExForm->file("Staffs.image_file", array('id'=> "image_file", 'class'=> 'form-control', 'style'=> 'width: 250px;'));
		?>
	</div>
	<div class="form-group">
		<label>スタッフ名 / ふりがな<span class="required-mark">※</span></label><br>
		<?php
		echo $this->ExForm->text('Staffs.name', ['id'=> 'name', 'class'=> 'form-control inline', 'style'=> 'width: 250px;', 'placeholder'=> '名前']);
		echo '&nbsp;&nbsp;&nbsp;';
		echo $this->ExForm->text('Staffs.name_kana', ['id'=> 'name_kana', 'class'=> 'form-control inline', 'style'=> 'width: 250px;', 'placeholder'=> 'ふりがな']);
		echo $this->ExForm->error('Staffs.name');
		echo $this->ExForm->error('Staffs.name_kana');
		?>
	</div>
	<div class="form-group">
		<label>SNSアカウント</label><br>
		<?php
		echo "Instagram：". $this->ExForm->text('Staffs.instagram_account', array('id'=> 'instagram_accout', 'class'=> 'form-control inline', 'style'=> 'width: 250px;', 'placeholder'=> 'Instagram'));
		echo '&nbsp;&nbsp;&nbsp;';
		echo "Twitter：".$this->ExForm->text('Staffs.twitter_account', array('id'=> 'twitter_accout', 'class'=> 'form-control inline', 'style'=> 'width: 250px;', 'placeholder'=> 'Twitter'));
		echo $this->ExForm->error('Staffs.instagram_account');
		echo $this->ExForm->error('Staffs.twitter_account');
		echo "<br><br>";
		echo "Facebook：". $this->ExForm->text('Staffs.facebook_account', array('id'=> 'facebook_account', 'class'=> 'form-control inline', 'style'=> 'width: 250px;', 'placeholder'=> 'Facebook'));
		echo '&nbsp;&nbsp;&nbsp;';
		echo "ブログ：".$this->ExForm->text('Staffs.blog_account', array('id'=> 'blog_account', 'class'=> 'form-control inline', 'style'=> 'width: 250px;', 'placeholder'=> 'ブログ'));
		echo $this->ExForm->error('Staffs.facebook_account');
		echo $this->ExForm->error('Staffs.blog_account');
		?>
	</div>
	<div class="form-group">
		<label>説明文</label><br>
		<?php
		echo $this->ExForm->textarea('Staffs.description', array('id'=> 'description', 'class'=> 'form-control', 'style'=> 'width: 500px;'));
		echo $this->ExForm->error('Staffs.description');
		?>
	</div>
</div>
<?php
echo $this->ExForm->hidden('Staffs.shop_id');
echo $this->ExForm->hidden('Staffs.staff_id');
if (isset($this->request->data['Staffs']['staff_id']) && !empty($this->request->data['Staffs']['staff_id'])) {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
} else {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
}


echo $this->ExForm->end();
?>
<?php
if (!empty($staffs->toArray())) {
?>
<hr>
<h2>スタッフ一覧</h2>
<table class="table">
	<thead>
		<tr>
			<th width="200"></th>
			<th width="200">スタッフ名</th>
			<th width="250">SNSアカウント</th>
			<th width="500">説明文</th>
			<th></th>
		</tr>
		<?php
		foreach ($staffs as $staff) {
		?>
		<tr>
			<td>
			<?php
			$url = Router::url(array('controller'=> 'shops', 'action'=> 'imageStaff', $staff['staff_id']));
			if (!empty($staff['image_path'])) {
				echo "<img src='{$url}' height='80'>";
			}
			?>
			</td>
			<td><?php echo $staff['name']?> / <?php echo $staff['name_kana']?></td>
			<td>
				<?php
				echo !empty($staff['instagram_account']) ? "Instagram：".$staff['instagram_account']."<br>" : null;
				echo !empty($staff['twitter_account']) ? "Twitter：".$staff['twitter_account']."<br>" : null;
				echo !empty($staff['facebook_account']) ? "Facebook：". $staff['facebook_account']."<br>" : null;
				echo !empty($staff['blog_account']) ? "ブログ：". $staff['blog_account'] : null;
				?>
			</td>
			<td><?php echo nl2br($staff['description']);?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=> 'shops', 'action'=> 'moveStaffEdit', $staff['shop_id'], $staff['staff_id']], ['escape'=> false]);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', ['controller'=> 'shops', 'action'=> 'deleteStaff', $staff['shop_id'], $staff['staff_id']], ['escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE]);
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