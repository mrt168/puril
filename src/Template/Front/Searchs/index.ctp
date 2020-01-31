<?php
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
?>
<body>
<?php
echo $this->Html->css('datsumou');
echo $this->Html->css(['css/main', 'css/search']);
?>
<header class="datsumou-header">
    <?php
    echo $this->element('Front/header')
    ?>

    <div class="datsumou-header-mv">
        <div class="datsumou-header-mv-inner">
            <p><span class="datsumou-header-mv-inner__text--large">みんな</span>の</p>
            <p><span class="datsumou-header-mv-inner__text--middle">脱毛口コミ</span>サイト</p>
            <div class="datsumou-header-mv-inner__text-search__list">
                <p>掲載件数</p>
                <p class="datsumou-header-mv-inner__text--middle">10000件以上！</p>
            </div>
        </div>
    </div>
</header>
<div class="Search">

    <div class="Search__contents">
        <div class="Search__title"><span>脱毛サロン・クリニックを全国から探す</span></div>
        <div class="Search__input">
            <div class="Search__input__inner">
                <div class="input1"><input type="" name="" placeholder="エリア、駅、サロン・クリニック名で検索する"></div>
                <!--
                <div class="input2"><input type="" name="" placeholder="サロン・クリニック名"></div>
                -->
                <button class="search"><img src="/puril/images/ico_search_wht.svg" alt="絞込み"></button>
            </div>
        </div>
<!--        <div class="Search__btns">-->
<!--            <a href="" class="Search__btn" data-color="default">脱毛サロン</a>-->
<!--            <a href="" class="Search__btn" data-color="white">医療脱毛クリニック</a>-->
<!--        </div>-->
        <ul class="Search__list">
            <?php
            foreach ($prefs as $pref) {
                ?>
                <li>
                    <?php
                    echo $this->Html->link($pref['pref'].'('.$pref['salon_cnt'].')', ['controller'=> 'searchs', 'action'=> 'search', $pref['url_text']]);
                    ?>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
</div>
<a href="https://puril.net/campaign/">
    <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
</a>

<div class="Search__breadcrumbs">
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span
                        itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <span itemprop="name">脱毛</span>
            <meta itemprop="position" content="2">
        </li>
    </ol>
</div>
<div class="Search__breadcrumbs">
    <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span
                    itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/datsumou')?>"><span itemprop="name">脱毛</span></a>
            <meta itemprop="position" content="2">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php echo "<span itemprop='name'>全国の脱毛施設</span>"?>
            <meta itemprop="position" content="3">
        </li>
    </ol>
</div>
<?php
echo $this->element('Front/footer') ?>
</body>