<?php
use App\Vendor\PagingUtil;
use Cake\Routing\Router;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\URLUtil;
use PHP_CodeSniffer\Tokenizers\PHP;
use App\Vendor\Code\Pref;
use App\Vendor\Code\Sex;
?>
  <body>
  <?php
    echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/ranking/index']);
  ?>
    <header class="datsumou-header">
      <div class="datsumou-header-inner"><a href="#"><img class="datsumou-header-puril" src="/puril/images/img/puril-colored.png" alt="Puril"></a><a href="#"><i class="fas fa-bars datsumou-header-hamburger"></i></a></div>
    </header>
    <h1 class="content ranking-title">全国の脱毛サロンの人気ランキング</h1>
    <p class="content ranking-text">Purilに寄せられた口コミに基づいて、ランキング形式で人気順にご紹介！全国の店舗ランキングはもちろん、ブランドごとのランキングもご覧いただけます！</p>
    <ul class="content-base ranking-category">
      <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
          <div class="ranking-category-item-text">全国の医療脱毛の人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
          <div class="ranking-category-item-text">ブランドランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
          <div class="ranking-category-item-text">都道府県別ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    </ul>
    <div class="content-base ranking-shop">
      <ul class="ranking-shop-list">
        <li class="content ranking-shop-item"><a class="plain-link" href="/datsumou/shop/">
            <div class="ranking-shop-title"><i class="fas fa-crown ranking-shop-title-icon crown-first"></i>
              <div class="ranking-shop-title-text">キレイモ 新宿本店</div>
            </div>
            <div class="ranking-shop-photo-area">
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/post/post-shop-image.jpg" alt="KIREIMO"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
            </div>
            <div class="ranking-shop-label">
              <div class="ranking-shop-review">
                <div class="shop-star-area">
                  <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                  </div>
                  <div class="shop-point">4.6</div>
                </div>
                <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                  <div class="shop-comment-count">142件</div>
                </div>
              </div>
              <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
            </div>
            <div class="ranking-shop-comment">
              <ul class="ranking-shop-comment-list">
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">美白脱毛の効果、実感してお…</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">ストレスフリー</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
              </ul>
            </div></a></li>
        <li class="content middle-content ranking-shop-item"><a class="plain-link" href="/datsumou/shop/">
            <div class="ranking-shop-title"><i class="fas fa-crown ranking-shop-title-icon crown-second"></i>
              <div class="ranking-shop-title-text">キレイモ 新宿本店</div>
            </div>
            <div class="ranking-shop-photo-area">
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/post/post-shop-image.jpg" alt="KIREIMO"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
            </div>
            <div class="ranking-shop-label">
              <div class="ranking-shop-review">
                <div class="shop-star-area">
                  <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                  </div>
                  <div class="shop-point">4.6</div>
                </div>
                <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                  <div class="shop-comment-count">142件</div>
                </div>
              </div>
              <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
            </div>
            <div class="ranking-shop-comment">
              <ul class="ranking-shop-comment-list">
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">美白脱毛の効果、実感してお…</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">ストレスフリー</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
              </ul>
            </div></a></li>
        <li class="content middle-content ranking-shop-item"><a class="plain-link" href="/datsumou/shop/">
            <div class="ranking-shop-title"><i class="fas fa-crown ranking-shop-title-icon crown-third"></i>
              <div class="ranking-shop-title-text">キレイモ 新宿本店</div>
            </div>
            <div class="ranking-shop-photo-area">
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/post/post-shop-image.jpg" alt="KIREIMO"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
            </div>
            <div class="ranking-shop-label">
              <div class="ranking-shop-review">
                <div class="shop-star-area">
                  <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                  </div>
                  <div class="shop-point">4.6</div>
                </div>
                <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                  <div class="shop-comment-count">142件</div>
                </div>
              </div>
              <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
            </div>
            <div class="ranking-shop-comment">
              <ul class="ranking-shop-comment-list">
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">美白脱毛の効果、実感してお…</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">ストレスフリー</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
              </ul>
            </div></a></li>
        <li class="content middle-content ranking-shop-item"><a class="plain-link" href="/datsumou/shop/">
            <div class="ranking-shop-title">
              <div class="ranking-shop-title-icon ranking-shop-title-icon-forth">4</div>
              <div class="ranking-shop-title-text">キレイモ 新宿本店</div>
            </div>
            <div class="ranking-shop-photo-area">
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/post/post-shop-image.jpg" alt="KIREIMO"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
            </div>
            <div class="ranking-shop-label">
              <div class="ranking-shop-review">
                <div class="shop-star-area">
                  <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                  </div>
                  <div class="shop-point">4.6</div>
                </div>
                <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                  <div class="shop-comment-count">142件</div>
                </div>
              </div>
              <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
            </div>
            <div class="ranking-shop-comment">
              <ul class="ranking-shop-comment-list">
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">美白脱毛の効果、実感してお…</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">ストレスフリー</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
              </ul>
            </div></a></li>
        <li class="content ranking-shop-item"><a class="plain-link" href="/datsumou/shop/">
            <div class="ranking-shop-title">
              <div class="ranking-shop-title-icon ranking-shop-title-icon-fifth">5</div>
              <div class="ranking-shop-title-text">キレイモ 新宿本店</div>
            </div>
            <div class="ranking-shop-photo-area">
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/post/post-shop-image.jpg" alt="KIREIMO"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
              <div class="ranking-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
            </div>
            <div class="ranking-shop-label">
              <div class="ranking-shop-review">
                <div class="shop-star-area">
                  <div class="shop-star"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-on.png"><img src="/puril/images/img/star-off.png"><img src="/puril/images/img/star-off.png">
                  </div>
                  <div class="shop-point">4.6</div>
                </div>
                <div class="shop-comment-area"><i class="shop-comment-icon fas fa-comments"></i>
                  <div class="shop-comment-count">142件</div>
                </div>
              </div>
              <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
            </div>
            <div class="ranking-shop-comment">
              <ul class="ranking-shop-comment-list">
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">美白脱毛の効果、実感してお…</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
                <li class="ranking-shop-comment-item">
                  <div class="ranking-shop-comment-text">ストレスフリー</div>
                  <div class="ranking-shop-comment-user">yazawasuzu0127（4,878）</div>
                </li>
              </ul>
            </div></a></li>
      </ul>
    </div>
    <ul class="content-base ranking-category">
      <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
          <div class="ranking-category-item-text">全国の医療脱毛の人気ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
          <div class="ranking-category-item-text">ブランドランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-category-item-wrap"><a class="plain-link ranking-category-item" href="#"><i class="fas fa-crown ranking-category-item-icon"></i>
          <div class="ranking-category-item-text">都道府県別ランキング</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    </ul>
    <div class="content ranking-search-salon">
      <h2 class="ranking-search-salon-title">サロン・クリニックを探す</h2>
      <div class="ranking-search-salon-options"><a class="plain-link ranking-search-salon-option ranking-search-salon-areastation" href="#"><img class="ranking-search-salon-option-img" src="/puril/images/img/datsumou/area-and-station.png" alt="エリア・駅から探す">
          <div class="ranking-search-salon-option-text">エリア・駅から探す</div></a><a class="plain-link ranking-search-salon-option ranking-search-salon-currentsite" href="#"><img class="ranking-search-salon-option-img" src="/puril/images/img/datsumou/current-site.png" alt="現在地から探す">
          <div class="ranking-search-salon-option-text">現在地から探す</div></a></div>
    </div>
    <ul class="content ranking-searchfrom">
      <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><img class="ranking-searchfrom-item-icon" src="/puril/images/img/japan.png">
          <div class="ranking-searchfrom-item-text">地域から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="fas fa-user ranking-searchfrom-item-icon"></i>
          <div class="ranking-searchfrom-item-text">脱毛部位から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="fas fa-newspaper ranking-searchfrom-item-icon"></i>
          <div class="ranking-searchfrom-item-text">脱毛サロン・クリニック一覧から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="fas fa-comments ranking-searchfrom-item-icon"></i>
          <div class="ranking-searchfrom-item-text">口コミから探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
      <li class="ranking-searchfrom-item-wrap"><a class="plain-link ranking-searchfrom-item" href="#"><i class="far fa-hand-point-right ranking-searchfrom-item-icon"></i>
          <div class="ranking-searchfrom-item-text">こだわり条件から探す</div><i class="fas fa-chevron-right right-side-arrow"></i></a></li>
    </ul>
    <div class="content-base campaign"><a href="#"><img src="/puril/images/img/datsumou/brand/cashback-campaign.jpg" alt="キャッシュバックキャンペーン"></a></div>
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
    <div class="content links">
      <ul class="links-list">
        <li class="links-item"><a href="#">脱毛</a></li>
        <li class="links-item"><a href="#">リラク</a></li>
        <li class="links-item"><a href="#">痩身</a></li>
        <li class="links-item"><a href="#">フェイシャル</a></li>
        <li class="links-item"><a href="#">運営企業</a></li>
        <li class="links-item"><a href="#">利用規約</a></li>
        <li class="links-item"><a href="#">プライバシーポリシー</a></li>
        <li class="links-item"><a href="#">サイトマップ</a></li>
        <li class="links-item"><a href="#">口コミキャッシュバック</a></li>
        <li class="links-item"><a href="#">ユーザーレビューのお問い合わせ</a></li>
        <li class="links-item"><a href="#">施設情報掲載のお問い合わせ</a></li>
      </ul>
    </div>
    <div class="content-base footer"><img class="footer-puril" src="/puril/images/img/puril.png" alt="Puril">
      <div class="footer-copy">Copyright © ツルツル株式会社 All rights reserved.</div>
    </div>
    <footer class="content datsumou-footer">
      <ul class="datsumou-footer-list">
        <li class="datsumou-footer-item active"><a href="/datsumou/search/"><i class="fas fa-search datsumou-footer-item-icon"></i>
            <div class="datsumou-footer-item-text">探す</div></a></li>
        <li class="datsumou-footer-item"><a href="#"><i class="fas fa-comments datsumou-footer-item-icon"></i>
            <div class="datsumou-footer-item-text">口コミ</div></a></li>
        <li class="datsumou-footer-item"><a href="/datsumou/ranking/"><i class="fas fa-crown datsumou-footer-item-icon"></i>
            <div class="datsumou-footer-item-text">ランキング</div></a></li>
      </ul>
    </footer>
  </body>
</html>