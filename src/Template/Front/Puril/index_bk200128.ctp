<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
?>
<body class="Puril">
<header class="Header">
    <div class="Header__inner">
        <div class="Header__logo">
            <a href="<?php echo Router::url('/')?>" class="Header__logo">
                <img class="Header__logo__img" src="/puril/images/header_logo.png" alt="puril">
            </a>
            <p>美容サロン・クリニックの<br>口コミサイト</p>
        </div>
            <a href="<?php echo Router::url('/')?>" class="Header__logo__sp">
                <img class="Header__logo__img__sp" src="/puril/images/header_logo_sp.png" alt="puril">
            </a>
        <nav class="Header__nav">
            <a href="//twitter.com/share?url=https://puril.net" target="_blank" class="Header__nav__sns__li__link">
                <img src="/puril/images/header_bnr.png" alt="puril">
            </a>
            <ul class="Header__nav__sns">
                <li class="Header__nav__sns__li">
                    <a href="//twitter.com/share?url=https://puril.net" target="_blank" class="Header__nav__sns__li__link">
                        <img class="Header__nav__sns__li__link__icon" src="/puril/images/header_icon_insta.png" alt="twitter">
                    </a>
                </li>
                <li class="Header__nav__sns__li">
                    <a href="//twitter.com/share?url=https://puril.net" target="_blank" class="Header__nav__sns__li__link">
                        <img class="Header__nav__sns__li__link__icon" src="/puril/images/header_icon_twitter.png" alt="twitter">
                    </a>
                </li>
                <li class="Header__nav__sns__li">
                    <a href="//www.facebook.com/sharer/sharer.php?u=https://puril.net" target="_blank" class="Header__nav__sns__li__link">
                        <img class="Header__nav__sns__li__link__icon" src="/puril/images/header_icon_fb.png" alt="facebook">
                    </a>
                </li>
                <li class="Header__nav__sns__li">
                    <a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow" class="Header__nav__sns__li__link">
                        <img class="Header__nav__sns__li__link__icon" src="/puril/images/header_icon_hatebu.png" alt="hatebu">
                    </a>
                </li>
                <li class="Header__nav__sns__li">
                    <a href="//line.me/R/msg/text/?https://puril.net" target="_blank" class="Header__nav__sns__li__link">
                        <img class="Header__nav__sns__li__link__icon" src="/puril/images/header_icon_line.png" alt="line">
                    </a>
                </li>
            </ul>
        </nav>
    </div>
    <div class="Header__nav__genre">
        <ul class="Header__nav__genre__inner">
            <li class="Header__nav__genre__inner__li">
                <a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow" class="Header__nav__genre__inner__li__link">
                    脱毛
                </a>
            </li>
            <li class="Header__nav__genre__inner__li">
                <a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow" class="Header__nav__genre__inner__li__link">
                    リラク
                </a>
            </li>
            <li class="Header__nav__genre__inner__li">
                <a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow" class="Header__nav__genre__inner__li__link">
                    フェイシャル
                </a>
            </li>
            <li class="Header__nav__genre__inner__li">
                <a href="//b.hatena.ne.jp/add?mode=confirm&url=https://puril.net" target="_blank" rel="nofollow" class="Header__nav__genre__inner__li__link">
                    痩身
                </a>
            </li>
        </ul>
    </div>
