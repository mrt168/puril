<?= $data['last_name'].$data['first_name']." 様\n" ?>

この度はPurilからのご予約をいただきまして、誠にありがとうございます！

ご予約いただいた内容は以下の通りです。
※下記のご予約内容は確定ではございません。確定の際は、改めてご連絡させていただきます。

——————
予約内容

〇 来店
店舗名：<?= $data['shop_name']."\n" ?>
店舗予約URL：<?= $data['referer']."\n" ?>
来店日時：
	第1希望：<?= $data['visit_date_1']."\n" ?>
	第2希望：<?= $data['visit_date_2']."\n" ?>
	第3希望：<?= $data['visit_date_3']."\n" ?>

〇 個人情報
氏名：<?= $data['last_name'].$data['first_name']."\n" ?>
フリガナ：<?= $data['last_kana'].$data['first_kana']."\n" ?>
生年月日：<?= $data['birthday_y']."年".$data['birthday_m']."月".$data['birthday_d']."日\n" ?>
性別：<?= $data['sex']."\n" ?>
連絡先番号：<?= $data['tel']."\n" ?>
メールアドレス：<?= $data['mail']."\n" ?>
住所：<?= $data['address']."\n" ?>

〇 問診
利用人数：<?= $data['customer_count']."\n" ?>
施術の当日希望：<?= $data['is_same_date']."\n" ?>
脱毛経験の有無：<?= $data['is_experienced']."\n" ?>
キャンペーン通知の希望：<?= $data['is_campaign']."\n" ?>
質問など：
	<?= $data['question']."\n" ?>

——————

上記の内容に問題がございましたら、info@tsuru-tsuru.co.jpにご連絡いただきますよう、よろしくお願いいたします。

※万が一、今回のご予約内容に変更の必要が生じた場合には、担当よりお電話またはメールにてご連絡させていただく場合がございます。あらかじめご了承ください。

※本メールに心当たりがない場合は、このままメールを削除していただきますよう、お願い申し上げます。
