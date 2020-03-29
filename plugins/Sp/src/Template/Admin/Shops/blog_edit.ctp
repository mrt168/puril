<?php
use Cake\Routing\Router;
use App\Vendor\Messages;
?>
<div class="header">
	<h1 class="page-title">
	<?php
	echo "{$shop['name']}(ID:{$shop['shop_id']})";
	?>
	ブログ登録
	</h1>
</div>
<?php
echo $this->Flash->render();
if (empty($blog)) {
	$blog = "Blogs";
}
echo $this->ExForm->create($blog, array('url'=> array('action'=> 'blogEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="form-group">
		<label>ブログ画像</label><br>
		<?php
		echo $this->ExForm->file("Blogs.image_file", array('id'=> "image_file", 'class'=> 'form-control', 'style'=> 'width: 250px;'));
		?>
	</div>
	<div class="form-group">
		<label>日付</label><br>
		<?php
		echo $this->ExForm->text('Blogs.date', ['id'=> 'date', 'class'=> 'form-control inline datetimepicker', 'style'=>'width: 250px']);
		echo $this->ExForm->error('Blogs.date');
		?>
	</div>
	<div class="form-group">
		<label>タイトル<span class="required-mark">※</span></label><br>
		<?php
		echo $this->ExForm->text('Blogs.title', ['id'=> 'title', 'class'=> 'form-control inline', 'style'=> 'width: 250px;']);
		echo $this->ExForm->error('Blogs.title');
		?>
	</div>
	<div class="form-group">
		<label>本文<span class="required-mark">※</span></label><br>
		<?php
		echo $this->ExForm->textarea('Blogs.content', ['id'=> 'content', 'class'=> 'form-control', 'style'=> 'width: 500px;']);
		echo $this->ExForm->error('Blogs.content');
		?>
	</div>
</div>
<?php
echo $this->ExForm->hidden('Blogs.shop_id');
echo $this->ExForm->hidden('Blogs.blog_id');
if (isset($this->request->data['Blogs']['blog_id']) && !empty($this->request->data['Blogs']['blog_id'])) {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
} else {
	echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
}


echo $this->ExForm->end();
?>
<?php
if (!empty($blogs->toArray())) {
?>
<hr>
<h2>ブログ一覧</h2>
<table class="table">
	<thead>
		<tr>
			<th width="200"></th>
			<th width="200">日付</th>
			<th width="250">タイトル</th>
			<th width="500">本文</th>
			<th></th>
		</tr>
		<?php
		foreach ($blogs as $blog) {
		?>
		<tr>
			<td>
			<?php
			$url = Router::url(array('controller'=> 'shops', 'action'=> 'imageBlog', $blog['blog_id']));
			if (!empty($blog['image_path'])) {
				echo "<img src='{$url}' height='80'>";
			}
			?>
			</td>
			<td><?php echo $blog['date']?></td>
			<td><?php echo $blog['title']?></td>
			<td><?php echo nl2br(htmlspecialchars($blog['content']));?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', ['controller'=> 'shops', 'action'=> 'moveBlogEdit', $blog['shop_id'], $blog['blog_id']], ['escape'=> false]);
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', ['controller'=> 'shops', 'action'=> 'deleteBlog', $blog['shop_id'], $blog['blog_id']], ['escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE]);
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