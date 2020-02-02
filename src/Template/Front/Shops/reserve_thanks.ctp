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
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common','datsumou/reserve/thanks','datsumou/reserve/common']);
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>
</header>
    <header class="reserve-header">
      <div class="reserve-header-inner"><a class="reserve-header-back" href="#"><i class="fas fa-chevron-left reserve-header-back-icon"></i>
          <div class="reserve-header-back-text">ホーム</div></a>
        <div class="reserve-header-title">ご予約完了</div>
      </div>
    </header>
    <section class="content-base reserve-thanks">
      <h1 class="reserve-thanks-title-area"><i class="far fa-calendar-check reserve-thanks-title-icon"></i>
        <div class="reserve-thanks-title">仮予約完了</div>
      </h1>
      <div class="reserve-thanks-text-wrap">
        <p class="reserve-thanks-text">Purilよりご登録いただいたメールアドレスに確認メールをお送りいたしました。(自動送信)</p>
        <p class="reserve-thanks-text">しばらく経ってもメールが届かない場合は、お手数ですがお問い合わせいただきますようお願いいたします。</p>
      </div>
      <div class="reserve-thanks-subtext-wrap">
        <p class="reserve-thanks-subtext">※ご予約内容は確定ではございません。確定の際は、改めてご連絡させていただきます。</p>
        <p class="reserve-thanks-subtext">※万が一、今回のご予約内容に変更の必要が生じた場合には、担当よりお電話またはメールにてご連絡させていただく場合がございます。あらかじめご了承ください。</p>
      </div>
      <div class="reserve-thanks-button-area"><a class="reserve-thanks-button" href="#">Purilトップへ戻る</a></div>
    </section>
    <div class="content-base campaign"><a href="#"><?= $this->Html->image('/img/cashback-campaign.jpg', ['alt'=> 'キャッシュバックキャンペーン'])?></a></div>
    <nav class="content-base breadcrumbs"><i class="fas fa-home home-icon"></i>
      <ul class="breadcrumbs-list">
        <li><a href="#">ホーム</a></li>
        <li><a href="#">脱毛</a></li>
        <li><a href="#">全国脱</a></li>
        <li><a href="#">全国脱毛サ</a></li>
        <li><a href="#">東京脱</a></li>
        <li><a href="#">キレイモ新宿</a></li>
      </ul>
    </nav>
<?php
echo $this->element('Front/footer') ?>
</body>
</html>