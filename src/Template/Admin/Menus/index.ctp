<?php
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\ShowFlg;
?>
<div class="header"><h1 class="page-title">メニュー管理</h1></div>
<?php
echo $this->ExForm->create('Menu', array('url'=> array('action'=> 'search'), 'type'=> 'post'));
?>
<div class="btn-toolbar list-toolbar">
	<div class="panel panel-default">
		<table class="table">
			<tr>
				<th width="120">管理者名</th>
				<td width="200">
					<?php
					echo $this->ExForm->AdministratorData('administrator_id', array('class' => 'form-control', 'empty'=> '選択して下さい'));
					?>
				</td>
				<td>
					<?php
					echo $this->ExForm->button('<i class="fa fa-search"></i> 検 索', array('name'=> 'search', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
					?>
				</td>
			</tr>
		</table>
	</div>
</div>
<?php
echo $this->ExForm->end();
echo $this->Flash->render();

if (!empty($menuParents) && count($menuParents) != 0) {
	echo $this->ExForm->create('Menu', array('url'=> array('action'=> 'edit'), 'type'=> 'post'));
?>

<hr>
<table class="table">
	<thead>
	<tr>
		<th>ｶﾃｺﾞﾘｰ名</th>
		<th>
			<label>
				<input type="checkbox" id="check-parent" class="all-check" />表示/非表示
			</label>
		</th>
		<th>表示順</th>
		<th>子メニュー名</th>
		<th>
			<label>
				<input type="checkbox" id="check-child" class="all-check" />表示/非表示
			</label>
		</th>
		<th>表示順</th>
	</tr>
	<?php
	$i = 0;
	$parentOrderNo = 0;
	foreach ($menuParents as $menuParentId=> $menuParent) {
		$childCnt = count($menuParent['MenuChildren']);
		$checked = !isset($menuParent['show_flg']) || $menuParent['show_flg'] == ShowFlg::$SHOW[CodePattern::$CODE] ? true : false;

		$menuParentOrderId = null;
		if (!empty($menuParent['parent_order_id'])) {
			$menuParentOrderId = $menuParent['parent_order_id'];
		}
		if (!empty($child['order_no'])) {
			$parentOrderNo = $menuParent['order_no'];
		} else {
			$parentOrderNo++;
		}

		// まず親メニュー生成
		echo <<<EOF
		<tr>
			<td rowspan="{$childCnt}">{$menuParent['menu_name']}</td>
			<td rowspan="{$childCnt}">
				<label>
					{$this->ExForm->checkbox('MenuParentOrders.'.$i.'.show_flg', array('value'=> ShowFlg::$SHOW[CodePattern::$CODE], 'checked'=> $checked, 'class'=> 'check-parent'))}
				 	表示する
				 </label>
			</td>
			<td rowspan="{$childCnt}">
				{$this->ExForm->text('MenuParentOrders.'.$i.'.order_no', array('value'=> $parentOrderNo, 'style'=> 'width: 50px;', 'class'=> 'form-control'))}
				{$this->ExForm->hidden('MenuParentOrders.'.$i.'.menu_parent_id', array('value'=> $menuParentId))}
				{$this->ExForm->hidden('MenuParentOrders.'.$i.'.parent_order_id', array('value'=> $menuParentOrderId))}
			</td>
EOF;
		/**
		 * ここから子メニュー表示
		 */
		$j = 0;
		$childOrderNo = 0;
		foreach ($menuParent['MenuChildren'] as $child) {
			$checked = !isset($child['show_flg']) || $child['show_flg'] == ShowFlg::$SHOW[CodePattern::$CODE] ? true : false;
			$menuChildOrderId = null;
			if (!empty($child['child_order_id'])) {
				$menuChildOrderId = $child['child_order_id'];
			}
			if (!empty($child['order_no'])) {
				$childOrderNo = $child['order_no'];
			} else {
				$childOrderNo++;
			}

			echo <<<EOF
			<td>{$child['menu_name']}</td>
			<td>
				<label>{$this->ExForm->checkbox('MenuParentOrders.'.$i.'.MenuChildOrders.'.$j.'.show_flg', array('value'=> ShowFlg::$SHOW[CodePattern::$CODE], 'checked'=> $checked, 'class'=> 'check-child'))} 表示する</label>
			</td>
			<td>
				{$this->ExForm->text('MenuParentOrders.'.$i.'.MenuChildOrders.'.$j.'.order_no', array('value'=> $childOrderNo, 'style'=> 'width: 50px;', 'class'=> 'form-control'))}
				{$this->ExForm->hidden('MenuParentOrders.'.$i.'.MenuChildOrders.'.$j.'.menu_child_id', array('value'=> $child['menu_child_id']))}
				{$this->ExForm->hidden('MenuParentOrders.'.$i.'.MenuChildOrders.'.$j.'.child_order_id', array('value'=> $menuChildOrderId))}
			</td>
			</tr>
			<tr>
EOF;
			$j++;
		}
		echo '</tr>';
		$i++;
	}
	?>
</table>
<?php
	echo $this->ExForm->hidden('administrator_id');
	echo $this->ExForm->button('<i class="fa fa-save"></i> 更新', array('name'=> 'edit', 'class'=> 'btn btn-primary', 'type'=> 'submit', 'escape'=> false));
	echo $this->ExForm->end();
}
?>

<script>
$(function() {
	$('input.all-check').change(function() {
		$('input.' + $(this).attr('id')).prop('checked', $(this).prop('checked'));
	});
})
</script>