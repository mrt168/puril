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
echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/shop/common', 'datsumou/shop/index', 'datsumou/photodetail']);
?>
    <header class="shop-header">
      <div class="shop-header-inner"><a class="shop-header-back" href="/datsumou/brand"><i class="fas fa-chevron-left"></i></a>
        <div class="shop-header-title">キレイモ新宿本店</div><a class="shop-header-post" href="#">投稿</a>
      </div>
    </header>
    <nav class="content shop-nav">
      <div class="shop-nav-item active"><a class="shop-nav-item-text" href="/datsumou/shop/">トップ</a></div>
      <div class="shop-nav-item"><a class="shop-nav-item-text" href="/datsumou/shop/plan.html">料金プラン</a></div>
      <div class="shop-nav-item"><a class="shop-nav-item-text" href="/datsumou/shop/photo.html">写真</a></div>
      <div class="shop-nav-item"><a class="shop-nav-item-text" href="/datsumou/shop/kuchikomi.html">口コミ</a></div>
      <div class="shop-nav-item"><a class="shop-nav-item-text" href="/datsumou/shop/campaign.html">キャンペーン</a></div>
      <div class="shop-nav-item"><a class="shop-nav-item-text" href="/datsumou/shop/map.html">地図</a></div>
    </nav>
    <section class="content shop-top">
      <div class="shop-top-img-area">
        <div class="shop-top-img-base"><img class="shop-top-img" src="/puril/images/img/datsumou/shop/kireimo-shinjuku.jpg" alt="KIREIMO新宿本店"></div>
        <div class="shop-top-img-desc">
          <div class="shop-top-img-desc-sub">
            <div class="shop-top-img-sub-tag">認定</div>
            <div class="shop-top-img-sub-text">業界口コミ＆予約が取りやすい脱毛サロンNo.1</div>
          </div>
          <h1 class="shop-top-img-desc-text">キレイモ 新宿本店 </h1>
        </div>
      </div>
      <div class="shop-top-desc-area">
        <div class="shop-top-desc-category">脱毛サロン・全身</div>
        <div class="shop-top-desc-middle">
          <div class="shop-top-desc-review">
            <div class="shop-star-area">
              <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
              </div>
              <div class="shop-point">4.6</div>
            </div>
            <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
              <div class="shop-comment-count">142件</div>
            </div>
          </div>
          <div class="shop-top-desc-tag-area">
            <div class="datsumou-shop-tag-button datsumou-shop-tag-puril">Puril認定店舗</div>
            <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
          </div>
        </div>
        <div class="shop-top-desc-info">
          <div class="shop-top-desc-info-common shop-top-desc-info-business">
            <div class="shop-top-desc-info-common-tag shop-top-desc-info-business-tag">時</div>
            <div class="shop-top-desc-info-common-text shop-top-desc-info-business-text">11:00～21:00（年末年始除く）</div>
          </div>
          <div class="shop-top-desc-info-common shop-top-desc-info-holiday">
            <div class="shop-top-desc-info-common-tag shop-top-desc-info-holiday-tag">休</div>
            <div class="shop-top-desc-info-common-text shop-top-desc-info-holiday-text">年末年始</div>
          </div>
        </div>
      </div>
    </section>
    <section class="content middle-content shop-info">
      <h2 class="content-title">店舗情報</h2>
      <p class="content-feature"><span>最大</span><span class="content-feature-large">5,000</span><span>円のキャッシュバックあり！</span></p>
      <h3 class="content-title-sub">業界口コミ＆予約が取りやすい脱毛サロンNo.1</h3>
      <p class="content-text">タレントやモデルの来店多数で業界口コミNo.1！スリムアップ美容全身脱毛で脱毛しながら美しいボディラインを実現します。予約も取りやすいから忙しくても通いやすい♪キレイモ一号店でありプロフェッショナルのスタッフが、お客様のキレイのために全力でサポートしていますよ！各線「新宿駅」から近く便利◎</p>
    </section>
    <section class="content middle-content shop-plan">
      <h2 class="content-title">料金プラン</h2>
      <ul class="shop-plan-line">
        <li class="shop-plan-line-item-wrap"><a class="clickable-button shop-plan-line-item" href="#"><img class="shop-plan-line-item-img" src="/puril/images/img/datsumou/brand/slimplan.jpg" alt="スリムアップ脱毛">
            <div class="shop-plan-line-item-desc">
              <div class="shop-plan-lin-item-desc-title">月額定額プラン　スリムアップ脱毛</div>
              <div class="shop-plan-lin-item-desc-price">
                <div class="shop-plan-lin-item-desc-price-amount">4,800円</div>
                <div class="shop-plan-lin-item-desc-price-tax">（税抜）</div>
              </div><i class="fas fa-chevron-right shop-plan-lin-item-desc-arrow"></i>
            </div></a></li>
      </ul><a class="show-more clickable-button" href="/datsumou/shop/plan.html">プランをもっと見る（4件）</a>
    </section>
    <section class="content middle-content shop-datsumou">
      <h2 class="content-title">脱毛部位</h2>
      <ul class="shop-part-list">
        <li class="shop-part-common shop-part-active">全身</li>
        <li class="shop-part-common shop-part-none"></li>
        <li class="shop-part-common shop-part-none"></li>
        <li class="shop-part-common shop-part-none"></li>
      </ul>
    </section>
    <section class="content middle-content shop-campaign">
      <h2 class="content-title">キャンペーン</h2>
      <ul class="shop-campaign-list">
        <li class="shop-campain-item-wrap"><a class="clickable-button shop-campain-item" href="#">
            <div class="shop-campain-item-tri"></div>
            <div class="shop-campain-item-text">～クルーズ旅行やホテルレストランコースなどが当たる！～ 「旅・体験・食・生活」選べる秋のLove yourselfキャンペーン！</div><i class="fas fa-chevron-right shop-campain-item-arrow"></i></a></li>
        <li class="shop-campain-item-wrap"><a class="clickable-button shop-campain-item" href="#">
            <div class="shop-campain-item-tri"></div>
            <div class="shop-campain-item-text">ハンド脱毛体験無料プレゼント</div><i class="fas fa-chevron-right shop-campain-item-arrow"></i></a></li>
      </ul><a class="show-more clickable-button" href="/datsumou/shop/campaign.html">キャンペーンをもっと見る（4件）</a>
    </section>
    <section class="content middle-content shop-photo">
      <h2 class="content-title">投稿写真</h2>
      <div class="shop-photo-list">
        <ul class="shop-photo-list-sub">
          <li class="shop-photo-item"><a href="#"><img class="modal-trigger" src="/puril/images/img/datsumou/post/post-image-1.jpg" alt="投稿写真1"></a></li>
          <li class="shop-photo-item"><a href="#"><img class="modal-trigger" src="/puril/images/img/datsumou/post/post-image-2.jpg" alt="投稿写真2"></a></li>
          <li class="shop-photo-item"><a href="#"><img class="modal-trigger" src="/puril/images/img/datsumou/post/post-image-3.jpg" alt="投稿写真3"></a></li>
        </ul>
        <ul class="shop-photo-list-sub">
          <li class="shop-photo-item"><a href="#"><img class="modal-trigger" src="/puril/images/img/datsumou/post/post-image-4.jpg" alt="投稿写真4"></a></li>
          <li class="shop-photo-item"><a href="#"><img class="modal-trigger" src="/puril/images/img/datsumou/post/post-image-5.jpg" alt="投稿写真5"></a></li>
          <li class="shop-photo-item"><a href="#"><a href="/datsumou/shop/photo.html"><img src="/puril/images/img/datsumou/post/post-image-6.jpg" alt="投稿写真6">
                <div class="shop-photo-over"><img class="shop-photo-icon" src="/puril/images/img/datsumou/camera.png">
                  <div class="shop-photo-count">143</div>
                </div></a></a></li>
        </ul>
      </div>
    </section>
    <section class="content middle-content shop-kuchikomi">
      <h2 class="content-title">口コミ</h2>
      <ul class="shop-kuchikomi-list">
        <li class="shop-kuchikomi-item-wrap shop-kuchikomi-item-pickup">
          <div class="shop-kuchikomi-item-pickup-wrap">
            <div class="shop-kuchikomi-item-pickup-text">Purilが選ぶピックアップ！口コミ</div>
            <div class="shop-kuchikomi-item-pickup-star"><img src="/puril/images/img/datsumou/ribbon-star.png"></div>
          </div>
          <div class="shop-kuchikomi-item">
            <div class="shop-kuchikomi-item-above">
              <div class="shop-kuchikomi-title">美白脱毛の効果、実感しております。</div>
              <div class="shop-user-star-area">
                <div class="shop-star-area">
                  <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                  </div>
                  <div class="shop-point">4.6</div>
                </div>
              </div>
              <div class="shop-reviewer-area">
                <div class="shop-reviewer-name-area">
                  <div class="shop-reviewer-name">yazawasuzu0127</div>
                  <div class="shop-reviewer-count">（4,878）</div>
                </div>
                <div class="shop-reviewer-good-area"><i class="fas fa-heart shop-reviewer-good-icon"></i>
                  <div class="shop-reviewer-good-count">24件</div>
                </div>
              </div>
              <div class="shop-kuchikomi-month">2019/05</div><i class="fas fa-chevron-down shop-kuchikomi-arrow"></i>
            </div>
            <div class="shop-kuchikomi-item-below">
              <div class="shop-kuchikomi-item-detail-wrap">
                <div class="shop-kuchikomi-item-detail">
                  <div class="shop-kuchikomi-item-detail-title">この店舗を選んだ理由を教えてください。</div>
                  <p class="shop-kuchikomi-item-detail-text">HPやインスタで拝見し、技術の高い○○先生にお願いしたいと思いました。</p>
                </div>
                <div class="shop-kuchikomi-item-detail">
                  <div class="shop-kuchikomi-item-detail-title">店舗の「接客／サービス」はいかがでしたか？</div>
                  <div class="shop-kuchikomi-item-detail-review">
                    <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                    <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                  </div>
                  <p class="shop-kuchikomi-item-detail-text">スタッフさんの対応に大変好感が持てました。質問に対しても丁寧に答えてくださるほか、気さくに話かけてくれるので、楽しく通うことができています！</p>
                </div>
                <div class="shop-kuchikomi-item-detail">
                  <div class="shop-kuchikomi-item-detail-title">受けたサービスの「メニューや料金」についてはいかがでしたか？</div>
                  <div class="shop-kuchikomi-item-detail-review">
                    <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                    <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                  </div>
                  <p class="shop-kuchikomi-item-detail-text">料金には大変満足しています。私は学生で美容にあまりお金が掛けられないため、一番安いプランを選びました。しかし、Web上に書かれているプラン内容がややわかりづらいところはマイナスポイントです。</p>
                </div>
                <div class="shop-kuchikomi-item-detail">
                  <div class="shop-kuchikomi-item-detail-title">施術の「効果（技術や仕上がり）」はいかがでしたか？</div>
                  <div class="shop-kuchikomi-item-detail-review">
                    <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                    <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                  </div>
                  <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
                </div>
                <div class="shop-kuchikomi-item-detail">
                  <div class="shop-kuchikomi-item-detail-title">店舗の「雰囲気」はいかがでしたか？</div>
                  <div class="shop-kuchikomi-item-detail-review">
                    <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                    <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                  </div>
                  <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
                </div>
                <div class="shop-kuchikomi-item-detail">
                  <div class="shop-kuchikomi-item-detail-title">店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</div>
                  <div class="shop-kuchikomi-item-detail-review">
                    <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                    <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                  </div>
                  <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
                </div>
              </div>
              <div class="datsumou-kuchikomi-item-detail-button-area"><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-reply datsumou-kuchikomi-item-detail-button-icon"></i>
                  <div class="datsumou-kuchikomi-item-detail-button-text">返信</div></a><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-heart datsumou-kuchikomi-item-detail-button-icon"></i>
                  <div class="datsumou-kuchikomi-item-detail-button-text">いいね！</div></a></div>
            </div>
          </div>
        </li>
        <li class="shop-kuchikomi-item-wrap shop-kuchikomi-item">
          <div class="shop-kuchikomi-item-above">
            <div class="shop-kuchikomi-title">ストレスフリー</div>
            <div class="shop-user-star-area">
              <div class="shop-star-area">
                <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                </div>
                <div class="shop-point">4.6</div>
              </div>
            </div>
            <div class="shop-reviewer-area">
              <div class="shop-reviewer-name-area">
                <div class="shop-reviewer-name">yazawasuzu0127</div>
                <div class="shop-reviewer-count">（4,878）</div>
              </div>
              <div class="shop-reviewer-good-area"><i class="fas fa-heart shop-reviewer-good-icon"></i>
                <div class="shop-reviewer-good-count">24件</div>
              </div>
            </div>
            <div class="shop-kuchikomi-month">2019/05</div><i class="fas fa-chevron-down shop-kuchikomi-arrow"></i>
          </div>
          <div class="shop-kuchikomi-item-below">
            <div class="shop-kuchikomi-item-detail-wrap">
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">この店舗を選んだ理由を教えてください。</div>
                <p class="shop-kuchikomi-item-detail-text">HPやインスタで拝見し、技術の高い○○先生にお願いしたいと思いました。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">店舗の「接客／サービス」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">スタッフさんの対応に大変好感が持てました。質問に対しても丁寧に答えてくださるほか、気さくに話かけてくれるので、楽しく通うことができています！</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">受けたサービスの「メニューや料金」についてはいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">料金には大変満足しています。私は学生で美容にあまりお金が掛けられないため、一番安いプランを選びました。しかし、Web上に書かれているプラン内容がややわかりづらいところはマイナスポイントです。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">施術の「効果（技術や仕上がり）」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">店舗の「雰囲気」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
              </div>
            </div>
            <div class="datsumou-kuchikomi-item-detail-button-area"><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-reply datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">返信</div></a><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-heart datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">いいね！</div></a></div>
          </div>
        </li>
        <li class="shop-kuchikomi-item-wrap shop-kuchikomi-item">
          <div class="shop-kuchikomi-item-above">
            <div class="shop-kuchikomi-title">スタッフが一番よかった。</div>
            <div class="shop-user-star-area">
              <div class="shop-star-area">
                <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                </div>
                <div class="shop-point">4.6</div>
              </div>
            </div>
            <div class="shop-reviewer-area">
              <div class="shop-reviewer-name-area">
                <div class="shop-reviewer-name">yazawasuzu0127</div>
                <div class="shop-reviewer-count">（4,878）</div>
              </div>
              <div class="shop-reviewer-good-area"><i class="fas fa-heart shop-reviewer-good-icon"></i>
                <div class="shop-reviewer-good-count">24件</div>
              </div>
            </div>
            <div class="shop-kuchikomi-month">2019/05</div><i class="fas fa-chevron-down shop-kuchikomi-arrow"></i>
          </div>
          <div class="shop-kuchikomi-item-below">
            <div class="shop-kuchikomi-item-detail-wrap">
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">この店舗を選んだ理由を教えてください。</div>
                <p class="shop-kuchikomi-item-detail-text">HPやインスタで拝見し、技術の高い○○先生にお願いしたいと思いました。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">店舗の「接客／サービス」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">スタッフさんの対応に大変好感が持てました。質問に対しても丁寧に答えてくださるほか、気さくに話かけてくれるので、楽しく通うことができています！</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">受けたサービスの「メニューや料金」についてはいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">料金には大変満足しています。私は学生で美容にあまりお金が掛けられないため、一番安いプランを選びました。しかし、Web上に書かれているプラン内容がややわかりづらいところはマイナスポイントです。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">施術の「効果（技術や仕上がり）」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">店舗の「雰囲気」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
              </div>
              <div class="shop-kuchikomi-item-detail">
                <div class="shop-kuchikomi-item-detail-title">店舗の「通いやすさ／予約の取りやすさ」はいかがでしたか？</div>
                <div class="shop-kuchikomi-item-detail-review">
                  <div class="shop-kuchikomi-item-detail-review-tag">評価点</div>
                  <div class="shop-kuchikomi-item-detail-review-point">3.0                 </div>
                </div>
                <p class="shop-kuchikomi-item-detail-text">念入りに施術していただき、ほとんど寝てしまっていたくらい気持ち良かったです。本当にありがとうございました。これからの季節、冷えなどで体がまた固くなると思いますので、またお世話になると思います。</p>
              </div>
            </div>
            <div class="datsumou-kuchikomi-item-detail-button-area"><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-reply datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">返信</div></a><a class="clickable-button datsumou-kuchikomi-item-detail-button" href="#"><i class="fas fa-heart datsumou-kuchikomi-item-detail-button-icon"></i>
                <div class="datsumou-kuchikomi-item-detail-button-text">いいね！</div></a></div>
          </div>
        </li>
      </ul><a class="show-more clickable-button" href="/datsumou/shop/kuchikomi.html">口コミをもっと見る（4件）</a>
    </section>
    <section class="content middle-content shop-kuchikomi-post">
      <h2 class="content-title">口コミ投稿</h2>
      <div class="shop-kuchikomi-button-area"><a class="kuchikomi-button" href="#"><i class="fas fa-comments kuchikomi-button-icon"></i>
          <div class="kuchikomi-button-text">口コミを書く</div></a></div>
    </section>
    <section class="content middle-content shop-address">
      <h2 class="content-title">住所</h2>
      <div class="shop-address-fix">修正</div><a class="clickable-button shop-address-detail" href="/datsumou/shop/map.html">
        <div class="shop-address-text">東京都新宿区西新宿１-１９-８　新東京ビルディング5F</div><i class="fas fa-chevron-right shop-address-arrow"></i></a>
      <div class="shop-address-map">
        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3240.5524823565365!2d139.69463411561213!3d35.68801973720631!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x60188cd17873326d%3A0xba44e2bc68f545ca!2zS0lSRUlNT--8iOOCreODrOOCpOODou-8ieaWsOWuv-acrOW6lw!5e0!3m2!1sja!2sjp!4v1580176207356!5m2!1sja!2sjp" width="600" height="450" frameborder="0" style="border:0;" allowfullscreen=""></iframe>
      </div>
    </section>
    <section class="content middle-content shop-info-detail">
      <h2 class="content-title">店舗情報（詳細）</h2>
      <div class="shop-info-detail-area-wrap">
        <div class="shop-info-detail-area">
          <h3 class="shop-info-detail-title">店舗基本情報</h3>
          <table class="shop-info-detail-table">
            <tbody>
              <tr>
                <th>予約・お問い合わせ</th>
                <td class="tel-area-wrap"><a class="clickable-button tel-area" href="#"><i class="fas fa-phone-alt tel-icon"></i>
                    <div class="tel-number">0120-444-680</div></a></td>
              </tr>
              <tr>
                <th>予約可否</th>
                <td>予約可</td>
              </tr>
              <tr>
                <th>営業時間・定休日</th>
                <td>
                  <dt>営業時間</dt>
                  <dd>11:00～21:00※電話受付は20：00まで</dd>
                  <dt>定休日</dt>
                  <dd>不定休（※ビル休館日に準ずる）</dd>
                </td>
              </tr>
              <tr>
                <th>予算</th>
                <td>月額9,500円〜</td>
              </tr>
              <tr>
                <th>交通手段</th>
                <td>小田急線、丸ノ内線、大江戸線、京王線、JR各線「新宿駅」ルミネ口より徒歩3分</td>
              </tr>
              <tr>
                <th>支払い方法</th>
                <td>カード可（VISA／MasterCard／JCB／American Express／Diners）</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="shop-info-detail-area">
          <h3 class="shop-info-detail-title">スタッフ・駐車場</h3>
          <table class="shop-info-detail-table">
            <tbody>
              <tr>
                <th>スタッフ人数</th>
                <td>総数10人(スタッフ10人)</td>
              </tr>
              <tr>
                <th>駐車場</th>
                <td>無(近隣の北口駐車場、南口フェイス地下駐車場、船橋駅東駐車場ご利用ください。)</td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="shop-info-detail-area">
          <h3 class="shop-info-detail-title">料金プラン</h3>
          <table class="shop-info-detail-table">
            <tbody>
              <tr>
                <th>月額定額プラン</th>
                <td>
                  <dd>
                    <p>スリムアップ脱毛…月額9,500円(税抜)</p>
                    <p>脱毛部位：全身</p>
                  </dd>
                  <dd>
                    <p>プレミアム美白脱毛…月額12,800円(税抜)</p>
                    <p>脱毛部位：全身</p>
                  </dd>
                </td>
              </tr>
              <tr>
                <th>パックプラン</th>
                <td>
                  <dd>
                    <p>6回…114,000円(税抜)</p>
                    <p>脱毛部位：全身　回数：6回</p>
                  </dd>
                  <dd>
                    <p>12回…212,040円(税抜)</p>
                    <p>脱毛部位：全身　回数：12回</p>
                  </dd>
                </td>
              </tr>
            </tbody>
          </table>
        </div>
        <div class="shop-info-detail-area">
          <h3 class="shop-info-detail-title">特徴・関連情報</h3>
          <table class="shop-info-detail-table">
            <tbody>
              <tr>
                <th>ホームページ</th>
                <td><a href="https://kireimo.jp/lp181019/?adcode=aaaf_06&amp;hc_uus=750da4f43047826f16d914aaed697ee6">https://kireimo.jp/lp181019/?adcode=aaaf_06&hc_uus=750da4f43047826f16d914aaed697ee6</a></td>
              </tr>
              <tr>
                <th>公式アカウント</th>
                <td><a href="#"><i class="fab fa-twitter twitter-icon"></i></a></td>
              </tr>
              <tr>
                <th>電話番号</th>
                <td>0120-444-680</td>
              </tr>
              <tr>
                <th>備考</th>
                <td>※備考ダミー備考ダミー備考ダミー備考ダミー備考備考ダミー備考ダミー備考ダミー備考ダミー備考ダ備考ダミー備考ダミー</td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <div class="shop-info-detail-remark">●●の店舗情報に誤りがある場合は、以下からご連絡をお願い致します。</div>
      <div class="shop-info-detail-report"><a class="clickable-button shop-info-detail-report-button" href="#">誤りを報告する</a></div>
    </section>
    <section class="content shop-share">
      <h2 class="content-title">シェア</h2>
      <div class="share-twitter"><a class="clickable-button share-twitter-button" href="#"><i class="fab fa-twitter twitter-icon"></i>
          <div class="share-twitter-text">Twitter</div></a></div>
    </section>
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
    <footer class="content shop-footer"><a class="button-base kuchikomi-button" href="/datsumou/kuchikomi-entry.html"><i class="fas fa-phone-alt kuchikomi-button-icon"></i>
        <div class="kuchikomi-button-text">口コミを書く</div></a><a class="button-base reservatopn-button" href="#"><i class="fas fa-phone-alt reservatopn-button-icon"></i>
        <div class="reservatopn-button-text">電話・ネット予約</div></a></footer>
    <div class="content photo-modal" id="photo-modal">
      <div class="photo-detail-wrap">
        <header class="datsumou-photo-header">
          <div class="datsumou-photo-header-inner"><a class="clickable-button" href="#" id="photo-modal-close"><i class="fas fa-times datsumou-photo-header-cancel"></i></a>
            <div class="datsumou-photo-header-main">1/6</div>
            <div class="datsumou-photo-header-void"></div>
          </div>
        </header>
        <div class="photo-detail-main"><img class="photo-detail-img" src="/puril/images/img/datsumou/post/post-image-2-large.jpg" alt="投稿写真2" id="photo-detail-img"></div>
        <div class="photo-detail-below">
          <div class="photo-detail-info">
            <div class="photo-detail-info-date">2019/07</div>
            <div class="photo-detail-info-name">by taro</div>
          </div>
          <div class="photo-detail-like"><a class="clickable-button photo-detail-like-area" href="#"><i class="fas fa-heart photo-detail-like-icon"></i>
              <div class="photo-detail-like-text">いいね！</div></a><a class="photo-detail-like-kuchikomi" href="/datsumou/shopuser/kuchikomi.html">この写真の口コミをみる</a></div>
          <div class="datsumou-photo-footer">
            <div class="datsumou-photo-footer-inner">※写真はユーザーが通院した当時の内容ですので、最新の情報とは異なる可能性があります。</div>
          </div>
          <div class="photo-detail-see-all">全ての写真を見る（143枚）</div>
        </div>
      </div>
    </div>
    <script type="text/javascript" src="/js/datsumou/shop/common.js"></script>
    <script type="text/javascript" src="/js/datsumou/photo-modal.js"></script>
  </body>
</html>