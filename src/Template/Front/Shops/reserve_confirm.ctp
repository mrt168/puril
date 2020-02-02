<?php

use App\Vendor\FormUtil;
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
use App\Vendor\URLUtil;
use App\Vendor\Code\Satisfaction;
use App\Vendor\Code\Sex;
use App\Vendor\Code\ImageType;
use App\Vendor\Code\ImagePositionType;
?>
<body>
<?php
echo $this->Html->css('datsumou');
// echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/shop/common', 'datsumou/shop/index', 'datsumou/photodetail']);
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common','datsumou/reserve/confirm','datsumou/reserve/common']);
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
    <header class="reserve-header">
      <div class="reserve-header-inner"><a class="reserve-header-back" href="#"><i class="fas fa-chevron-left reserve-header-back-icon"></i>
          <div class="reserve-header-back-text">ホーム</div></a>
        <div class="reserve-header-title">ご予約内容の確認</div>
      </div>
    </header>
    <section class="content-base reserve-confirm-head">
      <div class="reserve-confirm-head-shop">キレイモ 新宿本店 </div>
      <div class="reserve-confirm-head-date">1月27日(月)　18:00 1名</div>
    </section>
    <section class="content-base reserve-confirm-main">
      <div class="reserve-confirm-content">
        <h2 class="reserve-confirm-content-title">ご予約者情報</h2>
        <div class="reserve-confirm-content-info">
          <div class="reserve-confirm-content-name">山田花子</div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">生年月日</div>
            <div class="reserve-confirm-content-data">1990/4/1</div>
          </div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">性別</div>
            <div class="reserve-confirm-content-data">女性</div>
          </div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">脱毛希望部位</div>
            <div class="reserve-confirm-content-data">全身脱毛</div>
          </div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">生年月日</div>
            <div class="reserve-confirm-content-data">1990/4/1</div>
          </div>
          <div class="reserve-confirm-content-tel">03-1234-5678</div>
          <div class="reserve-confirm-content-email">info@tsuru-tsuru.co.jp</div>
        </div>
      </div>
      <div class="reserve-confirm-content">
        <h2 class="reserve-confirm-content-title">その他お客様情報</h2>
        <div class="reserve-confirm-content-info">
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">住所</div>
            <div class="reserve-confirm-content-data">サンプル住所</div>
          </div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">利用人数</div>
            <div class="reserve-confirm-content-data">１名</div>
          </div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">当日の施術</div>
            <div class="reserve-confirm-content-data">希望する</div>
          </div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">脱毛経験</div>
            <div class="reserve-confirm-content-data">あり</div>
          </div>
          <div class="reserve-confirm-content-row">
            <div class="reserve-confirm-content-term">キャンペーンの通知</div>
            <div class="reserve-confirm-content-data">希望する</div>
          </div>
        </div>
      </div>
      <div class="reserve-confirm-content">
        <h2 class="reserve-confirm-content-title">質問など</h2>
        <div class="reserve-confirm-content-info">
          <div class="reserve-confirm-content-question">質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー質問ダミー</div>
        </div>
      </div>
      <div class="reserve-confirm-content">
        <div class="reserve-confirm-content-policy-area">
          <p class="reserve-confirm-content-policy"><span>ご予約の際には、</span><a href="#">利用規約</a><span>をご確認ください。</span></p>
        </div>
      </div>
    </section>
    <section class="content-base reserve-confirm-button-area"><a class="reserve-confirm-button" href="#">
        <div class="reserve-confirm-bottom-pretext">規約に同意し、上記内容で</div>
        <div class="reserve-confirm-bottom-text">予約を確定する</div></a></section>
<?php
echo $this->element('Front/footer') ?>
</body>
</html>