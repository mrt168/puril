<?php
use Cake\Routing\Router;
use App\Vendor\Messages;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\CodePattern;
?>
<div class="header">
	<h1 class="page-title">
	<?php
	echo "{$brand['name']}(ID:{$brand['brand_id']})";
	?>
	関連URL登録
	</h1>
</div>
<?php
echo $this->Flash->render();
if (empty($brandUrl)) {
	$brandUrl = "ShopImages";
}
echo $this->ExForm->create($brandUrl, array('url'=> array('action'=> 'urlEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="panel panel-default">
		<table class="table">
			<tr>
				<th width="120">タイトル</th>
				<td width="500">
					<?php
					echo $this->ExForm->text('BrandUrls.title', array('id'=> 'title', 'class'=> 'form-control'));
					echo $this->ExForm->error('BrandUrls.title');
					?>
				</td>
				<th width="120">URL</th>
				<td width="300">
					<?php
					echo $this->ExForm->text('BrandUrls.url', array('id'=> 'url', 'class'=> 'form-control'));
					echo $this->ExForm->error('BrandUrls.url');
					?>
				</td>
				<th width="100">優先順位</th>
				<td width="100">
					<?php
					echo $this->ExForm->text('BrandUrls.priority', array('id'=> 'priority', 'class'=> 'form-control', 'style'=> 'width: 50px;'));
					echo $this->ExForm->error('BrandUrls.priority');
					?>
				</td>
				<td>
					<?php
					echo $this->ExForm->hidden('BrandUrls.brand_id');
					echo $this->ExForm->hidden('BrandUrls.brand_url_id');
					if (isset($this->request->data['BrandUrls']['brand_url_id']) && !empty($this->request->data['BrandUrls']['brand_url_id'])) {
						echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
					} else {
						echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
					}
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php
if (!empty($brand['brand_urls'])) {
?>
<h2>関連URL一覧</h2>
<table class="table">
	<thead>
		<tr>
			<th width="100">優先順位</th>
			<th width="400">タイトル</th>
			<th width="400">URL</th>
			<th></th>
		</tr>
		<?php
		foreach ($brand['brand_urls'] as $brandUrl) {
		?>
		<tr>
			<td><?=$brandUrl['priority']?></td>
			<td><?=$brandUrl['title']?></td>
			<td><?=$brandUrl['url']?></td>
			<td>
				<?php
				echo $this->Html->link('<i class="fa fa-pencil"></i>', array('controller'=> 'brands', 'action'=> 'moveUrlEdit', $brandUrl['brand_url_id'], $brandUrl['brand_id']), array('escape'=> false));
				echo '&nbsp;&nbsp;&nbsp;';
				echo $this->Html->link('<i class="fa fa-trash-o"></i>', array('controller'=> 'brands', 'action'=> 'deleteUrl', $brandUrl['brand_url_id']), array('escape'=> false, 'confirm'=> Messages::CONFIRM_DELETE));
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

echo $this->ExForm->end();
?>
<br>