</header>
<div class="Main">
    <div class="Fv">
        <div class="Fv__inner">
            <div class="Fv__box">
                <h2 class="Fv__box__title">
                    <span class="Fv__box__title__big">みんな</span>の<br>
                    <span class="Fv__box__title__middle">美容口コミ</span>サイト
                </h2>
                <p class="Fv__box__published">掲載件数10000件以上！</p>
                <p class="Fv__box__sup">※2019年10月 自社調べ</p>
            </div>
        </div>
    </div>
    <div class="Search">
    <?php
            echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true, 'id'=> 'form02', 'class'=> 'Search__inner']);
            ?>
        <p class="Search__label">店舗を探す</p>
        <div class="Search__form">
            <div class="Search__form__inner">
                <div class="Search__form__genre">
                    <select name="genre" id="genre" class="Search__form__genre__select">
                        <option value="">ジャンル</option>
                        <option value="datsumou">脱毛</option>
                    </select>
                    <i class="fas fa-angle-down"></i>
                </div>
                <div class="Search__form__pref">
                    <select name="pref" class="Search__form__pref__select">
                        <option value="" selected>都道府県</option>
                        <option value="1">北海道</option>
                        <option value="2">青森県</option>
                        <option value="3">岩手県</option>
                        <option value="4">宮城県</option>
                        <option value="5">秋田県</option>
                        <option value="6">山形県</option>
                        <option value="7">福島県</option>
                        <option value="8">茨城県</option>
                        <option value="9">栃木県</option>
                        <option value="10">群馬県</option>
                        <option value="11">埼玉県</option>
                        <option value="12">千葉県</option>
                        <option value="13">東京都</option>
                        <option value="14">神奈川県</option>
                        <option value="15">新潟県</option>
                        <option value="16">富山県</option>
                        <option value="17">石川県</option>
                        <option value="18">福井県</option>
                        <option value="19">山梨県</option>
                        <option value="20">長野県</option>
                        <option value="21">岐阜県</option>
                        <option value="22">静岡県</option>
                        <option value="23">愛知県</option>
                        <option value="24">三重県</option>
                        <option value="25">滋賀県</option>
                        <option value="26">京都府</option>
                        <option value="27">大阪府</option>
                        <option value="28">兵庫県</option>
                        <option value="29">奈良県</option>
                        <option value="30">和歌山県</option>
                        <option value="31">鳥取県</option>
                        <option value="32">島根県</option>
                        <option value="33">岡山県</option>
                        <option value="34">広島県</option>
                        <option value="35">山口県</option>
                        <option value="36">徳島県</option>
                        <option value="37">香川県</option>
                        <option value="38">愛媛県</option>
                        <option value="39">高知県</option>
                        <option value="40">福岡県</option>
                        <option value="41">佐賀県</option>
                        <option value="42">長崎県</option>
                        <option value="43">熊本県</option>
                        <option value="44">大分県</option>
                        <option value="45">宮崎県</option>
                        <option value="46">鹿児島県</option>
                        <option value="47">沖縄県</option>
                    </select>
                </div>
            </div>
            <input type="text" name="Make[free_word]" placeholder="フリーワード" class="Search__form__freeword">
            <button type="submit" name="free_word_search" class="Search__form__btn">
                <i class="fas fa-search Search__form__btn__ico"></i><p class="Search__form__btn__text">検索する</p>
            </button>
        </div>
        <?php
	        echo $this->ExForm->end();
            ?>
    </div>
    <section class="Genre Section">
        <h2 class="Title Genre__title"><!-- <i class="fas fa-search"></i> --><span class="Title__text Genre__title__text">ジャンルから探す</span></h2>
        <div class="Genre__list">
            <a href="<?php echo Router::url('/datsumou/')?>" class="Genre__list__box Genre__list__box--datsumou">
                <div class="Genre__list__box__text">
                    <h3 class="Genre__list__box__text__main">脱毛</h3>
                </div>
                <div class="Genre__list__box__img">
                    <img class="Genre__list__box__img__img" src="/puril/images/datsumou.png" alt="脱毛">
                </div>
            </a>
            <a href="" class="Genre__list__box Genre__list__box--relax nolink">
                <div class="Genre__list__box__text">
                    <h3 class="Genre__list__box__text__main">リラク</h3>
                    <p class="Genre__list__box__text__ready">※準備中</p>
                </div>
                <div class="Genre__list__box__img">
                    <img class="Genre__list__box__img__img" src="/puril/images/relax.png" alt="リラク">
                </div>
            </a>
            <a href="" class="Genre__list__box Genre__list__box--facial nolink">
                <div class="Genre__list__box__text">
                    <h3 class="Genre__list__box__text__main">フェイシャル</h3>
                    <p class="Genre__list__box__text__ready">※準備中</p>
                </div>
                <div class="Genre__list__box__img">
                    <img class="Genre__list__box__img__img" src="/puril/images/facial.png" alt="フェイシャル">
                </div>
            </a>
            <a href="" class="Genre__list__box Genre__list__box--soushin nolink">
                <div class="Genre__list__box__text">
                    <h3 class="Genre__list__box__text__main">痩身</h3>
                    <p class="Genre__list__box__text__ready">※準備中</p>
                </div>
                <div class="Genre__list__box__img">
                    <img class="Genre__list__box__img__img" src="/puril/images/soushin.png" alt="痩身">
                </div>
            </a>
        </div>
    </section>
    <section class="Reviews Section">
        <h2 class="Title Reviews__title"><!-- <i class="fas fa-search"></i> --><span class="Title__text Reviews__title__text">口コミから探す</span></h2>
        <ul class="Reviews__list">
            <li class="Reviews__list__box">
                <p class="Reviews__list__genre datsumou">脱毛</p>
                    <div class="Reviews__list__user">
                        <img class="Reviews__list__user__icon" src="https://placehold.jp/43x43.png" alt="ダミーダミーダミー">
                        <div>
                        <p class="Reviews__list__user__title">ダミーダミーダミー</p>
                        <span class="Reviews__list__user__review"><span><span>★★★★</span>★</span>4.6</span>
                    </div>
                </div>
                <p class="Reviews__list__user__name"><i class="fas fa-user pink"></i>投稿者 : A.Minami</p>
                <p class="Reviews__list__text">ダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミーダミー</p>
            </li>
        </ul>
    </section>

    <img class="Campaign__bnr" src="/puril/images/campaign_bnr.png" alt="キャッシュバックキャンペーン">

    <section class="Users Section">
        <h2 class="Title Users__title"><!-- <i class="fas fa-search"></i> --><span class="Title__text Users__title__text">人気のユーザーから探す</span></h2>
        <ul class="Users__list">
            <li class="Users__list__box">
                <div class="Users__list__user">
                    <img class="Users__list__user__icon" src="https://placehold.jp/70x70.png" alt="ダミーダミーダミー">
                    <p class="Users__list__user__name">山本彩未</p>
                </div>
                <p class="Users__list__user__instagram"><span>Instagram</span>フォロワー：19,462人</p>
                <p class="Users__list__text">
                    彩未🍓【𝐚𝐲𝐚𝐦𝐢】<br>
                    𝐶𝑟𝑒𝑎𝑡𝑖𝑣𝑒 𝐷𝑖𝑟𝑒𝑐𝑡𝑜𝑟<br>
                    @bikotsushiki_primula<br>
                    ﻿andGIRL/model/Miss Grand japan2017<br>
                    ∇ Tokyo<br>
                    ✎写真悪用禁止<br>
                    アカウントはこれだけ❣️<br>
                </p>
            </li>
        </ul>
    </section>

    <section class="Areas Section">
        <h2 class="Title Areas__title"><!-- <i class="fas fa-search"></i> --><span class="Title__text Areas__title__text">人気のエリアから探す</span></h2>
        <ul class="Areas__list">
            <li class="Areas__list_li">脱毛</li>
            <li class="Areas__list_li">リラク</li>
            <li class="Areas__list_li">フェイシャル</li>
            <li class="Areas__list_li">痩身</li>
        </ul>
        <div class="Areas__box">内容</div>
    </section>

    <section class="Shops Section">
        <h2 class="Title Shops__title"><!-- <i class="fas fa-search"></i> --><span class="Title__text Shops__title__text">Puril認定店舗</span></h2>
        <ul class="Shops__list">
            <li class="Shops__list__li">
                <img class="Shops__list__icon" src="https://placehold.jp/210x96.png" alt="ダミーダミーダミー">
                <h3 class="Shops__list__title">ダミーダミーダミー</h3>
                <p class="Shops__list__test">京都府/脱毛</p>
                <p class="Shops__list__review"><span><span>★★★★</span>★</span>4.6</p>
            </li>

            <li class="Shops__list__li"></li>
        </ul>
    </section>

    <section class="Characteristic Section">
        <h2 class="Title Characteristic__title"><!-- <i class="fas fa-search"></i> --><span class="Title__text Characteristic__title__text">Purilの3つの特徴</span></h2>
        <ul class="Characteristic__list">
            <li class="Characteristic__list__box">
                <h3 class="Characteristic__list__title">サロンもクリニックも掲載</h3>
                <img class="Characteristic__list__icon" src="/puril/images/characteristic-icon01.png" alt="サロンもクリニックも掲載">
                <p>美容サロンだけではなく、クリニックも掲載しているのはPurilだけ！日本唯一の、美容総合ポータルを目指しています。</p>
            </li>
            <li class="Characteristic__list__box">
                <h3 class="Characteristic__list__title">ステマは一切おことわり</h3>
                <img class="Characteristic__list__icon" src="/puril/images/characteristic-icon02.png" alt="ステマは一切おことわり">
                <p>ユーザー様からのリアルな口コミだけを使って情報をご提供！ステマを一切排除することをお約束します。</p>
            </li>
            <li class="Characteristic__list__box">
                <h3 class="Characteristic__list__title">超充実の口コミ内容</h3>
                <img class="Characteristic__list__icon" src="/puril/images/characteristic-icon03.png" alt="超充実の口コミ内容">
                <p>口コミの質には徹底的なこだわりアリ！店舗探しで本当に役に立つ情報を提供してまいります。</p>
            </li>
        </ul>
    </section>

    <img class="Campaign__bnr" src="/puril/images/campaign_bnr.png" alt="キャッシュバックキャンペーン">




    <!-- <section class="Parts">
        <h2 class="Title Parts__title"><i class="fas fa-search"></i><span class="Title__text Parts__title__text">部位から探す</span></h2>
        <div class="Parts__nav">
            <div class="Parts__nav__btn on" id="datsumou_parts">
                脱毛
            </div>
            <div class="Parts__nav__btn" id="relax_parts">
                リラク(準備中)
            </div>
            <div class="Parts__nav__btn" id="soushin_parts">
                痩身(準備中)
            </div>
        </div>
        <?php
            // echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true, 'id'=> 'form02', 'class'=> 'Parts__box']);
            ?>
			<ul class="prt cf">
							<?php
							// $this->ExForm->depilationSiteCnt('Make.depilation_site_id.', null, true, $searchWheres);
							?>
			</ul>
			<div class="Parts__box__submit">
			<button type="submit" name="search" class="Parts__box__submit__btn">
                <i class="fas fa-search"></i><span class="Parts__box__submit__btn__text">この条件で検索</span>
            </button>
			</div>
			<?php
	        // echo $this->ExForm->end();
            ?>
    </section> -->
