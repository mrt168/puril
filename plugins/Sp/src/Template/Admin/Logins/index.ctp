<?php
use App\Vendor\Constants;
?>
<div class="dialog">
	<div class="panel panel-default">
		<p class="panel-heading no-collapse">Sign In</p>
		<div class="panel-body">
			<?php
			echo $this->Form->create('AdministratorData', array('url' => '/'.Constants::ADMIN_ROOT_URL.'/logins/login'), array('accept-charset'=> 'utf-8'));
			?>
				<div class="form-group">
					<label>User</label>
					<?php
					echo $this->Form->text('AdministratorData.login_id', array('class'=> "form-control span12"));
					?>
				</div>
				<div class="form-group">
					<label>Password</label>
					<?php
					echo $this->Form->password('AdministratorData.login_pass', array('autocomplete'=> 'off', 'class'=> "form-control span12 form-control"));
					?>
				</div>
				<?php
				$msg = $this->Flash->render();
				if (!empty($msg)) {
					echo '<div id="flashMessage" class="err orange mgn15">'.$msg.'<span></span></div>';
				}
				echo $this->Form->button('送信する', array('div'=> false, 'class'=> 'btn btn-primary pull-right'));
				?>
                <div class="clearfix"></div>
			<?php
			echo $this->Form->end();
			?>
		</div>
	</div>
</div>
