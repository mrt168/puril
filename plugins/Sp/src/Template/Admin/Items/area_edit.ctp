<div class="header"><h1 class="page-title"><?=$area['name']?> HTML編集</h1></div>
<div class="row">
	<div class="col-md-7">
		<br>
		<?php
		echo $this->Flash->render();
		if (empty($area)) {
			$area = "Items";
		}
		echo $this->ExForm->create($area, array('url'=> array('action'=> 'areaHtmlEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<div class="form-group">
				<label>HTML</label>
				<?php
				echo $this->ExForm->textarea('Areas.html', array('id'=> 'html', 'class'=> 'form-control', 'style'=> 'height: 500px;'));
				echo $this->ExForm->error('Areas.html');
				?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('Areas.area_id');
			echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
		</div>
		<?php
		echo $this->ExForm->end();
		?>
	</div>
</div>
