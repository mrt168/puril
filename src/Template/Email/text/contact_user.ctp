<?php
use App\Vendor\Code\ContactType;
use App\Vendor\Code\CodePattern;
?>
お問合せタイプ：<?php echo $data['type']. "\n"?>
メールアドレス：<?php echo $data['mail']. "\n"?>
電話：<?php echo $data['tell']. "\n"?>
<?php
$contactTitle = "お問い合わせ内容";
if ($data['type'] == ContactType::$REVIEW[CodePattern::$VALUE]) {
	$contactTitle = "口コミ詳細";
?>
来店日：<?php echo $data['visit_date']. "\n"?>
来店店舗：<?php echo $data['shop_name']. "\n"?>
評価：<?php echo $data['evaluation']. "\n"?>

〇評価詳細
治療前の説明は十分でしたか？：<?php echo $data['question1']. "\n"?>
痛みへの配慮はいかがでしたか？：<?php echo $data['question2']. "\n"?>
スタッフの態度、対応はいかがでしたか？：<?php echo $data['question3']. "\n"?>
店舗の雰囲気、設備、清潔感はいかがでしたか？：<?php echo $data['question4']. "\n"?>
待ち時間、予約対応はいかがでしたか？：<?php echo $data['question5']. "\n"?>
術前、術中、術後の対応はいかがでしたか？：<?php echo $data['question6']. "\n"?>

名前・ニックネーム：<?php echo $data['nickname']. "\n"?>
年齢：<?php echo $data['age']. "\n"?>
性別：<?php echo $data['sex']. "\n"?>
Instagramアカウント：<?php echo $data['instagram_account']. "\n"?>
Twitterアカウント：<?php echo $data['twitter_account']. "\n"?>
口コミタイトル：<?php echo $data['title']. "\n"?>
<?php
} else if ($data['type'] == ContactType::$REQUEST[CodePattern::$VALUE]) {
	$contactTitle = "ご依頼詳細 ";
?>
口コミURL：<?php echo $data['review_url']. "\n"?>
名前・ニックネーム：<?php echo $data['nickname']. "\n"?>
<?php
}
?>
<?php echo $contactTitle?>：<?php echo $data['content']. "\n"?>