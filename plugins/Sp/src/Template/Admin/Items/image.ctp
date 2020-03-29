<?php
use App\Vendor\Code\AreaType;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
use App\Vendor\Messages;
?>
<div class="header"><h1 class="page-title">画像管理</h1></div>
<?php
echo $this->Flash->render();
if (empty($image)) {
	$image = "ShopImages";
}
echo $this->ExForm->create($image, array('url'=> array('action'=> 'imgEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="panel panel-default">
		<table class="table">
			<tr>
				<th width="120">画像</th>
				<td width="300">
					<?php
					echo $this->ExForm->file("Images.image_file", array('id'=> "image_file", 'class'=> 'form-control'));
					?>
				</td>
				<td>
					<?php
					echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php
echo $this->ExForm->end();
if (!empty($imageDatas) && count($imageDatas) != 0) {
?>

<hr>
<?php
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
<table class="table">
	<thead>
		<tr>
			<th width="200">画像</th>
			<th width="200">path</th>
			<th></th>
		</tr>
		<?php
		foreach ($imageDatas as $imageData) {
		?>
		<tr>
			<td>
			<?php
			$url = Router::url(array('controller'=> 'items', 'action'=> 'imageView', $imageData['image_id']));
			echo "<img src='{$url}' height='80'>";
			?>
			</td>
			<td>
				<?php
				$url = Router::url('/img/'. $imageData['image_id']);
				echo $url;
				?>
			</td>
			<td>
			<?php
			echo $this->Html->link('<i class="fa fa-remove"></i>', array('controller'=> 'items', 'action'=> 'imgDelete', $imageData['image_id']), array('escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
			?>
			</td>
		</tr>
		<?php
		}
		?>
	</thead>
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
	echo '<div class="attention">画像が登録されていません</div>';
}
?>
