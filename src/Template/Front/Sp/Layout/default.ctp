<?php
use Cake\Core\Configure;
use App\Vendor\Constants;
?>
<!DOCTYPE html>
<html lang="ja">
<head>
	<?php echo $this->element('Front/head')	?>
</head>
<body>
	<?php
	echo $this->element('Front/header');
	?>

	<?php
	echo $this->fetch('content');
	?>

    <?php
    $actionStatus = Configure::read('action_status');
    if ($actionStatus === Constants::DEVEROP_STR) {
//     	echo '<br />'.$this->element('sql_dump');
    }
    ?>
</body>
</html>
