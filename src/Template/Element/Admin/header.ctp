<?php
use App\Vendor\Constants;
?>
<div class="navbar navbar-default" role="navigation">
	<div class="navbar-header">
		<button type="button" class="navbar-toggle collapsed"
			data-toggle="collapse" data-target=".navbar-collapse">
			<span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span>
			<span class="icon-bar"></span> <span class="icon-bar"></span>
		</button>
		<?php
		echo $this->Html->link('<span class="navbar-brand"><span class="fa fa-paper-plane"></span>'.Constants::ADMIN_SYSYTEM_NAME.'</span>', array('controller'=> 'tops'), array('escape'=> false));
		?>
	</div>
	<div class="navbar-collapse collapse" style="height: 1px;">
		<ul id="main-menu" class="nav navbar-nav navbar-right">
			<li class="dropdown hidden-xs">
				<a href="#" class="dropdown-toggle" data-toggle="dropdown">
					<span class="glyphicon glyphicon-user padding-right-small" style="position: relative; top: 3px;"></span>
					<?php echo $loginUser['name']?>
					<i class="fa fa-caret-down"></i>
				</a>
				<ul class="dropdown-menu">
					<li>
					<?php
					echo $this->Html->link('Logout', array('controller'=> 'logouts'), array('tabindex'=> '-1'));
					?>
					</li>
				</ul>
			</li>
		</ul>
	</div>
</div>