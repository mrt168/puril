<?php
use App\Vendor\Code\Pref;
use App\Vendor\Code\CodePattern;
use Cake\Routing\Router;
?>
<body class="Puril">
<header class="home-header">
    <h1 class="home-header-inner">
        <a href="/">
            <img class="home-header-inner__img" src="puril/images/header-logo-sp.png" srcset="puril/images/header-logo-sp.png 1x, puril/images/header-logo-sp@2x.png 2x" alt="Puril - ランキングと口コミで探せる美容の検索予約サイト">
        </a>
    </h1>
    <div class="home-header-mv">
        <div class="home-header-mv-inner">
            <div class="home-header-mv-inner__title"><img class="home-header-inner__img" src="puril/images/header-mv-title-sp.png" alt="みんなの美容口コミサイト"></div>
            <div class="home-header-mv-inner__text">
                <div class="home-header-mv-inner__text--large">
                    <p>掲載件数</p>
                    <p class="home-header-mv-inner__text--large-orange"><?php echo $shopCnt;?>件</p>
                    <p class="home-header-mv-inner__text--large-right">以上！</p>
                </div>
                <div class="home-header-mv-inner__text--middle">
                    <p class="home-header-mv-inner__text--middle-center">さらに…</p>
                    <p>Purilからの予約で</p>
                    <p><span class="home-header-mv-inner__text--middle-blue-large">5,000</span><span class="home-header-mv-inner__text--middle-blue-middle">円</span>の</p>
                    <p>キャッシュバックも！</p>
                </div>
            </div>
        </div>
    </div>
