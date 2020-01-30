<div class="header"><h1 class="page-title"><?=$station['station_name']?>駅 HTML編集</h1></div>
<div class="row">
	<div class="col-md-7">
		<br>
		<?php
		echo $this->Flash->render();
		if (empty($station)) {
			$area = "Items";
		}
		echo $this->ExForm->create($station, array('url'=> array('action'=> 'stationHtmlEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<div class="form-group">
				<label>HTML</label>
				<?php
				echo $this->ExForm->textarea('Stations.html', array('id'=> 'html', 'class'=> 'form-control', 'style'=> 'height: 500px;'));
				echo $this->ExForm->error('Stations.html');
				?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('Stations.station_cd');
			echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
		</div>
		<?php
		echo $this->ExForm->end();
		?>
	</div>
</div>
