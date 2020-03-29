<?php
echo $this->Flash->render();
echo $this->ExForm->create('Users', array('url'=> array('action'=> 'csvImport'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab', 'enctype'=> 'multipart/form-data'));
?>
<div id="myTabContent" class="tab-content">
	<div class="tab-pane active in" id="main">
		<div class="form-group">
		<label>CSVファイル<span class="required-mark">※</span></label>
			<?php
			echo $this->ExForm->file('Shops.csv_file');
			?>
		</div>
	</div>
</div>
<?php
echo $this->ExForm->button('<i class="fa fa-save"></i> インポート', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
?>