</header>
<main class="home-main">

    <div class="home-search">
        <a href="<?php echo Router::url('/datsumou/search')?>" class="home-search__btn">店舗を探す</a>
    </div>

    <div class="home-genre">
        <div class="home-genre__inner">
            <h2 class="home-genre__title">ジャンルから探す</h2>
            <ul class="home-genre__list">
                <li>
                    <a href="<?php echo Router::url('/datsumou/')?>"">
                    <img src="puril/images/genre01-sp.png" alt="脱毛">
                    <p>脱毛</p>
                    </a>
                </li>
                <li>
                    <a href="" class="no-link">
                        <img src="puril/images/genre02-sp.png" alt="リラク">
                        <p>リラク</p>
                    </a>
                </li>
                <li>
                    <a href="" class="no-link">
                        <img src="puril/images/genre03-sp.png" alt="フェイシャル">
                        <p>フェイシャル</p>
                    </a>
                </li>
                <li>
                    <a href="" class="no-link">
                        <img src="puril/images/genre04-sp.png" alt="痩身">
                        <p>痩身</p>
                    </a>
                </li>
            </ul>
        </div>
    </div>

    <div class="home-area">
        <div class="home-area__inner">
            <h2 class="home-area__title"><img src="puril/images/area-title-ico-sp.png" alt=""><span>地域<span class="small">から探す</span></span></h2>
            <ul class="home-area__list">
                <li>
                    <p><a href="<?php echo Router::url('/datsumou/')?>">脱毛</a></p>
                </li>
                <li>
                    <p><a href="" class="no-link">リラク</a></p>
                </li>
                <li>
                    <p><a href="" class="no-link">フェイシャル</a></p>
                </li>
                <li>
                    <p><a href="" class="no-link">痩身</a></p>
                </li>
            </ul>
        </div>
    </div>

    <div class="home-ranking">
        <div class="home-ranking__inner">
            <h2 class="home-ranking__title">ランキングから探す</h2>
            <div class="home-ranking__tab">
                <input id="tab01-01" type="radio" name="tab_btn01" checked>
                <input id="tab01-02" type="radio" name="tab_btn01">
                <input id="tab01-03" type="radio" name="tab_btn01">
                <input id="tab01-04" type="radio" name="tab_btn01">

                <div class="home-ranking__tab-area">
                    <label class="tab01-01_label" for="tab01-01">脱毛</label>
                    <label class="tab01-02_label no-link" for="tab01-02">リラク</label>
                    <label class="tab01-03_label no-link" for="tab01-03">フェイシャル</label>
                    <label class="tab01-04_label no-link" for="tab01-04">痩身</label>
                </div>
                <div class="home-ranking-panel">
                    <div id="panel01" class="home-ranking-panel-inner panel01">
                        <ul class="home-ranking-panel__list">
                            <?php
                            $osusumes = [
                                '恋肌'=> [
                                    'url'=> 'https://t.afi-b.com/visit.php?guid=ON&a=a6684E-M243966D&p=j648053O',
                                    'img'=> '/img/Top/koihada_top.jpg',
                                    'star' => '4.87',
                                ],
                                'ストラッシュ'=> [
                                    'url'=> 'https://track.affiliate-b.com/visit.php?guid=ON&a=47719r-V298788m&p=j648053O',
                                    'img'=> '/img/stlassh.jpg',
                                    'star' => '4.82',
                                ],
                                'ラココ'=> [
                                    'url'=> 'https://www.tcs-asp.net/alink?AC=C102738&LC=MBTY1&SQ=0&isq=100',
                                    'img'=> '/shop_img/466',
                                    'star' => '4.71',
                                ],
                            ];

                            $count = 0;
                            foreach ($osusumes as $name => $osusume) {
                                $countCss = '';
                                switch ($count):
                                    case 0:
                                        $countCss = 'first';
                                        break;
                                    case 1:
                                        $countCss = 'second';
                                        break;
                                    case 2:
                                        $countCss = 'third';
                                        break;
                                endswitch;
                                ?>
                                <li>
                                    <a href="<?=$osusume['url']?>">
                                        <p class="home-ranking-panel__evaluation <?php echo $countCss;?>"><?=number_format($osusume['star'],2)?></p>
                                        <?php echo $this->Html->image($osusume['img'], ['alt'=> ''])?>
                                        <p class="home-ranking-panel__text"><?=$name?></p>
                                    </a>
                                </li>
                                <?php
                                $count++;
                            }
                            ?>
                        </ul>
                        <a href="<?php echo Router::url('/datsumou/ranking')?>" class="home-ranking__btn">ランキングを見る</a>
                    </div>
                    <div id="panel02" class="home-ranking-panel-inner panel02">
                        <p>リラク</p>
                    </div>
                    <div id="panel03" class="home-ranking-panel-inner panel03">
                        <p>フェイシャル</p>
                    </div>
                    <div id="panel04" class="home-ranking-panel-inner panel04">
                        <p>痩身</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <a href="https://puril.net/campaign/">
        <img class="home-bnr" src="puril/images/cash-back-bnr-sp.png" alt="">
    </a>
    <div class="home-evaluation">
        <div class="home-evaluation__inner">
            <h2 class="home-evaluation__title">新着口コミから探す</h2>
            <div class="home-evaluation__tab">
                <input id="tab02-01" type="radio" name="tab_btn02" checked>
                <input id="tab02-02" type="radio" name="tab_btn02">
                <input id="tab02-03" type="radio" name="tab_btn02">
                <input id="tab02-04" type="radio" name="tab_btn02">

                <div class="home-evaluation__tab-area">
                    <label class="tab02-01_label" for="tab02-01">脱毛</label>
                    <label class="tab02-02_label no-link" for="tab02-02">リラク</label>
                    <label class="tab02-03_label no-link" for="tab02-03">フェイシャル</label>
                    <label class="tab02-04_label no-link" for="tab02-04">痩身</label>
                </div>
                <div class="home-evaluation-panel">
                    <div id="panel01" class="home-evaluation-panel-inner panel01">
                        <ul class="home-evaluation-panel__list">
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
                                    <div class="voice-box">
                                        <a class="home-evaluation-panel__list__img" href="<?=$shopUrl?>" <?=$blank?> onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">
                                            <img src="<?php echo $imgUrl?> alt="">
                                        </a>
                                        <a href="<?php echo Router::url(['controller' => 'datsumou/shop', 'detail', $salon['Shop']['shop_id']], true);?>" class="home-evaluation-panel__text">
                                            <h3 class="home-evaluation-panel__title"><?php echo $salon['Shop']['name']?></h3>
                                            <p class="home-evaluation-panel__thin"><?php
                                                if(empty($salon['question1_evaluation'])) {

                                                } else if( mb_strlen($salon['question1_evaluation']) > 30) {
                                                    echo mb_substr($salon['question1_evaluation'],0,30).'...';
                                                } else {
                                                    echo $salon['question1_evaluation'];
                                                }
                                                ?></p>
                                            <p class="home-evaluation-panel__star">
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
                                        </a>
                                    </div>
                                </li>
                                <?php
                            }
                            ?>
                        </ul>
                    </div>
                    <div id="panel02" class="home-evaluation-panel-inner panel02">
                        <p>リラク</p>
                    </div>
                    <div id="panel03" class="home-evaluation-panel-inner panel03">
                        <p>フェイシャル</p>
                    </div>
                    <div id="panel04" class="home-evaluation-panel-inner panel04">
                        <p>痩身</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="home-characteristic">
        <h2 class="home-characteristic__title">Purilの3つの特徴</h2>
        <ul class="home-characteristic-inner">
            <li>
                <h3 class="home-characteristic-inner__title">サロンもクリニックも掲載</h3>
                <img src="puril/images/characteristic-ico01-sp.png" alt="">
                <p class="home-characteristic-inner__text">
                    美容サロンだけではなく、クリニックも掲載しているのはPurilだけ！日本唯一の、美容総合ポータルを目指しています。
                </p>
            </li>
            <li>
                <h3 class="home-characteristic-inner__title">ステマは一切おことわり</h3>
                <img src="puril/images/characteristic-ico02-sp.jpg" alt="">
                <p class="home-characteristic-inner__text">
                    ユーザー様からのリアルな口コミだけを使って情報をご提供！ステマを一切排除することをお約束します。
                </p>
            </li>
            <li>
                <h3 class="home-characteristic-inner__title">超充実の口コミ内容</h3>
                <img src="puril/images/characteristic-ico03-sp.jpg" alt="">
                <p class="home-characteristic-inner__text">
                    口コミの質には徹底的なこだわりアリ！店舗探しで本当に役に立つ情報を提供してまいります。
                </p>
            </li>
        </ul>
    </div>
