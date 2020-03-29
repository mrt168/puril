<!DOCTYPE html>
<html lang="ja">
<head>
	<?php
	echo $this->element('Admin/head')
	?>
</head>
<body style="padding-left: 5px;">
	<?php
	echo $this->fetch('content');

	echo $this->Html->script('/lib/bootstrap/js/bootstrap');
    ?>
</body>
</html>
