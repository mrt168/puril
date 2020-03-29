<?php
use App\Controller\Admin\ItemsController;
?>
<div class="header"><h1 class="page-title">特典・割引一覧</h1></div>
<?php
echo $this->Flash->render();
?>
<table class="table">
	<thead>
		<tr>
			<th width="80">ID</th>
			<th width="200">特典・割引</th>
			<th width="200">検索ワード</th>
			<th width="200">URLテキスト</th>
			<th width="500">一言用語解説</th>
			<th></th>
		</tr>
		<?php
		echo $this->ExForm->create('Items', array('url'=> array('action'=> 'discountEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
		foreach ($discounts as $discount) {
		?>
		<tr>
			<td><?php echo $discount['discount_id']?></td>
			<td><?php echo $discount['name']?></td>
			<td>
				<?php
				echo $this->ExForm->text("Discounts.{$discount['discount_id']}.search_text", array('id'=> 'search_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $discount['search_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->ExForm->text("Discounts.{$discount['discount_id']}.url_text", array('id'=> 'url_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $discount['url_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->ExForm->text("Discounts.{$discount['discount_id']}.description", array('id'=> 'description', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $discount['description']));
				?>
			</td>
			<td>
				<?php
				$page = ItemsController::DISCOUNT;
				echo $this->Html->link('HTML編集', ['controller'=> 'items', 'action'=> 'moveHtmlEdit', $page, $discount['discount_id']], array('class'=> 'btn btn-primary', 'escape'=> false));
				?>
			</td>
		</tr>
		<?php
		}
		echo $this->ExForm->end();
		?>
	</thead>
</table>