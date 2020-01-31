<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
?>

<?php
/**
echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true]);

echo $this->ExForm->text('Make.free_word');

echo $this->ExForm->button('検索', array('name'=> 'free_word_search', 'class'=> '', 'type'=> 'submit'));
echo $this->ExForm->end();

echo "<hr>";

foreach ($prefDatas as $pref) {
// 	echo $pref['pref']. "<br>";
// 	$url =  Router::url('/'.URLUtil::SEARCH."/".$pref['url_text'], true);
// 	echo $this->Html->link($pref['pref'], $url). "<br>";

echo $this->Html->link($pref['pref'], ['controller'=> 'searchs', 'action'=> 'search', $pref['url_text']]). "<br>";
}
 */
?>
<body class="Puril">
<?php
echo $this->Html->css('datsumou');
?>
<header class="datsumou-header">
    <div class="datsumou-header-inner">
        <img class="datsumou-header-inner__img" src="/puril/images/header-logo-sp.png" srcset="/puril/images/header-logo-sp.png 1x, /puril/images/header-logo-sp@2x.png 2x" alt="puril">
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
    </div>
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
    </div>
</header>
<main class="datsumou-main">
    <div class="datsumou-search">
        <div class="Search__input">
            <div class="Search__input__inner">
                <div class="input1"><input type="" name="" placeholder="エリア、駅"></div>
                <div class="input2"><input type="" name="" placeholder="サロン・クリニック名"></div>
                <button class="search"><img src="/puril/images/ico_search_wht.png" alt="絞込み"></button>
            </div>
        </div>
        <div class="datsumou-search__inner">
            <h2 class="datsumou-search__title">サロン・クリニックを探す</h2>
            <ul class="datsumou-searcharea__list">
                <li>
                    <a href="">
                        <img src="/puril/images/datsumou-search-ico01-sp.png" alt="脱毛">
                        <p><span>エリア・駅</span>から探す</p>
                    </a>
                </li>
                <li>
                    <a href="">
                        <img src="/puril/images/datsumou-search-ico02-sp.png" alt="リラク">
                        <p><span>現在地</span>から探す</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="datsumou-search__list">
        <div class="datsumou-area__inner">
            <ul class="datsumou-area__list">
                <li>
                    <a href=""><img src="/puril/images/datsumou-area-ico01-sp.png" alt="">地域<span class="small">から探す</span></a>
                </li>
                <li>
                    <a href="">脱毛部位<span class="small">から探す</span></a>
                </li>
                <li>
                    <a href="">脱毛サロン・クリニック一覧<span class="small">から探す</span></a>
                </li>
                <li>
                    <a href=""><img src="/puril/images/datsumou-area-ico02-sp.png" alt="">こだわり条件<span class="small">から探す</span></a>
                </li>
            </ul>
        </div>
    </div>

    <div class="datsumou-ranking">
        <div class="datsumou-ranking__inner">
            <h2 class="datsumou-ranking__title"><p>脱毛ランキングから探す</p></h2>
            <div class="datsumou-ranking__tab">
                <input id="tab01-01" type="radio" name="tab_btn01" checked>
                <input id="tab01-02" type="radio" name="tab_btn01">

                <div class="datsumou-ranking__tab-search__list">
                    <label class="tab01-01_label" for="tab01-01">脱毛サロン</label>
                    <label class="tab01-02_label" for="tab01-02">医療脱毛クリニック</label>
                </div>
                <div class="datsumou-ranking-panel">
                    <div id="panel01" class="datsumou-ranking-panel-inner panel01">
                        <ul class="datsumou-ranking-panel__list">
