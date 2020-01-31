<?php
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
?>
<body>
<?php
echo $this->Html->css(['css/main', 'css/search']);
?>
<div class="Search">
    <header class="Search__header">
        <div class="Search__header__inner">
            <a href="#" class="Search__header__close"><img src="/puril/images/ico_close.svg" alt="閉じる"></a>
            <div class="Search__header__title">全国から探す</div>
        </div>
    </header>
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
    <div class="Search__breadcrumbs">
        <ol itemscope itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href=""><span itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
                <meta itemprop="position" content="1" />
            </li>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <a itemscope itemtype="http://schema.org/Thing" itemprop="item" href=""><span itemprop="name">脱毛</span></a>
                <meta itemprop="position" content="2" />
            </li>
            <li itemprop="itemListElement" itemscope itemtype="http://schema.org/ListItem">
                <span itemprop="name">全国の脱毛施設</span>
                <meta itemprop="position" content="3" />
            </li>
        </ol>
    </div>
</div>
</body>