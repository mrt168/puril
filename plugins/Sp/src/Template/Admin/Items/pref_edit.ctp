<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
?>

<div class="header"><h1 class="page-title"><?php echo Pref::convert($prefData['pref'], CodePattern::$VALUE)?> HTML編集</h1></div>
<div class="row">
	<div class="col-md-7">
		<br>
		<?php
		echo $this->Flash->render();
		if (empty($prefData)) {
			$prefData = "Items";
		}
		echo $this->ExForm->create($prefData, array('url'=> array('action'=> 'prefHtmlEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<div class="form-group">
				<label>HTML</label>
				<?php
				echo $this->ExForm->textarea('PrefDatas.html', array('id'=> 'html', 'class'=> 'form-control', 'style'=> 'height: 500px;'));
				echo $this->ExForm->error('PrefDatas.html');
				?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('PrefDatas.pref_data_id');
			echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
		</div>
		<?php
		echo $this->ExForm->end();
		?>
	</div>
</div>
