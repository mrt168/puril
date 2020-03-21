<div class="header"><h1 class="page-title">都道府県一覧</h1></div>
<?php
echo $this->Flash->render();
?>
<table class="table">
	<thead>
		<tr>
			<th width="100">都道府県</th>
			<th width="200">検索ワード</th>
			<th width="200">URLテキスト</th>
			<th></th>
		</tr>
		<?php
		echo $this->ExForm->create('Items', array('url'=> array('action'=> 'prefEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
		echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
		foreach ($prefDatas as $prefData) {
		?>
		<tr>
			<td><?php echo $prefData['pref']?></td>
			<td>
				<?php
				echo $this->ExForm->text("PrefDatas.{$prefData['pref_data_id']}.search_text", array('id'=> 'search_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $prefData['search_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->ExForm->text("PrefDatas.{$prefData['pref_data_id']}.url_text", array('id'=> 'url_text', 'class'=> 'form-control', 'style'=> 'width: 200px;', 'value'=> $prefData['url_text']));
				?>
			</td>
			<td>
				<?php
				echo $this->Html->link('HTML編集', ['controller'=> 'items', 'action'=> 'movePrefEdit', $prefData['pref_data_id']], array('class'=> 'btn btn-primary', 'escape'=> false));
				?>
			</td>
		</tr>
		<?php
		}
		echo $this->ExForm->end();
		?>
	</thead>
</table>