<!--                            --><?php
//                            foreach ($rank_brand_salon as $salon) {
//                                if (!empty($salon['ShopImg']['shop_image_id'])) {
//                                    $imgUrl = Router::url(['controller' => 'images', 'action' => 'shopImage', $salon['ShopImg']['shop_image_id']]);
//                                } else {
//                                    $imgUrl = "img/image_empty.jpg";
//                                }
//                                $shopUrl = "";
//                                $blank = "";
//                                if (!empty($salon['Shop']['affiliate_page_url'])) {
//                                    $shopUrl = $salon['Shop']['affiliate_page_url'];
//                                    $blank = "target='blank'";
//                                } else {
//                                    $shopUrl = Router::url(['controller'=> 'shops', 'action'=> 'detail', $salon['Shop']['shop_id']]). "/";
//                                }
//                                ?>
<!--                                <li>-->
<!--                                    <a href="--><?php //echo $shopUrl;?><!--">-->
<!--                                    <p class="datsumou-ranking-panel__evaluation first">--><?//=number_format($salon['star'],2)?><!--</p>-->
<!--                                    <img src="--><?php //echo $imgUrl;?><!--" alt="">-->
<!--                                    <p class="datsumou-ranking-panel__text">--><?//= $salon['name'];?><!--</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                            --><?php
//                            }
//                            ?>
                            <li>
                                <p class="datsumou-ranking-panel__evaluation first">4.25</p>
                                <img src="/puril/images/ranking-panel01-01-sp.png" alt="">
                                <p class="datsumou-ranking-panel__text">キレイモ</p>
                            </li>
                            <li>
                                <p class="datsumou-ranking-panel__evaluation second">3.96</p>
                                <img src="/puril/images/ranking-panel01-02-sp.png" alt="">
                                <p class="datsumou-ranking-panel__text">ミュゼプラチナム</p>
                            </li>
                            <li>
                                <p class="datsumou-ranking-panel__evaluation third">3.91</p>
                                <img src="/puril/images/ranking-panel01-03-sp.png" alt="">
                                <p class="datsumou-ranking-panel__text">STLASSH</p>
                            </li>
                        </ul>
                        <a href="" class="datsumou-ranking__btn">ランキングを見る</a>
                    </div>
                    <div id="panel02" class="datsumou-ranking-panel-inner panel02">
                        <ul class="datsumou-ranking-panel__list">
