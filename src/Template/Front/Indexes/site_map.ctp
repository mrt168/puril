<?php
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use App\Vendor\Code\Pref;
?>
<body>
<?php
echo $this->Html->css('sitemap');
?>
  <header class="sitemap-header">
    <p class="sitemap-header__back"><i class="fas fa-chevron-left"></i><span>ホーム</span></p>
    <div class="sitemap-header-title">サイトマップ</div>
  </header>

  <main class="sitemap-main">
    <ul class="area-search__list">
      <li class="area-search__list-li active">脱毛</li>
      <li class="area-search__list-li">リラク</li>
      <li class="area-search__list-li">フェイシャル</li>
      <li class="area-search__list-li">痩身</li>
    </ul>
    <h2 class="area-search__link"><a href="">脱毛店舗を全国から探す</a></h2>
    <ul class="find_salon area-search">
      <li>
        <h3>
          <a class="find_salon area-search__title" href="">脱毛サロンを全国から探す</a>
        </h3>
      </li>
      <li>
      北海道・東北｜
        <a href="/not-found/search/hokkaido/salon/">北海道</a>｜
        <a href="/not-found/search/aomori/salon/">青森</a>｜
        <a href="/not-found/search/akita/salon/">秋田</a>｜
        <a href="/not-found/search/yamagata/salon/">山形</a>｜
        <a href="/not-found/search/iwate/salon/">岩手</a>｜
        <a href="/not-found/search/miyagi/salon/">宮城</a>｜
        <a href="/not-found/search/fukushima/salon/">福島</a>｜
      </li>
      <li>
        関東｜
        <a href="/not-found/search/tokyo/salon/">東京</a>｜
        <a href="/not-found/search/kanagawa/salon/">神奈川</a>｜
        <a href="/not-found/search/saitama/salon/">埼玉</a>｜
        <a href="/not-found/search/chiba/salon/">千葉</a>｜
        <a href="/not-found/search/ibaragi/salon/">茨城</a>｜
        <a href="/not-found/search/tochigi/salon/">栃木</a>｜
        <a href="/not-found/search/gunnma/salon/">群馬</a>｜
      </li>
      <li>
        北陸・甲信越｜
        <a href="/not-found/search/niigata/salon/">新潟</a>｜
        <a href="/not-found/search/yamanashi/salon/">山梨</a>｜
        <a href="/not-found/search/nagano/salon/">長野</a>｜
        <a href="/not-found/search/ishikawa/salon/">石川</a>｜
        <a href="/not-found/search/toyama/salon/">富山</a>｜
        <a href="/not-found/search/fukui/salon/">福井</a>｜
      </li>
      <li>
        中部｜
        <a href="/not-found/search/aichi/salon/">愛知</a>｜
        <a href="/not-found/search/gifu/salon/">岐阜</a>｜
        <a href="/not-found/search/mie/salon/">三重</a>｜
        <a href="/not-found/search/shizuoka/salon/">静岡</a>｜
      </li>
      <li>
        関西｜
        <a href="/not-found/search/oosaka/salon/">大阪</a>｜
        <a href="/not-found/search/hyougo/salon/">兵庫</a>｜
        <a href="/not-found/search/kyouto/salon/">京都</a>｜
        <a href="/not-found/search/shiga/salon/">滋賀</a>｜
        <a href="/not-found/search/nara/salon/">奈良</a>｜
        <a href="/not-found/search/wakayama/salon/">和歌山</a>｜
      </li>
      <li>
      中国｜
        <a href="/not-found/search/okayama/salon/">岡山</a>｜
        <a href="/not-found/search/hiroshima/salon/">広島</a>｜
        <a href="/not-found/search/tottori/salon/">鳥取</a>｜
        <a href="/not-found/search/shimane/salon/">島根</a>｜
        <a href="/not-found/search/yamaguchi/salon/">山口</a>｜
      </li>
      <li>
      四国｜
        <a href="/not-found/search/kagawa/salon/">香川</a>｜
        <a href="/not-found/search/tokushima/salon/">徳島</a>｜
        <a href="/not-found/search/ehime/salon/">愛媛</a>｜
        <a href="/not-found/search/kouchi/salon/">高知</a>｜
      </li>
      <li>
      九州・沖縄｜
        <a href="/not-found/search/fukuoka/salon/">福岡</a>｜
        <a href="/not-found/search/saga/salon/">佐賀</a>｜
        <a href="/not-found/search/nagasaki/salon/">長崎</a>｜
        <a href="/not-found/search/kumamoto/salon/">熊本</a>｜
        <a href="/not-found/search/ooita/salon/">大分</a>｜
        <a href="/not-found/search/miyazaki/salon/">宮崎</a>｜
        <a href="/not-found/search/kagoshima/salon/">鹿児島</a>｜
        <a href="/not-found/search/okinawa/salon/">沖縄</a>｜
      </li>
    </ul>
    <ul class="find_salon area-search">
      <li>
        <h3>
          <a class="find_salon area-search__title" href="">医療脱毛クリニックを全国から探す</a class="find_salon area-search-title">
        </h3>
      </li>
      <li>
        <th>北海道・東北</th>
        <a href="/not-found/search/hokkaido/clinic/">北海道</a>｜
        <a href="/not-found/search/aomori/clinic/">青森</a>｜
        <a href="/not-found/search/akita/clinic/">秋田</a>｜
        <a href="/not-found/search/yamagata/clinic/">山形</a>｜
        <a href="/not-found/search/iwate/clinic/">岩手</a>｜
        <a href="/not-found/search/miyagi/clinic/">宮城</a>｜
        <a href="/not-found/search/fukushima/clinic/">福島</a>｜
      </li>
      <li>
      <th>関東</th>
      <a href="/not-found/search/tokyo/clinic/">東京</a>｜
      <a href="/not-found/search/kanagawa/clinic/">神奈川</a>｜
      <a href="/not-found/search/saitama/clinic/">埼玉</a>｜
      <a href="/not-found/search/chiba/clinic/">千葉</a>｜
      <a href="/not-found/search/ibaragi/clinic/">茨城</a>｜
      <a href="/not-found/search/tochigi/clinic/">栃木</a>｜
      <a href="/not-found/search/gunnma/clinic/">群馬</a>｜
      </li>
      <li>
      <th>北陸・甲信越</th>
      <a href="/not-found/search/niigata/clinic/">新潟</a>｜
      <a href="/not-found/search/yamanashi/clinic/">山梨</a>｜
      <a href="/not-found/search/nagano/clinic/">長野</a>｜
      <a href="/not-found/search/ishikawa/clinic/">石川</a>｜
      <a href="/not-found/search/toyama/clinic/">富山</a>｜
      <a href="/not-found/search/fukui/clinic/">福井</a>｜
      </li>
      <li>
      <th>中部</th>
      <a href="/not-found/search/aichi/clinic/">愛知</a>｜
      <a href="/not-found/search/gifu/clinic/">岐阜</a>｜
      <a href="/not-found/search/mie/clinic/">三重</a>｜
      <a href="/not-found/search/shizuoka/clinic/">静岡</a>｜
      </li>
      <li>
      <th>関西</th>
      <a href="/not-found/search/oosaka/clinic/">大阪</a>｜
      <a href="/not-found/search/hyougo/clinic/">兵庫</a>｜
      <a href="/not-found/search/kyouto/clinic/">京都</a>｜
      <a href="/not-found/search/shiga/clinic/">滋賀</a>｜
      <a href="/not-found/search/nara/clinic/">奈良</a>｜
      <a href="/not-found/search/wakayama/clinic/">和歌山</a>｜
      </li>
      <li>
      <th>中国</th>
      <a href="/not-found/search/okayama/clinic/">岡山</a>｜
      <a href="/not-found/search/hiroshima/clinic/">広島</a>｜
      <a href="/not-found/search/tottori/clinic/">鳥取</a>｜
      <a href="/not-found/search/shimane/clinic/">島根</a>｜
      <a href="/not-found/search/yamaguchi/clinic/">山口</a>｜
      </li>
      <li>
      <th>四国</th>
      <a href="/not-found/search/kagawa/clinic/">香川</a>｜
      <a href="/not-found/search/tokushima/clinic/">徳島</a>｜
      <a href="/not-found/search/ehime/clinic/">愛媛</a>｜
      <a href="/not-found/search/kouchi/clinic/">高知</a>｜
      </li>
      <li>
      <th>九州・沖縄</th>
      <a href="/not-found/search/fukuoka/clinic/">福岡</a>｜
      <a href="/not-found/search/saga/clinic/">佐賀</a>｜
      <a href="/not-found/search/nagasaki/clinic/">長崎</a>｜
      <a href="/not-found/search/kumamoto/clinic/">熊本</a>｜
      <a href="/not-found/search/ooita/clinic/">大分</a>｜
      <a href="/not-found/search/miyazaki/clinic/">宮崎</a>｜
      <a href="/not-found/search/kagoshima/clinic/">鹿児島</a>｜
      <a href="/not-found/search/okinawa/clinic/">沖縄</a>｜
      </li>
    </ul>
    <a class="area-search__link">店舗名から探す</a>
    <a class="area-search__link">全国の脱毛ランキング</a>
    <a class="area-search__link-small">全国の脱毛サロンのランキング</a>
    <a class="area-search__link-small">全国の医療脱毛クリニックのランキング</a>
    <a class="area-search__link-small">全国のメンズ脱毛のランキング</a>
    <a class="area-search__link">お問い合わせ</a>
    <a class="area-search__link-small">ユーザーレビューのお問い合わせ</a>
    <a class="area-search__link-small">施設情報掲載のお問い合わせ</a>
    <a class="area-search__link">その他</a>
    <a class="area-search__link-small">プライバシーポリシー</a>
    <a class="area-search__link-small last">利用規約</a>

  </main>

  <footer class="not-found-footer">
    <img class="not-found-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">

    <div class="Search__breadcrumbs">
      <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
          <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
              <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href=""><span itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
              <meta itemprop="position" content="1">
          </li>
          <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
              <span itemprop="name">プライバシーポリシー</span>
              <meta itemprop="position" content="2">
          </li>
      </ol>
  </div>

    <div class="not-found-footer__inner">
        <ul class="not-found-footer__category01">
            <li class="not-found-footer__category__li nolink">
                <a href="/datsumou/" class="not-found-footer__category__li__link">脱毛</a>
            </li>
            <li class="not-found-footer__category__li nolink">
                <a href="" class="not-found-footer__category__li__link">リラク</a>
            </li>
            <li class="not-found-footer__category__li nolink">
                <a href="" class="not-found-footer__category__li__link">痩身</a>
            </li>
            <li class="not-found-footer__category__li nolink">
                <a href="" class="not-found-footer__category__li__link">フェイシャル</a>
            </li>
        </ul>

        <ul class="not-found-footer__category02">
            <li class="not-found-footer__category__li">
            	<a href="https://tsuru-tsuru.co.jp/" target="_blank" class="not-found-footer__category__li__link">運営企業</a>
            </li>
            <li class="not-found-footer__category__li">
                <a href="/regulation" class="not-found-footer__category__li__link">利用規約</a>
            </li>
            <li class="not-found-footer__category__li">
                <a href="/privacy-policy" class="not-found-footer__category__li__link">プライバシーポリシー</a>
            </li>
            <li class="not-found-footer__category__li">
                <a href="/sitemap" class="not-found-footer__category__li__link">サイトマップ</a>
            </li>
        </ul>
        <ul class="not-found-footer__category03">
            <li class="not-found-footer__category__li">
                <a href="https://puril.net/campaign/" class="not-found-footer__category__li__link">口コミキャッシュバック</a>
            </li>
            <li class="not-found-footer__category__li">
                <a href="/form_user" class="not-found-footer__category__li__link">ユーザーレビューのお問い合わせ</a>
            </li>
            <li class="not-found-footer__category__li last">
                <a href="/form_facility" class="not-found-footer__category__li__link">施設情報掲載のお問い合わせ</a>
            </li>
        </ul>
    </div>
    <div class="not-found-footer__credit">
        <img src="puril/images/footer-logo-sp.png" alt="">
        <p>Copyright © ツルツル株式会社 All rights reserved.</p>
    </div>
  </footer>

</body>