<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
?>

<div class="header"><h1 class="page-title">HTML編集</h1></div>
<?php
echo $this->Flash->render();
?>
<div class="row">
	<div class="col-md-7">
		<br>
		<?php
		echo $this->Flash->render();
		if (empty($item)) {
			$item = "Items";
		}
		echo $this->ExForm->create($item, array('url'=> array('action'=> 'htmlEdit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<div class="form-group">
				<label>HTML</label>
				<?php
				echo $this->ExForm->textarea('Items.html', array('id'=> 'html', 'class'=> 'form-control', 'style'=> 'height: 500px;'));
				echo $this->ExForm->error('Items.html');
				?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('Items.id');
			echo $this->ExForm->hidden('Items.page');
			echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			?>
		</div>
		<?php
		echo $this->ExForm->end();
		?>
	</div>
</div>
