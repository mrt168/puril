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
</header>
<div class="Search">

    <div class="Search__contents">
        <div class="Search__title"><span>脱毛サロン・クリニックを全国から探す</span></div>
        <div class="Search__input">
            <?php
            echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true, 'id'=> 'form01', 'class'=> 'cf', 'templates'=> ['submitContainer'=> '{{content}}']]);
            ?>
            <div class="Search__input__inner">
                <div class="input1"><?php echo $this->ExForm->text('Make.free_word', ['id'=> 'input01', 'placeholder'=> 'エリア、駅、サロン・クリニック名で検索する']);?>
                </div>
                <!--
            <div class="input2"><input type="" name="" placeholder="サロン・クリニック名"></div>
            -->
                <button class="search" type="submit" name="free_word_search"><img
                            src="/puril/images/ico_search_wht.png" alt="絞込み"></button>
            </div>
            <?php
            echo $this->ExForm->end();
            ?>
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
    <ol>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/')?>"><span itemprop="name"  class="name">TOP</span></a>
            <meta itemprop="position" content="1">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <a itemtype="http://schema.org/Thing" itemprop="item"
               href="<?=Router::url('/datsumou')?>"><span itemprop="name" class="name">脱毛</span></a>
            <meta itemprop="position" content="2">
        </li>
        <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
            <?php echo "<span itemprop='name' class='name'>全国の脱毛施設</span>"?>
            <meta itemprop="position" content="3">
        </li>
    </ol>
</div>
<?php
echo $this->element('Front/footer') ?>
</body>