</main>

<footer class="Footer">
    <a href="https://puril.net/campaign/">
        <img class="home-bnr" src="puril/images/cash-back-bnr-sp.png" alt="">
    </a>
    <div class="Footer__inner">
        <ul class="Footer__category01">
            <li class="Footer__category__li nolink">
                <a href="/datsumou/" class="Footer__category__li__link">脱毛</a>
            </li>
            <li class="Footer__category__li nolink">
                <a href="" class="Footer__category__li__link no-link">リラク</a>
            </li>
            <li class="Footer__category__li nolink">
                <a href="" class="Footer__category__li__link no-link">痩身</a>
            </li>
            <li class="Footer__category__li nolink">
                <a href="" class="Footer__category__li__link no-link">フェイシャル</a>
            </li>
        </ul>

        <ul class="Footer__category02">
            <li class="Footer__category__li">
                <a href="https://tsuru-tsuru.co.jp/" target="_blank" class="Footer__category__li__link">運営企業</a>
            </li>
            <li class="Footer__category__li">
                <a href="/regulation" class="Footer__category__li__link">利用規約</a>
            </li>
            <li class="Footer__category__li">
                <a href="/privacy-policy" class="Footer__category__li__link">プライバシーポリシー</a>
            </li>
            <li class="Footer__category__li">
                <a href="/sitemap" class="Footer__category__li__link">サイトマップ</a>
            </li>
        </ul>
        <ul class="Footer__category03">
            <li class="Footer__category__li">
                <a href="https://puril.net/campaign/" class="Footer__category__li__link">口コミキャッシュバック</a>
            </li>
            <li class="Footer__category__li">
                <a href="/form_user" class="Footer__category__li__link">ユーザーレビューのお問い合わせ</a>
            </li>
            <li class="Footer__category__li last">
                <a href="/form_facility" class="Footer__category__li__link">施設情報掲載のお問い合わせ</a>
            </li>
        </ul>
    </div>
    <div class="Footer__credit">
        <img src="puril/images/footer-logo-sp.png" alt="">
        <p>Copyright © ツルツル株式会社 All rights reserved.</p>
    </div>
</footer>
<?php
echo $this->element('Front/no_voice_modal') ?>
</body>
