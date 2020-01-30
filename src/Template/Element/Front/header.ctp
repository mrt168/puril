<?php
use App\Vendor\Constants;
use Cake\Routing\Router;
?>
<div id="afbkwjs" style="display:none;"><script type="text/javascript" src="//track.affiliate-b.com/or/kw.js?ps=j648053O" async></script></div>
<header id="header">
    <div class="inner">
        <div class="headwrap cf">
            <div class="snsshare cf">
                <ul>
                    <li class="in"><a href="//www.instagram.com/datsumou.love?ref=badge" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_insta.png', ['fullBase' => true,'alt'=> 'instagram']);?></a></li>
                    <li class="tw"><a href="//twitter.com/share?url=https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_twitter.png', ['fullBase' => true,'alt'=> 'twitter']);?></a></li>
                    <li class="fb"><a href="//www.facebook.com/sharer/sharer.php?u=https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_fb.png', ['fullBase' => true,'alt'=> 'facebook']);?></a></li>
                    <li class="hb"><a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow"><?php echo $this->Html->image('/img/home/header_icon_hatebu.png', ['fullBase' => true,'alt'=> 'hatebu']);?></a></li>
                    <li class="li"><a href="//line.me/R/msg/text/?https://puril.net" target="_blank"><?php echo $this->Html->image('/img/home/header_icon_line.png', ['fullBase' => true,'alt'=> 'line']);?></a></li>
                </ul>
            </div>
            <div class="logarea">
                <?php
                if ($this->name == "Searchs" || $this->name == "Shops") {
                    ?>
                    <a href="javascript:history.back()" class="backbtn sp"><?php echo $this->Html->image('/img/btn_back.png', ['class'=>'header_back_pc','alt'=> '戻る']);?><?php echo $this->Html->image('/img/btn_back_sp.jpg', ['class'=>'header_back_sp','alt'=> '戻る']);?></a>
                    <?php
                }
                ?>
                <div class="logarea__left">
                    <div class="logarea__left__box">
                        <h1 class="log"><a href="<?php echo Router::url('/')?>"><?php echo $this->Html->image('/img/home/header_logo.png', ['alt'=> Constants::CONSUME_TITLE]);?></a></h1>
                    </div>
                </div>
                <button type="button" class="drawer-toggle drawer-hamburger menubtn sp">
                    <span class="sr-only">toggle navigation</span>
                    <span class="drawer-hamburger-icon"></span>
                </button>
            </div>
        </div>
    </div>
</header>