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
	店舗画像登録
	</h1>
</div>
<?php
echo $this->Flash->render();
if (empty($shopImg)) {
	$shopImg = "ShopImages";
}
echo $this->ExForm->create($shopImg, array('url'=> array('action'=> 'imgEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="panel panel-default">
		<table class="table">
			<tr>
				<th width="120">店舗画像</th>
				<td width="300">
					<?php
					echo $this->ExForm->file("ShopImages.image_file", array('id'=> "image_file", 'class'=> 'form-control'));
					?>
				</td>
				<td width="300 form-group">
					<div class="form-group">
					<?php
					echo $this->ExForm->imageType("ShopImages.image_type", array('id'=> "image_type", 'class'=> 'inline', 'type'=> 'radio', 'default'=> ImageType::$MAIN[CodePattern::$CODE]));
					?>
					</div>
				</td>
				<td>
					<?php
					echo $this->ExForm->hidden('ShopImages.shop_id');
					echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php
if (!empty($shopImgs) && count($shopImgs) != 0) {
?>
<h2>メイン画像(ギャラリー)</h2>
<table class="table">
	<thead>
		<tr>
			<th width="200"></th>
			<th width="100">優先順位</th>
			<th width="100">テキスト</th>
			<th width="150">更新日</th>
			<th></th>
		</tr>
		<?php
		foreach ($shopImgs as $shopImg) {
			if ($shopImg['image_type'] == ImageType::$ACCESS[CodePattern::$CODE]) {
				continue;
			}
		?>
		<tr>
			<td>
			<?php
			$url = Router::url(array('controller'=> 'shops', 'action'=> 'image', $shopImg['shop_image_id']));
			echo "<img src='{$url}' height='80'>";
			?>
			</td>
			<td>
			<?php
			echo $this->ExForm->text("Priority.{$shopImg['shop_image_id']}.priority", array('id'=> 'priority', 'class'=> 'form-control', 'style'=> 'width: 80px;', 'value'=> $shopImg['priority']));
			?>
			</td>
			<td>
			<?php
			echo $this->ExForm->text("Priority.{$shopImg['shop_image_id']}.text", array('id'=> 'text', 'class'=> 'form-control', 'style'=> 'width: 500px;', 'value'=> $shopImg['text']));
			?>
			</td>
			<td><?php echo $shopImg['modified']?></td>
			<td>
			<?php
			echo $this->Html->link('<i class="fa fa-remove"></i>', array('controller'=> 'shops', 'action'=> 'imgDelete', $shopImg['shop_image_id'], $shopImg['shop_id']), array('escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
			?>
			</td>
		</tr>
		<?php
		}
		?>
	</thead>
</table>
<h2>道順画像</h2>
<table class="table">
	<thead>
		<tr>
			<th width="200"></th>
			<th width="100">優先順位</th>
			<th width="100">テキスト</th>
			<th width="150">更新日</th>
			<th></th>
		</tr>
		<?php
		foreach ($shopImgs as $shopImg) {
			if ($shopImg['image_type'] == ImageType::$MAIN[CodePattern::$CODE]) {
				continue;
			}
		?>
		<tr>
			<td>
			<?php
			$url = Router::url(array('controller'=> 'shops', 'action'=> 'image', $shopImg['shop_image_id']));
			echo "<img src='{$url}' height='80'>";
			?>
			</td>
			<td>
			<?php
			echo $this->ExForm->text("Priority.{$shopImg['shop_image_id']}.priority", array('id'=> 'priority', 'class'=> 'form-control', 'style'=> 'width: 80px;', 'value'=> $shopImg['priority']));
			?>
			</td>
			<td>
			<?php
			echo $this->ExForm->text("Priority.{$shopImg['shop_image_id']}.text", array('id'=> 'text', 'class'=> 'form-control', 'style'=> 'width: 500px;', 'value'=> $shopImg['text']));
			?>
			</td>
			<td><?php echo $shopImg['modified']?></td>
			<td>
			<?php
			echo $this->Html->link('<i class="fa fa-remove"></i>', array('controller'=> 'shops', 'action'=> 'imgDelete', $shopImg['shop_image_id'], $shopImg['shop_id']), array('escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
			?>
			</td>
		</tr>
		<?php
		}
		?>
	</thead>
</table>
<?php
	echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
}

echo $this->ExForm->end();
?>
<br>