<?php
use App\Vendor\Code\ShopType;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
?>
<div id="pcnav" class="pc">
    <div class="inner">
        <ul class="cf">
            <li>
                <?php
                echo $this->Html->link(
                    '<span class="icon">'. $this->Html->image('/img/nav_pink_icon01.png', array('alt'=> '脱毛サロンを探す')). '</span><span class="txt">脱毛サロンを探す</span>',
                    ['controller'=> 'searchs', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2], ""],
                    ['escape'=> false]
                );
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                    '<span class="icon">'. $this->Html->image('/img/nav_pink_icon02.png', array('alt'=> '医療脱毛を探す')). '</span><span class="txt">医療脱毛を探す</span>',
                    ['controller'=> 'searchs', 'action'=> 'search', ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]],
                    ['escape'=> false]
                );
                ?>
            </li>
            <li>
                <?php
                echo $this->Html->link(
                    '<span class="icon">'. $this->Html->image('/img/nav_pink_icon06.png', array('alt'=> '店舗名から探す')). '</span><span class="txt">店舗名から探す</span>',
                    ['controller'=> 'brands', 'action'=> 'index'],
                    ['escape'=> false]
                );
                ?>
            </li>
            <li class="open_mddWrap">
                <?php
                echo $this->Html->link(
                    '<span class="icon">'. $this->Html->image('/img/nav_pink_icon03.png', ['alt'=> '口コミランキング']). '</span><span class="txt">口コミランキング</span>',
                    ['controller'=> 'rankings', 'action'=> 'index'],
                    ['escape'=> false]
                );
                ?>
                <div class="mddWrap">
                    <div class="mddIn">
                        <ul class="dropContent cf">
                            <li><?=$this->Html->link('<span>全国総合ランキング</span>', ['controller'=> 'rankings', 'action'=> 'index'], ['escape'=> false])?></li>
                            <li><?=$this->Html->link('<span>脱毛サロン<br>ランキング</span>', ['controller'=> 'rankings', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]], ['escape'=> false])?></li>
                            <li><?=$this->Html->link('<span>医療脱毛<br>ランキング</span>', ['controller'=> 'rankings', 'action'=> 'search', ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]], ['escape'=> false])?></li>
                            <li><?=$this->Html->link('<span>メンズ脱毛<br>ランキング</span>', ['controller'=> 'rankings', 'action'=> 'search', 'mens'], ['escape'=> false])?></li>
                        </ul><!--.dropContent-->
                    </div>
                </div><!-- /.mddWrap -->
            </li>
            <li class="open_mddWrap">
                <a href="/column/">
                    <span class="icon"><?php echo $this->Html->image('/img/nav_pink_icon05.png', ['alt'=> 'みんなの脱毛コラム']);?></span>
                    <span class="txt">みんなの脱毛コラム</span>
                </a>
                <div class="mddWrap">
                    <div class="mddIn">
                        <ul class="dropContent cf">
                            <li><a href="/column/useful/"><span>脱毛お役立ち情報</span></a></li>
                            <li><a href="/column/qa/"><span>脱毛Q &amp; A</span></a></li>
                            <li><a href="/column/salon/"><span>脱毛サロン情報</span></a></li>
                            <li><a href="/column/clinic/"><span>医療脱毛<br>クリニック情報</span></a></li>
                            <li><a href="/column/special/"><span>Puril特選記事</span></a></li>
                            <li><a href="/column/mens/"><span>メンズ脱毛</span></a></li>
                            <li><a href="/column/epilator/"><span>家庭用脱毛器</span></a></li>
                            <li><a href="/column/cream/"><span>脱毛クリーム</span></a></li>
                            <li><a href="/column/soap/"><span>脱毛石鹸</span></a></li>
                            <li><a href="/column/wax/"><span>ブラジリアン<br>ワックス</span></a></li>
                            <li><a href="/column/campaign/"><span>キャンペーン<br>モニター</span></a></li>
                        </ul><!--.dropContent-->
                    </div>
                </div><!-- /.mddWrap -->
            </li>
        </ul>
    </div>
