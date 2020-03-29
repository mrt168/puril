<?php
use Cake\Core\Configure;
use App\Vendor\Constants;
?>
<!doctype html>
<html lang="ja">
<head>
	<?php echo $this->element('Admin/head')?>
</head>
<body class="theme-blue">

	<div class="navbar navbar-default" role="navigation">
		<div class="navbar-header">
			<a class="" href="index.html">
				<span class="navbar-brand">
					<span class="fa fa-paper-plane"></span>
					<?php echo Constants::ADMIN_SYSYTEM_NAME?>
				</span>
			</a>
		</div>
		<div class="navbar-collapse collapse" style="height: 1px;"></div>
	</div>
	<?php
	echo $this->fetch('content');

	echo $this->Html->script('/lib/bootstrap/js/bootstrap');
	?>
    <script type="text/javascript">
        $("[rel=tooltip]").tooltip();
        $(function() {
            $('.demo-cancel-click').click(function(){return false;});
        });
    </script>

    <?php
    $actionStatus = Configure::read('action_status');
    if ($actionStatus === Constants::DEVEROP_STR) {
//     	echo '<br />'.$this->element('sql_dump');
    }
    ?>
</body>
</html>
