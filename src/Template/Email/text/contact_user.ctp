<?php
use App\Vendor\Code\ContactType;
use App\Vendor\Code\CodePattern;
?>
お問合せタイプ：<?php echo $data['type']. "\n"?>
メールアドレス：<?php echo $data['mail']. "\n"?>
電話：<?php echo $data['tell']. "\n"?>
<?php
$contactTitle = "お問い合わせ内容";
?>
<?php
if ($data['type'] == ContactType::$REQUEST[CodePattern::$VALUE]) {
	$contactTitle = "ご依頼詳細 ";
?>
名前・ニックネーム：<?php echo $data['nickname']. "\n"?>
<?php
}
?>
<?php echo $contactTitle?>：<?php echo $data['content']. "\n"?>