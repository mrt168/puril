<div class="row">
	<div class="col-md-4">
		<br>
		<?php
		echo $this->Flash->render();
		if (empty($administratorDatas)) {
			$administratorDatas = "AdministratorDatas";
		}
		echo $this->ExForm->create($administratorDatas, array('url'=> array('action'=> 'edit'), 'type'=> 'post', 'novalidate' => true, 'id'=> 'tab'));
		?>
		<div id="myTabContent" class="tab-content">
			<div class="tab-pane active in" id="home">
				<div class="form-group">
				<label>管理者名</label>
				<?php
				echo $this->ExForm->text('AdministratorDatas.name', array('id'=> 'name', 'title'=> '管理者名を入力', 'class'=> 'form-control'));
				echo $this->ExForm->error('AdministratorDatas.name');
				?>
				</div>
				<div class="form-group">
				<label>ログインID</label>
				<?php
				echo $this->ExForm->text('AdministratorDatas.login_id', array('id'=> 'login_id', 'title'=> 'ログインIDを入力', 'class'=> 'form-control'));
				echo $this->ExForm->error('AdministratorDatas.login_id');
				?>
				</div>
				<div class="form-group">
				<label>パスワード</label>
				<?php
				echo $this->ExForm->password('AdministratorDatas.login_pass', array('id'=> 'login_pass', 'title'=> 'パスワードを入力', 'class'=> 'form-control'));
				echo $this->ExForm->error('AdministratorDatas.login_pass');
				?>
				</div>
			</div>
		</div>
		<div class="btn-toolbar list-toolbar">
			<?php
			echo $this->ExForm->hidden('AdministratorDatas.administrator_id');
			if (isset($this->request->data['AdministratorDatas']['administrator_id']) && !empty($this->request->data['AdministratorDatas']['administrator_id'])) {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'update', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			} else {
				echo $this->ExForm->button('<i class="fa fa-save"></i> 登録', array('name'=> 'regist', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
			}
			?>
		</div>
		<?php
		echo $this->ExForm->end();
		?>
	</div>
</div>