</div>
<footer class="Footer">
    <div class="Footer__inner">
        <a href="<?php echo Router::url('/')?>" class="Footer__logo">
            <img src="/puril/images/header_logo.png" alt="Puril" class="Footer__logo__img">
        </a>
        <ul class="Footer__category Footer__category--type">
            <li class="Footer__category__li nolink">
                <a href="<?php echo Router::url('/datsumou/')?>" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>脱毛</a>
            </li>
            <li class="Footer__category__li nolink">
                <a href="" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>リラク</a>
            </li>
            <li class="Footer__category__li nolink">
                <a href="" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>痩身</a>
            </li>
            <li class="Footer__category__li nolink">
                <a href="" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>フェイシャル</a>
            </li>
        </ul>

        <ul class="Footer__category">
            <li class="Footer__category__li">
            	<a href="https://tsuru-tsuru.co.jp/" target="_blank" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>運営企業</a>
            </li>
            <li class="Footer__category__li">
                <a href="<?php echo Router::url(['controller'=> 'indexes', 'action'=> 'terms'])?>" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>利用規約</a>
            </li>
            <li class="Footer__category__li">
                <a href="<?php echo Router::url(['controller'=> 'indexes', 'action'=> 'privacyPolicy'])?>" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>プライバシーポリシー</a>
            </li>
            <li class="Footer__category__li">
                <a href="<?php echo Router::url(['controller'=> 'indexes', 'action'=> 'siteMap'])?>" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>サイトマップ</a>
            </li>
        </ul>
        <ul class="Footer__category">
            <li class="Footer__category__li">
                <a href="https://puril.net/campaign/" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>口コミキャッシュバック</a>
            </li>
            <li class="Footer__category__li">
                <a href="<?php echo Router::url(['controller'=> 'contacts', 'action'=> 'contact_user'])?>" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>ユーザーレビューのお問い合わせ</a>
            </li>
            <li class="Footer__category__li last">
                <a href="<?php echo Router::url(['controller'=> 'contacts', 'action'=> 'contact'])?>" class="Footer__category__li__link"><i class="fas fa-angle-right"></i>施設情報掲載のお問い合わせ</a>
            </li>
        </ul>
    </div>
    <div class="Footer__credit">
        Copyright © ツルツル株式会社 All rights reserved.
    </div>
</footer>

</body>
