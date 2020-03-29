<?php
use Cake\Core\Configure;
use App\Vendor\Constants;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<?php echo $this->element('Admin/head')	?>
</head>
<body class=" theme-blue">
	<?php
	echo $this->element('Admin/header');
	echo $this->element('Admin/menu');
	?>

	<div class="content">
		<div class="main-content">
		<?php
		echo $this->fetch('content');
		?>
		</div>
	</div>


	<?php
// 	echo '<br />'.$this->element('sql_dump');
	echo '</div>';

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
