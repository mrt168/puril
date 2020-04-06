<?php
use App\Vendor\Constants;
use Cake\Routing\Router;
?>
<div id="afbkwjs" style="display:none;"><script type="text/javascript" src="//track.affiliate-b.com/or/kw.js?ps=j648053O" async></script></div>
<div class="datsumou-header-inner">
    <a href="/">
    <img class="datsumou-header-inner__img" src="/puril/images/header-logo-sp.png"
         srcset="/puril/images/header-logo-sp.png 1x, /puril/images/header-logo-sp@2x.png 2x" alt="puril">
    </a>
    <p class="datsumou-header-inner__text">美容サロンの口コミサイト</p>
    <button type="button" class="datsumou-header-inner__navToggle">
        <span></span><span></span><span></span>
    </button>
    <nav class="datsumou-header-inner__globalmenusp">
        <p class="datsumou-header-inner__globalmenusp__logo">
            <a href="/">
                <img src="/puril/images/header-logo-sp.png"
                     srcset="/puril/images/header-logo-sp.png 1x, /puril/images/header-logo-sp@2x.png 2x"
                     alt="puril" />
            </a>
        </p>

        <ul class="datsumou-header-inner__globalmenusp__linkboxs">
            <li class="datsumou-header-inner__globalmenusp__linkbox">
                <a href="/" class="datsumou-header-inner__globalmenusp__link" data-icon="home">Pupil TOP</a>
            </li>
            <li class="datsumou-header-inner__globalmenusp__linkbox">
                <span class="datsumou-header-inner__globalmenusp__link close js-spmenu_acc" data-icon="search">脱毛店舗を検索</span>
                <ul class="datsumou-header-inner__globalmenusp__submenu">
                    <li><a href="/datsumou/search">検索TOP</a></li>
                    <li><a href="/datsumou/search/salon">脱毛サロンを探す</a></li>
                    <li><a href="/datsumou/search/clinic">医療脱毛クリニックを探す</a></li>
                    <li><a href="/datsumou/search">ランキングから探す</a></li>
                </ul>
            </li>
            <li class="datsumou-header-inner__globalmenusp__linkbox">
                <?php echo $this->Html->link('お問い合わせ', ['controller'=> 'contacts', 'action'=> 'contact_user'],['class'=>'datsumou-header-inner__globalmenusp__link']);?>
            </li>
        </ul>
        <div class="datsumou-header-inner__globalmenusp__sns">
            <a href="//twitter.com/share?url=https://puril.net" class="datsumou-header-inner__globalmenusp__sns__item" target="_blank"><i class="fab fa-twitter"></i><span>ツイート</span></a>
            <a href="//www.facebook.com/sharer/sharer.php?u=https://puril.net" class="datsumou-header-inner__globalmenusp__sns__item" target="_blank"><i class="fab fa-facebook-f"></i></i><span>シェア</span></a>
            <a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" class="datsumou-header-inner__globalmenusp__sns__item" target="_blank"><img src="/puril/images/ico_hatena.svg" alt=""></i><span>はてぶ</span></a>
            <a href="//line.me/R/msg/text/?https://puril.net" class="datsumou-header-inner__globalmenusp__sns__item" target="_blank"><img src="/puril/images/ico_line.svg" alt=""></i><span>シェア</span></a>
        </div>
    </nav>
</div>
<script>
    //ハンバーガーメニュー
    $(function() {
        $(document).on("click", ".datsumou-header-inner__navToggle", function() {
            console.log("hoge");
            $(".datsumou-header-inner__navToggle").toggleClass("active");
            $(".datsumou-header-inner__globalmenusp").toggleClass("active");
        });

        $(".datsumou-header-inner__globalmenusp__link").on("click", function() {
            if (window.innerWidth <= 768) {
                // $(".datsumou-header-inner__navToggle").click();
            }
        });

        //　アコーディオン
        $('.js-spmenu_acc').on('click',function(){
            $('.datsumou-header-inner__globalmenusp__submenu').slideToggle();
        });

    });
</script>