</div>
<!-- ナビゲーションの中身 -->
<nav class="drawer-nav sp" role="navigation">
    <ul class="drawer-menu">
        <!-- ドロップダウンの中身 -->
        <li class="menu01"><a class="drawer-menu-item" href="/">Puril TOP</a></li>
        <li class="menu02 drawer-dropdown"><a class="drawer-menu-item" href="#" data-toggle="dropdown">脱毛店舗を検索<span class="drawer-caret"></span></a>
            <ul class="drawer-dropdown-menu">
                <li><?php echo $this->Html->link('検索TOP', ['controller'=> 'searchs', 'action'=> 'index'], ['class'=> 'drawer-dropdown-menu-item']);?></li>
                <li><?php echo $this->Html->link('脱毛サロンを探す', ['controller'=> 'searchs', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]], ['class'=> 'drawer-dropdown-menu-item']);?></li>
                <li><?php echo $this->Html->link('医療脱毛クリニックを探す', ['controller'=> 'searchs', 'action'=> 'search', ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]], ['class'=> 'drawer-dropdown-menu-item']);?></li>
            </ul>
        </li>
        <li class="menu03 drawer-dropdown"><a class="drawer-menu-item" href="#" data-toggle="dropdown">店舗名から探す<span class="drawer-caret"></span></a>
            <ul class="drawer-dropdown-menu">
                <li><a class="drawer-dropdown-menu-item" href="<?=Router::url(['controller'=> 'brands', 'action'=> 'index'])?>/#brands_salon">脱毛サロンを探す</a></li>
                <li><a class="drawer-dropdown-menu-item" href="<?=Router::url(['controller'=> 'brands', 'action'=> 'index'])?>/#brands_clinic">医療脱毛クリニックを探す</a></li>
            </ul>
        </li>
        <li class="menu04 drawer-dropdown"><a class="drawer-menu-item" href="#" data-toggle="dropdown">口コミランキング<span class="drawer-caret"></span></a>
            <ul class="drawer-dropdown-menu">
                <li><?=$this->Html->link('ランキングTOP', ['controller'=> 'rankings', 'action'=> 'index'], ['class'=> 'drawer-dropdown-menu-item'])?></li>
                <li><?=$this->Html->link('脱毛サロンランキング', ['controller'=> 'rankings', 'action'=> 'search', ShopType::$DEPILATION_SALON[CodePattern::$VALUE2]], ['class'=> 'drawer-dropdown-menu-item'])?></li>
                <li><?=$this->Html->link('医療脱毛クリニックランキング', ['controller'=> 'rankings', 'action'=> 'search', ShopType::$MEDICAL_DEPILATION_CLINIC[CodePattern::$VALUE2]], ['class'=> 'drawer-dropdown-menu-item'])?></li>
                <li><?=$this->Html->link('メンズ脱毛ランキング', ['controller'=> 'rankings', 'action'=> 'search', 'mens'], ['class'=> 'drawer-dropdown-menu-item'])?></li>
            </ul>
        </li>
        <li class="menu05 drawer-dropdown"><a class="drawer-menu-item" href="#" data-toggle="dropdown">みんなの脱毛コラム<span class="drawer-caret"></span></a>
            <ul class="drawer-dropdown-menu">
                <li><a class="drawer-dropdown-menu-item" href="/column/">みんなの脱毛コラムTOP</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/useful/">脱毛お役立ち情報</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/qa/">脱毛Q &amp; A</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/salon/">脱毛サロン情報</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/clinic/">医療脱毛クリニック情報</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/special/">Puril特選記事</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/mens/">メンズ脱毛</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/epilator/">家庭用脱毛器</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/cream/">脱毛クリーム</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/soap/">脱毛石鹸</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/wax/">ブラジリアンワックス</a></li>
                <li><a class="drawer-dropdown-menu-item" href="/column/campaign/">キャンペーン・モニター</a></li>
            </ul>
        </li>
        <li class="menu06 drawer-dropdown"><a class="drawer-menu-item" href="#" data-toggle="dropdown">お問い合わせ<span class="drawer-caret"></span></a>
            <ul class="drawer-dropdown-menu">
                <li><?php echo $this->Html->link('施設情報掲載のお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact'], ['class'=> 'drawer-dropdown-menu-item']);?></li>
                <li><?php echo $this->Html->link('ユーザーレビューのお問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact_user'], ['class'=> 'drawer-dropdown-menu-item']);?></li>
            </ul>
        </li>
    </ul>
    <ul class="NavSns">
        <li class="in"><a href="https://www.instagram.com/datsumou.love?ref=badge" target="_blank">
                <?php echo $this->Html->image('/img/icon_drawer_in.png', ['alt'=> ''])?>
                <span class="text">フォロー</span></a></li>
        <li class="tw"><a href="http://twitter.com/share?url=https://puril.net" target="_blank">
                <?php echo $this->Html->image('/img/icon_drawer_tw.png', ['alt'=> ''])?><span class="text">ツイート</span></a></li>
        <li class="fb"><a href="https://www.facebook.com/sharer/sharer.php?u=https://puril.net" target="_blank">
                <?php echo $this->Html->image('/img/icon_drawer_fb.png', ['alt'=> ''])?><span class="text">シェア</span></a></li>
        <li class="hb"><a href="https://b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow">
                <?php echo $this->Html->image('/img/icon_drawer_hate.png', ['alt'=> ''])?><span class="text">はてぶ</span></a></li>
        <li class="li"><a href="http://line.me/R/msg/text/?https://puril.net" target="_blank">
                <?php echo $this->Html->image('/img/icon_drawer_li.png', ['alt'=> ''])?><span class="text">シェア</span></a></li>
    </ul>
</nav>