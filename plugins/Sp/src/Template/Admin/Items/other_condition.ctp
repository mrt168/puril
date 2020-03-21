<?php
use App\Vendor\Code\OtherConditionType;
use App\Vendor\Code\CodePattern;
use App\Controller\Admin\ItemsController;
?>
<div class="header"><h1 class="page-title">その他こだわり条件一覧</h1></div>
<?php
echo $this->Flash->render();
?>
<table class="table">
	<thead>
		<tr>
			<th width="80">ID</th>
			<th width="200">項目</th>
			<th width="200">条件</th>
			<th width="200">検索ワード</th>
			<th width="200">URLテキスト</th>
			<th width="500">一言用語解説</th>
			<th></th>
		</tr>
		<?php
		echo $this->ExForm->create('Items', array('url'=> array('action'=> 'otherConditionEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
		foreach ($otherConditions as $otherCondition) {
		?>
		<tr>
			<td><?php echo $otherCondition['other_condition_id']?></td>
			<td><?php echo $otherCondition['type']?></td>
			<td><?php echo $otherCondition['name']?></td>
			<td>
				<?php
				echo $this->ExForm->text("OtherConditions.{$otherCondition['other_condition_id']}.search_text", array('id'=> 'search_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $otherCondition['search_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->ExForm->text("OtherConditions.{$otherCondition['other_condition_id']}.url_text", array('id'=> 'url_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $otherCondition['url_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->ExForm->text("OtherConditions.{$otherCondition['other_condition_id']}.description", array('id'=> 'description', 'class'=> 'form-control', 'style'=> 'width: 500px;', 'value'=> $otherCondition['description']));
				?>
			</td>
			<td>
				<?php
				$page = ItemsController::OTHER_CONDITIONS;
				echo $this->Html->link('HTML編集', ['controller'=> 'items', 'action'=> 'moveHtmlEdit', $page, $otherCondition['other_condition_id']], array('class'=> 'btn btn-primary', 'escape'=> false));
				?>
			</td>
		</tr>
		<?php
		}
		echo $this->ExForm->end();
		?>
	</thead>
</table>