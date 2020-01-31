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
                <li><th><?php echo $region?></th>
                    <?php
                    foreach ($prefDatas as $prefCode => $prefUrlText) {
                        ?>
                        <?php
                        $prefVal = Pref::convert($prefCode, CodePattern::$VALUE);
                        echo $this->Html->link($prefVal, ['controller'=> 'searchs', 'action'=> 'search', $prefUrlText, $shopType[CodePattern::$VALUE2]]).'｜';
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
    <img class="not-found-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">

    <div class="Search__breadcrumbs">
        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href=""><span itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
                <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <span itemprop="name">サイトマップ</span>
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
                <a href="" class="not-found-footer__category__li__link no-link">リラク</a>
            </li>
            <li class="not-found-footer__category__li nolink">
                <a href="" class="not-found-footer__category__li__link no-link">痩身</a>
            </li>
            <li class="not-found-footer__category__li nolink">
                <a href="" class="not-found-footer__category__li__link no-link">フェイシャル</a>
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
<?php
echo $this->element('Front/no_voice_modal') ?>
</body>