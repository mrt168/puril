<?php
use App\Controller\Admin\ItemsController;
?>
<div class="header"><h1 class="page-title">価格一覧</h1></div>
<?php
echo $this->Flash->render();
?>
<table class="table">
	<thead>
		<tr>
			<th width="80">ID</th>
			<th width="200">価格</th>
			<th width="200">検索ワード</th>
			<th width="200">URLテキスト</th>
			<th width="500">一言用語解説</th>
			<th></th>
		</tr>
		<?php
		echo $this->ExForm->create('Items', array('url'=> array('action'=> 'priceEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
		foreach ($prices as $price) {
		?>
		<tr>
			<td><?php echo $price['price_id']?></td>
			<td><?php echo $price['name']?></td>
			<td>
				<?php
				echo $this->ExForm->text("Prices.{$price['price_id']}.search_text", array('id'=> 'search_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $price['search_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->ExForm->text("Prices.{$price['price_id']}.url_text", array('id'=> 'url_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $price['url_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->ExForm->text("Prices.{$price['price_id']}.description", array('id'=> 'description', 'class'=> 'form-control', 'style'=> 'width: 500px;', 'value'=> $price['description']));
				?>
			</td>
			<td>
				<?php
				$page = ItemsController::PRICE;
				echo $this->Html->link('HTML編集', ['controller'=> 'items', 'action'=> 'moveHtmlEdit', $page, $price['price_id']], array('class'=> 'btn btn-primary', 'escape'=> false));
				?>
			</td>
		</tr>
		<?php
		}
		echo $this->ExForm->end();
		?>
	</thead>
</table>