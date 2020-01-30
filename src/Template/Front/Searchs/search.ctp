<?php
use Cake\Routing\Router;
use App\Vendor\URLUtil;
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Route\Route;
use App\Vendor\Code\Pref;
use App\Vendor\PagingUtil;
?>
  <body>
  <?php
    echo $this->Html->css(['reset', 'all.min', 'Chart.min','common', 'datsumou/common', 'datsumou/search/index']);
  ?>
    <header class="datsumou-search-header">
      <div class="datsumou-search-header-inner"><a href="#"><i class="fas fa-chevron-left datsumou-search-header-arrow"></i></a>
        <div class="datsumou-search-header-input-area"><i class="fas fa-search datsumou-search-header-input-search"></i>
          <input class="datsumou-search-header-input" type="text" placeholder="サロン・クリニック名を…"><i class="fas fa-times-circle datsumou-search-header-input-cancel"></i>
        </div><a href="#"><img class="datsumou-search-header-twobar" src="/puril/images/img/datsumou/twobar.png"></a>
      </div>
    </header>
    <div class="content search-condition">
      <div class="search-condition-text">新宿駅 / 脱毛サロン</div>
      <div class="button-base search-condition-change"><i class="fas fa-search search-condition-change-icon"></i><a class="plain-link search-condition-change-text" href="#">条件変更</a></div>
    </div>
    <div class="content-base search-shop">
      <ul class="search-shop-list">
        <li class="content search-shop-item"><a class="plain-link" href="/datsumou/shop/">
            <h2 class="search-shop-title">
              <div class="search-shop-title-text">キレイモ 新宿本店</div>
              <div class="search-shop-title-tags">
                <div class="datsumou-shop-tag-button datsumou-shop-tag-puril">Puril認定店舗</div>
                <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
              </div>
            </h2>
            <div class="search-shop-title-sub">新宿駅 / 脱毛サロン</div>
            <div class="search-shop-photo-area">
              <div class="search-shop-photo"><img src="/puril/images/img/datsumou/post/post-shop-image.jpg" alt="KIREIMO"></div>
              <div class="search-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
              <div class="search-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
            </div>
            <div class="search-shop-tips">◆選べる5箇所無料キャンペーン実施中！！痛くない脱毛ならメンズキレイモ</div>
            <div class="search-shop-label">
              <div class="search-shop-review">
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
            <div class="search-shop-desc">
              <h3 class="search-shop-desc-title">業界口コミ＆予約が取りやすい脱毛サロンNo.1</h3>
              <div class="search-shop-desc-text">
                <p>タレントやモデルの来店多数で業界口コミNo.1！スリムアップ美容全身脱毛で脱毛しながら美しいボディラインを実現します。予約も取りやすいから忙しくても通いやすい♪キレイモ一号店でありプロフェッショナルのスタッフが、お客様のキレイのために全力でサポートしていますよ！各線「新宿駅」から近く便利◎</p>
              </div>
            </div>
            <div class="search-shop-info">
              <table>
                <tbody>
                  <tr>
                    <th>住所</th>
                    <td>〒160-0023 東京都新宿区西新宿１丁目１９−８ 新東京ビルディング 5F</td>
                  </tr>
                  <tr>
                    <th>最寄り駅</th>
                    <td>新宿駅</td>
                  </tr>
                  <tr>
                    <th>営業時間</th>
                    <td>11:00～21:00（年末年始除く）</td>
                  </tr>
                  <tr>
                    <th>定休日</th>
                    <td>年末年始</td>
                  </tr>
                </tbody>
              </table>
            </div></a></li>
        <li class="content search-shop-item"><a class="plain-link" href="/datsumou/shop/">
            <h2 class="search-shop-title">
              <div class="search-shop-title-text">キレイモ 新宿本店</div>
              <div class="search-shop-title-tags">
                <div class="datsumou-shop-tag-button datsumou-shop-tag-puril">Puril認定店舗</div>
                <div class="datsumou-shop-tag-button datsumou-shop-tag-campaign">キャンペーン対象</div>
              </div>
            </h2>
            <div class="search-shop-title-sub">新宿駅 / 脱毛サロン</div>
            <div class="search-shop-photo-area">
              <div class="search-shop-photo"><img src="/puril/images/img/datsumou/post/post-shop-image.jpg" alt="KIREIMO"></div>
              <div class="search-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
              <div class="search-shop-photo"><img src="/puril/images/img/datsumou/no-photo.jpg"></div>
            </div>
            <div class="search-shop-tips">◆選べる5箇所無料キャンペーン実施中！！痛くない脱毛ならメンズキレイモ</div>
            <div class="search-shop-label">
              <div class="search-shop-review">
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
            <div class="search-shop-desc">
              <h3 class="search-shop-desc-title">業界口コミ＆予約が取りやすい脱毛サロンNo.1</h3>
              <div class="search-shop-desc-text">
                <p>タレントやモデルの来店多数で業界口コミNo.1！スリムアップ美容全身脱毛で脱毛しながら美しいボディラインを実現します。予約も取りやすいから忙しくても通いやすい♪キレイモ一号店でありプロフェッショナルのスタッフが、お客様のキレイのために全力でサポートしていますよ！各線「新宿駅」から近く便利◎</p>
              </div>
            </div>
            <div class="search-shop-info">
              <table>
                <tbody>
                  <tr>
                    <th>住所</th>
                    <td>〒160-0023 東京都新宿区西新宿１丁目１９−８ 新東京ビルディング 5F</td>
                  </tr>
                  <tr>
                    <th>最寄り駅</th>
                    <td>新宿駅</td>
                  </tr>
                  <tr>
                    <th>営業時間</th>
                    <td>11:00～21:00（年末年始除く）</td>
                  </tr>
                  <tr>
                    <th>定休日</th>
                    <td>年末年始</td>
                  </tr>
                </tbody>
              </table>
            </div></a></li>
      </ul>
    </div>
    <div class="content-base search-shop-best">
      <ul class="search-shop-best-list">
        <li class="search-shop-best-item"><a class="plain-link" href="/datsumou/brand/">
            <div class="search-shop-best-rank"><i class="fas fa-crown search-shop-best-rank-crown crown-first"></i>
              <div class="search-shop-best-rank-point">4.25</div>
            </div><img class="search-shop-best-img" src="/puril/images/img/datsumou/search/kireimo.png" alt="キレイモ">
            <div class="search-shop-best-name">キレイモ</div></a></li>
        <li class="search-shop-best-item"><a class="plain-link" href="#">
            <div class="search-shop-best-rank"><i class="fas fa-crown search-shop-best-rank-crown crown-second"></i>
              <div class="search-shop-best-rank-point">3.96</div>
            </div><img class="search-shop-best-img" src="/puril/images/img/datsumou/search/musee.png" alt="ミュゼプラチナム">
            <div class="search-shop-best-name">ミュゼプラチナム</div></a></li>
        <li class="search-shop-best-item"><a class="plain-link" href="#">
            <div class="search-shop-best-rank"><i class="fas fa-crown search-shop-best-rank-crown crown-third"></i>
              <div class="search-shop-best-rank-point">3.91</div>
            </div><img class="search-shop-best-img" src="/puril/images/img/datsumou/search/stlassh.png" alt="STLASSH">
            <div class="search-shop-best-name">STLASSH</div></a></li>
      </ul>
      <div class="search-shop-ranking"><a class="button-base search-shop-rainking-button" href="#">ランキングを見る</a></div>
    </div>
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