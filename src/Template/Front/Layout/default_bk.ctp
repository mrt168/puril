<!DOCTYPE html>
<html lang="ja">
<head>
	<?php echo $this->element('Front/head')	?>
</head>
<body class="drawer drawer--right">
	<?php
	echo $this->element('Front/header');
	echo $this->element('Front/nav');
	?>

	<?php echo $this->fetch('content');	?>

	<?php echo $this->element('Front/footer');?>
</body>
</html>
