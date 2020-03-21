<div class="sidebar-nav">
	<ul>
	<?php
	foreach ($menuItems as $menuItem) {
		$menuId = "{$menuItem['menu_parent_id']}-menu";
		$headerClass = 'nav-header';
		$classVal = '';
		foreach ($menuItem['MenuChildren'] as $child) {
			if (!empty($click_url) && $child['click_url'] == $click_url) {
				$classVal = 'in';
				break;
			} else {
				$headerClass .= ' collapsed';
			}
		}
	?>
	<li>
		<a href="#" data-target=".<?php echo $menuId?>" class="nav-header <?php echo $headerClass?>" data-toggle="collapse">
		<i class="fa fa-fw fa-dashboard"></i>
		<?php echo $menuItem['menu_name']?>
		<i class="fa fa-collapse"></i>
		</a>
	</li>
	<li>
		<ul class="<?php echo $menuId.' '.$classVal?> nav nav-list collapse">
		<?php
		foreach ($menuItem['MenuChildren'] as $child) {
			$classVal = '';
			if (!empty($click_url)) {
				$classVal = $child['click_url'] == $click_url ? 'active' : '';
			}
			echo '<li class="'.$classVal.'">';
			echo $this->Html->link("<span class=\"fa fa-caret-right\"></span> {$child['menu_name']}", array('controller'=> $child['controller_name'], 'action'=> $child['action_name']), array('escape'=> false));
			echo '</li>';
		}
		?>
		</ul>
	</li>
	<?php
	}
	?>
	</ul>
</div>