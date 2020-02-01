<?php
use Cake\Routing\Router;
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\ORM\TableRegistry;
use App\Vendor\Code\ShopType;

$this->layout = 'default';
$this->assign ( 'title', 'Puril' );
?>
<body>
<?php
echo $this->Html->css('sitemap');
?>
<header class="not-found-header">
    <div class="not-found-header-inner">
        <img class="home-header-inner__img" src="puril/images/header-logo-sp.png" srcset="puril/images/header-logo-sp.png 1x, puril/images/header-logo-sp@2x.png 2x" alt="puril">
        <div class="menu-area">
            <input type="checkbox" id="menu">
            <label for="menu"></label>
            <ul class="menu-item">
                <li>
                    <a href="">
                        <p>テキスト</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>テキスト</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>テキスト</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <p>テキスト</p>
                    </a>
                </li>
            </ul>
        </div>
</header>
<main class="sitemap-main not-found-main">
    <div class="not-found-text-area">
        <img class="not-found__img" src="puril/images/logo-404-sp.png" alt="puril">
        <p class="not-found-text-area__large">お探しのページが見つかりません</p>
        <p>
            お探しのページは、存在しないか削除された可能性があります。
            お手数では御座いますが、以下の情報より、再度目的のページをお探しいただけますと幸いです。
        </p>
        <p class="not-found-back-to-top">
            <img src="puril/images/arrow-right.png" alt=""><a href="/">トップページへ</a>
        </p>
    </div>
    <ul class="area-search__list">
        <li class="area-search__list-li active">脱毛</li>
        <li class="area-search__list-li no-link">リラク</li>
        <li class="area-search__list-li no-link">フェイシャル</li>
        <li class="area-search__list-li no-link">痩身</li>
    </ul>
    <h2 class="area-search__link">
        <?php
        echo $this->Html->link("脱毛店舗を全国から探す", ['controller'=> 'searchs', 'action'=> 'index'], ['escape'=> false]);
        ?>
    </h2>
    <?php
    $shopTypes = ShopType::valueOf();
    foreach ($shopTypes as $shopType) {
        ?>
        <ul class="find_salon area-search">
            <li>
                <h3>
                    <?php
                    echo $this->Html->link( $shopType[CodePattern::$VALUE]."を全国から探す", ['controller'=> 'searchs', 'action'=> 'search', $shopType[CodePattern::$VALUE2]], ['escape'=> false]);
                    ?>
                </h3>
            </li>
            <?php
            foreach ($regionPrefs as $region => $prefDatas) {
                ?>
                <li><?php echo $region?>
                    <?php
                    foreach ($prefDatas as $prefCode => $prefUrlText) {
                        ?>
                        <?php
                        $prefVal = Pref::convert($prefCode, CodePattern::$VALUE);
                        echo $this->Html->link($prefVal, ['controller'=> 'searchs', 'action'=> 'search', $prefUrlText, $shopType[CodePattern::$VALUE2]]);
                        ?>
                        <?php
                    }
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
        <?php
    }
    ?>
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

    <?php echo $this->Html->link('店舗名から探す', ['controller'=> 'brands', 'action'=> 'index'],['escape'=> false,'class'=>'area-search__link']);?>
    <?php echo $this->Html->link('全国の脱毛ランキング', ['controller'=> 'rankings', 'action'=> 'search'],['escape'=> false,'class'=>'area-search__link']);?>
    <?php echo $this->Html->link('全国の脱毛サロンのランキング', ['controller'=> 'rankings', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]],['escape'=> false,'class'=>'area-search__link-small']);?>
    <?php echo $this->Html->link('全国の医療脱毛クリニックのランキング', ['controller'=> 'rankings', 'action'=> 'search', ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]],['escape'=> false,'class'=>'area-search__link-small']);?>
    <?php echo $this->Html->link('全国のメンズ脱毛のランキング', ['controller'=> 'rankings', 'action'=> 'search', 'mens'],['escape'=> false,'class'=>'area-search__link-small']);?>

    <a class="area-search__link">お問い合わせ</a>
    <?php echo $this->Html->link('ユーザーレビューのお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact_user'],['class'=>'area-search__link-small']);?>
    <?php echo $this->Html->link('施設情報掲載のお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact'],['class'=>'area-search__link-small']);?>
    <a class="area-search__link">その他</a>
    <?php echo $this->Html->link('プライバシーポリシー', ['controller'=> 'indexes', 'action'=> 'privacyPolicy'],['class'=>'area-search__link-small']);?>
    <?php echo $this->Html->link('利用規約', ['controller'=> 'indexes', 'action'=> 'terms'],['class'=>'area-search__link-small last']);?>

</main>


<footer class="not-found-footer">
    <img class="not-found-bnr" src="puril/images/cash-back-bnr-sp.png" alt="">

    <div class="Search__breadcrumbs">
        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href=""><span itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
                <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <span itemprop="name" class="name">プライバシーポリシー</span>
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