<!--                            --><?php
//                            foreach ($rank_brand_clinic as $salon) {
//                                if (!empty($salon['ShopImg']['shop_image_id'])) {
//                                    $imgUrl = Router::url(['controller' => 'images', 'action' => 'shopImage', $salon['ShopImg']['shop_image_id']]);
//                                } else {
//                                    $imgUrl = "img/image_empty.jpg";
//                                }
//                                $shopUrl = "";
//                                $blank = "";
//                                if (!empty($salon['Shop']['affiliate_page_url'])) {
//                                    $shopUrl = $salon['Shop']['affiliate_page_url'];
//                                    $blank = "target='blank'";
//                                } else {
//                                    $shopUrl = Router::url(['controller'=> 'shops', 'action'=> 'detail', $salon['Shop']['shop_id']]). "/";
//                                }
//                                ?>
<!--                                <li>-->
<!--                                    <a href="--><?php //echo $shopUrl;?><!--">-->
<!--                                        <p class="datsumou-ranking-panel__evaluation first">--><?//=number_format($salon['star'],2)?><!--</p>-->
<!--                                        <img src="--><?php //echo $imgUrl;?><!--" alt="">-->
<!--                                        <p class="datsumou-ranking-panel__text">--><?//= $salon['name'];?><!--</p>-->
<!--                                    </a>-->
<!--                                </li>-->
<!--                                --><?php
//                            }
//                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="datsumou-evaluation">
        <div class="datsumou-evaluation__inner">
            <h2 class="datsumou-evaluation__title"><p>新着口コミから探す</p></h2>
            <div class="datsumou-evaluation__tab">
                <div class="datsumou-evaluation-panel">
                    <div id="panel01" class="datsumou-evaluation-panel-inner panel01">
                        <ul class="datsumou-evaluation-panel__list">
                            <?php
                            foreach ($salons as $salon) {
                                if (!empty($salon['ShopImg']['shop_image_id'])) {
                                    $imgUrl = Router::url(['controller'=> 'images', 'action'=> 'shopImage', $salon['ShopImg']['shop_image_id']]);
                                } else {
                                    $imgUrl = "img/image_empty.jpg";
                                }

                                $shopUrl = "";
                                $blank = "";
                                if (!empty($salon['Shop']['affiliate_page_url'])) {
                                    $shopUrl = $salon['Shop']['affiliate_page_url'];
                                    $blank = "target='blank'";
                                } else {
                                    $shopUrl = Router::url(['controller'=> 'shops', 'action'=> 'detail', $salon['Shop']['shop_id']]). "/";
                                }
                                ?>
                                <li>
                                    <a href="<?=$shopUrl?>" <?=$blank?> onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                        <img src="<?php echo $imgUrl?> alt="">
                                        <div class="datsumou-evaluation-panel__text">
                                            <h3 class="datsumou-evaluation-panel__title"><?php echo $salon['Shop']['name']?></h3>
                                            <p class="datsumou-evaluation-panel__thin"><?php echo $salon['content']?></p>
                                            <p class="datsumou-evaluation-panel__star">
                                      <span class="orange">
                                          <?php
                                          $reviewCount = 0;
                                          while($reviewCount < $salon['evaluation']):
                                              echo '★';
                                              $reviewCount++;
                                          endwhile;
                                          ?>
                                      </span>
                                                <?php
                                                while(5 - $reviewCount > 0):
                                                    echo '★';
                                                    $reviewCount++;
                                                endwhile;
                                                ?>
                                                <span class="red"><?php echo number_format($salon['evaluation'], 2) ?>
                                      </span>
                                                <span class="date"><?php echo !empty($salon['post_date']) ? date('Y.m.d', strtotime($salon['post_date'])) : "";?></span>
                                            </p>
                                        </div>
                                    </a>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="datsumou-characteristic">
        <h2 class="datsumou-characteristic__title"><p>Purilの3つの特徴</p></h2>
        <ul class="datsumou-characteristic-inner">
            <li>
                <h3 class="datsumou-characteristic-inner__title">サロンもクリニックも掲載</h3>
                <img src="/puril/images/characteristic-ico01-sp.png" alt="">
                <p class="datsumou-characteristic-inner__text">
                    美容サロンだけではなく、クリニックも掲載しているのはPurilだけ！日本唯一の、美容総合ポータルを目指しています。
                </p>
            </li>
            <li>
                <h3 class="datsumou-characteristic-inner__title">ステマは一切おことわり</h3>
                <img src="/puril/images/characteristic-ico02-sp.jpg" alt="">
                <p class="datsumou-characteristic-inner__text">
                    ユーザー様からのリアルな口コミだけを使って情報をご提供！ステマを一切排除することをお約束します。
                </p>
            </li>
            <li>
                <h3 class="datsumou-characteristic-inner__title">超充実の口コミ内容</h3>
                <img src="/puril/images/characteristic-ico03-sp.jpg" alt="">
                <p class="datsumou-characteristic-inner__text">
                    口コミの質には徹底的なこだわりアリ！店舗探しで本当に役に立つ情報を提供してまいります。
                </p>
            </li>
        </ul>
    </div>
    </div>
</main>

<footer class="datsumou-footer">
    <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">

    <div class="Search__breadcrumbs">
        <ol itemscope="" itemtype="http://schema.org/BreadcrumbList">
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <a itemscope="" itemtype="http://schema.org/Thing" itemprop="item" href="<?=Router::url('/')?>"><span itemprop="name" class="home"><i class="fas fa-home"></i></span></a>
                <meta itemprop="position" content="1">
            </li>
            <li itemprop="itemListElement" itemscope="" itemtype="http://schema.org/ListItem">
                <span itemprop="name">脱毛</span>
                <meta itemprop="position" content="2">
            </li>
        </ol>
    </div>
    <div class="datsumou-footer__inner">
        <ul class="datsumou-footer__category01">
            <li class="datsumou-footer__category__li nolink">
                <a href="/datsumou/" class="datsumou-footer__category__li__link">脱毛</a>
            </li>
            <li class="datsumou-footer__category__li nolink">
                <a href="" class="datsumou-footer__category__li__link">リラク</a>
            </li>
            <li class="datsumou-footer__category__li nolink">
                <a href="" class="datsumou-footer__category__li__link">痩身</a>
            </li>
            <li class="datsumou-footer__category__li nolink">
                <a href="" class="datsumou-footer__category__li__link">フェイシャル</a>
            </li>
        </ul>

        <ul class="datsumou-footer__category02">
            <li class="datsumou-footer__category__li">
                <a href="https://tsuru-tsuru.co.jp/" target="_blank" class="datsumou-footer__category__li__link">運営企業</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/regulation" class="datsumou-footer__category__li__link">利用規約</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/privacy-policy" class="datsumou-footer__category__li__link">プライバシーポリシー</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/sitemap" class="datsumou-footer__category__li__link">サイトマップ</a>
            </li>
        </ul>
        <ul class="datsumou-footer__category03">
            <li class="datsumou-footer__category__li">
                <a href="https://puril.net/campaign/" class="datsumou-footer__category__li__link">口コミキャッシュバック</a>
            </li>
            <li class="datsumou-footer__category__li">
                <a href="/form_user" class="datsumou-footer__category__li__link">ユーザーレビューのお問い合わせ</a>
            </li>
            <li class="datsumou-footer__category__li last">
                <a href="/form_facility" class="datsumou-footer__category__li__link">施設情報掲載のお問い合わせ</a>
            </li>
        </ul>
    </div>
    <div class="datsumou-footer__credit">
        <img src="/puril/images/footer-logo-sp.png" alt="">
        <p>Copyright © ツルツル株式会社 All rights reserved.</p>
    </div>
</footer>

</body>