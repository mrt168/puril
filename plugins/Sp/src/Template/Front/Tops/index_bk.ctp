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

<div id="pcmainkv" class="pc">
    <div class="kv">
        <div class="inner cf">
            <div class="left_box">
                <img class="left_box__title" src="/img/home/fv_title.png" alt="日本最大級のみんなの脱毛情報サイト">
                <img class="left_box__no1" src="/img/home/fv_no1.png" alt="日本最大級の脱毛施設掲載数！圧倒的な情報量と抜群の使いやすさ">
                <div class="kv__circles">
                    <img class="kv__circles__icon" src="/img/home/fv_01.png" alt="日本最大級のみんなの脱毛情報サイト">
                    <img class="kv__circles__icon" src="/img/home/fv_02.png" alt="日本最大級のみんなの脱毛情報サイト">
                    <img class="kv__circles__icon" src="/img/home/fv_03.png" alt="日本最大級のみんなの脱毛情報サイト">
                </div>
            </div>
            <div class="right_box">
                <div class="area_map">
                    <img src="https://puril.net/img/home/fv_map.png" alt="map" class="area_map_img">
                    <div class="area_map_tab">
                        <div class="area_map_tab_box" data-link="hokkaido">
                            北海道・東北
                        </div>
                        <div class="area_map_tab_box" data-link="hokushinetsu">
                            北陸・甲信越
                        </div>
                        <div class="area_map_tab_box" data-link="kanto">
                            関東
                        </div>
                        <div class="area_map_tab_box" data-link="chubu">
                            中部
                        </div>
                        <div class="area_map_tab_box" data-link="kansai">
                            関西
                        </div>
                        <div class="area_map_tab_box" data-link="shikoku">
                            四国
                        </div>
                        <div class="area_map_tab_box" data-link="chugoku">
                            中国
                        </div>
                        <div class="area_map_tab_box" data-link="kyusyu">
                            九州・沖縄
                        </div>
                    </div>
                    <div class="mapBox" id="hokkaidoMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">北海道・東北エリア</p>
                            <ul class="hokkaido cf">
                                <li><?php echo $this->Html->link(Pref::$HOKKAIDO[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$HOKKAIDO[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$AOMORI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$AOMORI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$IWATE[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$IWATE[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$AKITA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$AKITA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$MIYAGI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$MIYAGI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$YAMAGATA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$YAMAGATA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$FUKUSHIMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$FUKUSHIMA[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mapBox" id="kantoMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">関東エリア</p>
                            <ul class="kanto cf">
                                <li><?php echo $this->Html->link(Pref::$GUNMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$GUNMA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$TOTIGI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$TOTIGI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$SAITAMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$SAITAMA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$IBARAGI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$IBARAGI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$TOKYO[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$TOKYO[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$TIBA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$TIBA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$KANAGAWA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$KANAGAWA[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mapBox" id="hokushinetsuMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">中部エリア</p>
                            <ul class="hokushinetsu cf">
                                <li><?php echo $this->Html->link(Pref::$NIIGATA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$NIIGATA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$NAGANO[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$NAGANO[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$YAMANASHI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$YAMANASHI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$TOYAMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$TOYAMA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$ISHIKAWA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$ISHIKAWA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$FUKUI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$FUKUI[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mapBox" id="chubuMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">中部エリア</p>
                            <ul class="tokai cf">
                                <li><?php echo $this->Html->link(Pref::$AITI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$AITI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$SHIZUOKA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$SHIZUOKA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$MIE[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$MIE[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$GIFU[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$GIFU[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mapBox" id="kansaiMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">関西エリア</p>
                            <ul class="kansai cf">
                                <li><?php echo $this->Html->link(Pref::$SHIGA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$SHIGA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$KYOTO[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$KYOTO[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$OOSAKA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$OOSAKA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$HYOGO[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$HYOGO[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$NARA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$NARA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$WAKAYAMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$WAKAYAMA[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mapBox" id="chugokuMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">中国エリア</p>
                            <ul class="chugoku cf">
                                <li><?php echo $this->Html->link(Pref::$TOTTORI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$TOTTORI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$OKAYAMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$OKAYAMA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$SHIMANE[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$SHIMANE[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$HIROSHIMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$HIROSHIMA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$YAMAGUTI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$YAMAGUTI[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mapBox" id="shikokuMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">四国エリア</p>
                            <ul class="shikoku cf">
                                <li><?php echo $this->Html->link(Pref::$EHIME[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$EHIME[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$KAGAWA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$KAGAWA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$KOTI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$KOTI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$TOKUSHIMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$TOKUSHIMA[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                    <div class="mapBox" id="kyusyuMap">
                        <div class="mapBox__inner">
                            <p class="mapBox__title">九州・沖縄エリア</p>
                            <ul class="kyusyu cf">
                                <li><?php echo $this->Html->link(Pref::$NAGASAKI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$NAGASAKI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$FUKUOKA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$FUKUOKA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$SAGA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$SAGA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$OOITA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$OOITA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$KUMAMOTO[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$KUMAMOTO[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$MIYAZAKI[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$MIYAZAKI[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$KAGOSHIMA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$KAGOSHIMA[CodePattern::$CODE]]['url_text']]);?></li>
                                <li><?php echo $this->Html->link(Pref::$OKINAWA[CodePattern::$VALUE], ['controller'=> 'searchs', 'action'=> 'search', $prefs[Pref::$OKINAWA[CodePattern::$CODE]]['url_text']]);?></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="SearchBox">
        <div class="SearchBox__inner">
            <div class="SearchBox__inner__count">
                掲載店舗数<span class="SearchBox__inner__count__num"><?php echo number_format($shopCnt)?></span>件
            </div>
            <div class="SearchBox__inner__search">
                <?php
                echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true, 'id'=> 'form01', 'class'=> 'cf']);
                echo $this->ExForm->text('Make.free_word', ['id'=> 'input01', 'placeholder'=> '地名、サロン名、駅名などで検索']);
                echo $this->ExForm->input('', ['name'=> 'free_word_search', 'id'=> 'submit01', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
                echo $this->ExForm->end();
                ?>
            </div>
        </div>
        <dl class="keyword">
            <dt>人気のキーワード：</dt>
            <dd>
                <a href="<?php echo Router::url('/search/salon/')?>"><span>脱毛サロン</span></a>
                <a href="<?php echo Router::url('/search/clinic/')?>"><span>医療脱毛</span></a>
                <a href="<?php echo Router::url('/search/eikyu/')?>"><span>永久脱毛</span></a>
                <a href="<?php echo Router::url('/search/mens/')?>"><span>メンズ脱毛</span></a>
                <a href="<?php echo Router::url('/search/zenshin/')?>"><span>全身脱毛</span></a>
                <a href="<?php echo Router::url('/search/face/')?>"><span>顔脱毛</span></a>
                <a href="<?php echo Router::url('/search/underarm-hair/')?>"><span>脇脱毛</span></a>
                <a href="<?php echo Router::url('/search/violine/')?>"><span>VIO脱毛</span></a>
                <a href="<?php echo Router::url('/search/tokyo/')?>"><span>東京</span></a>
                <a href="<?php echo Router::url('/search/clinic/tokyo/city_291/sta_g_1130205/')?>"><span>渋谷</span></a>
                <a href="<?php echo Router::url('/search/clinic/tokyo/city_282/sta_g_1130208/')?>"><span>新宿</span></a>
                <a href="<?php echo Router::url('/search/salon/oosaka/city_649/sta_g_1160214/')?>"><span>大阪</span></a>
            </dd>
        </dl>
    </div>
    <div class="kv_btm">
        <div class="model_img"></div>
    </div>
</div><!--/#pcmainkv-->
<div id="spmainkv" class="sp">
    <?php
    echo $this->Html->image('/img/home/sp_kv01.jpg', ['alt'=> '日本最大級のみんなの脱毛情報サイト 100万人が選んだ 掲載数10,000件以上 安い 使いやすい カンタン・お得']);
    ?>
    <div id="pickupshop" class="sec sp">
        <div class="inner">
            <h2 class="maintit ribon ribon-pink"><span><span class="pink">Purilイチオシ！</span><br>今すぐ脱毛するなら</span></h2>
            <div class="shopcontent cf">
                <div class="item">
                    <a href="https://www.af-mark.jp/kireimo/?id=24771&uid=">
                        <div class="imgbox">
                            <?php echo $this->Html->image('https://puril.net/img/pickup_shop_kireimo.jpg', ['alt'=> 'キレイモ']);?>
                        </div>
                        <div class="shopname">キレイモ</div>
                    </a>
                </div>
                <div class="item">
                    <a href="https://t.afi-b.com/visit.php?guid=ON&a=a6684E-M243966D&p=j648053O">
                        <div class="imgbox">
                            <?php echo $this->Html->image('https://puril.net/img/pickup_shop_koihada.jpg', ['alt'=> '恋肌']);?>
                        </div>
                        <div class="shopname">恋肌</div>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="search_area">
        <div class="tit t1">都道府県から探す</div>
        <ul class="cf">
            <?php
            $i = 0;
            foreach ($regionPrefs as $region => $pref) {
                $i++;
                ?>
                <li>
                    <a href="#content0<?php echo $i?>" id="search0<?php echo $i?>"><?php echo $region?></a>
                    <div id="content0<?php echo $i?>" class="cont">
                        <span class="close-content0<?php echo $i?> closehead"><?php echo $this->Html->image('../img/btn_back.png', ['alt'=> 'もどる']);?></span>
                        <div class="modal-content">
                            <div class="cat_head"><?php echo $region?>エリア<span class="close-content0<?php echo $i?> close">×</span></div>
                            <ul class="list cf">
                                <?php
                                foreach ($pref as $prefCode => $value) {
                                    ?>
                                    <li>
                                        <?php
                                        echo $this->Html->link(Pref::convert($prefCode, CodePattern::$VALUE), ['controller'=> 'searchs', 'action'=> 'search', $value]);
                                        ?>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                    </div>
                </li>
                <?php
            }
            ?>
        </ul>
    </div>
    <div class="search_box">
        <div class="inner">
            <div class="tit">掲載店舗数<span class="num"><?php echo number_format($shopCnt)?></span>件</div>
            <?php
            echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post', 'novalidate' => true, 'id'=> 'form02', 'class'=> 'cf']);
            echo $this->ExForm->text('Make.free_word', ['id'=> 'input02', 'placeholder'=> '地名、サロン名、駅名などで検索']);
            echo $this->ExForm->input("", ['name'=> 'free_word_search', 'id'=> 'submit02', 'type'=> 'submit', 'templates'=> ['submitContainer'=> '{{content}}']]);
            echo $this->ExForm->end();
            ?>
            <dl class="keyword">
                <dt class="tit"><span class="pink">人気のキーワード：</span></dt>
                <dd class="cf">
                    <a href="<?php echo Router::url('/search/salon')?>"><span>脱毛サロン</span></a>
                    <a href="<?php echo Router::url('/search/medical')?>"><span>医療脱毛</span></a>
                    <a href="<?php echo Router::url('/search/eikyu')?>"><span>永久脱毛</span></a>
                    <a href="<?php echo Router::url('/search/mens')?>"><span>メンズ脱毛</span></a>
                    <a href="<?php echo Router::url('/search/zenshin')?>"><span>全身脱毛</span></a>
                    <a href="<?php echo Router::url('/search/face')?>"><span>顔脱毛</span></a>
                    <a href="<?php echo Router::url('/search/underarm-hair')?>"><span>脇脱毛</span></a>
                    <a href="<?php echo Router::url('/search/violine')?>"><span>VIO脱毛</span></a>
                    <a href="<?php echo Router::url('/search/tokyo')?>"><span>東京</span></a>
                <a href="<?php echo Router::url('/search/clinic/tokyo/city_291/sta_g_1130205/')?>"><span>渋谷</span></a>
                <a href="<?php echo Router::url('/search/clinic/tokyo/city_282/sta_g_1130208/')?>"><span>新宿</span></a>
                    <a href="<?php echo Router::url('/search/salon/oosaka/city_649/sta_g_1160214/')?>"><span>大阪</span></a>
                </dd>
            </dl>
        </div>
    </div>
</div><!--/#spmainkv-->
<section id="sec01" class="sec">
    <div class="inner">
        <h2 class="maintit">Puril<span class="pink">特選記事</span></h2>
        <p class="txt mgn">これさえ読めば、まず失敗することはない！！Purilの厳選特選記事です！</p>
        <div id="slider_wrap">
            <div id="slider" class="swiper-container cf">
                <div class="swiper-wrapper">
                    <article class="article swiper-slide swiper-slide-active">
                        <a href="/column/special/horiemon/">
                            <div class="img_box">
                                <div class="img" style="background-image: url(/img/Top/banner-0.jpg);"></div>
                            </div>
                            <div class="txt_box">
                                <div class="lead">メンズも脱毛するべき？！ホリエモン×慶應美女が対談！堀江貴文氏が脱毛した理由は〇〇だった！</div>
                                <!--								<p class="description">脱毛したいあなたへ！脱毛を知り尽くしたPurilが、今、本当におすすめの脱毛サロンやクリニックをご紹介します。選択肢が多すぎて決められないというあなたも、新しい脱毛サロンやクリニックを発見したいというあなたも、必見です！</p>-->
                            </div>
                        </a>
                    </article>
                    <article class="article swiper-slide">
                        <a href="/column/special/roland-interview/">
                            <div class="img_box"><div class="img" style="background-image: url(https://puril.net/column/wp-content/uploads/2019/07/WS000003.jpg);"></div></div>
                            <div class="txt_box">
                                <div class="lead">カリスマ・ローランドが脱毛サロンのプロデュースに込めた願い【男の美は女をも美しくする】</div>
                            </div>
                        </a>
                    </article>
                    <article class="article swiper-slide">
                        <a href="/column/special/higeshindan/">
                            <div class="img_box"><div class="img" style="background-image: url(https://puril.net/column/wp-content/uploads/2018/12/datsumoulove_bnr2x.jpg);"></div></div>
                            <div class="txt_box">
                                <div class="lead">あなたの好きな俳優・キャラクターをリクエスト！どの顔がタイプ？1分であなたの好みを診断【ヒゲ診断】</div>
                                <?php /*
								<p class="txt elps e2">うなじ脱毛の基本を凝縮しました！気になる費用や脱毛サロン・クリニックの選び方、メリットや注意点の全てが分かります。また、おすすめのサロンやクリニックもご紹介しますので、きれいなうなじづくりの参考にしてください！</p>
								*/ ?>
                            </div>
                        </a>
                    </article>
                    <article class="article swiper-slide swiper-slide-active">
                        <a href="/column/special/">
                            <div class="img_box"><div class="img" style="background-image: url(/img/Top/banner-1.jpg);"></div></div>
                            <div class="txt_box">
                                <div class="lead">【まとめ】脱毛したい人必見！脱毛サロン・医療脱毛クリニックのおすすめ人気ランキング15選</div>
                                <?php /*
								<p class="txt elps e2">脱毛したいあなたへ！脱毛を知り尽くしたPurilが、今、本当におすすめの脱毛サロンやクリニックをご紹介します。選択肢が多すぎて決められないというあなたも、新しい脱毛サロンやクリニックを発見したいというあなたも、必見です！</p>
								*/ ?>
                            </div>
                        </a>
                    </article>
                    <article class="article swiper-slide">
                        <a href="/column/special/eikyu-ranking/">
                            <div class="img_box"><div class="img" style="background-image: url(https://puril.net/column/wp-content/uploads/2019/01/ranking_1_3-1.jpg);background-position: left;"></div></div>
                            <div class="txt_box">
                                <div class="lead">【最新2019年】永久脱毛オススメ11選！サロンクリニックの口コミ人気ランキング！安い医療脱毛はどこ？</div>
                            </div>
                        </a>
                    </article>
                    <article class="article swiper-slide">
                        <a href="/column/special/total-body-ranking/">
                            <div class="img_box"><div class="img" style="background-image: url(https://puril.net/column/wp-content/uploads/2019/01/ranking_1_3-2.jpg);background-position: left;"></div></div>
                            <div class="txt_box">
                                <div class="lead">【最新2019年】全身脱毛オススメ15選！サロンクリニックの口コミ人気ランキング！安い医療脱毛はどこ？</div>
                            </div>
                        </a>
                    </article>
                    <article class="article swiper-slide">
                        <a href="/column/special/violine-ranking/">
                            <div class="img_box"><div class="img" style="background-image: url(https://puril.net/column/wp-content/uploads/2018/12/banner_22-1.jpg);background-position: left;"></div></div>
                            <div class="txt_box">
                                <div class="lead">【最新2019年】VIO脱毛オススメ15選！サロンクリニックの口コミ人気ランキング！予約が取れる安い医療脱毛はどこ？</div>
                            </div>
                        </a>
                    </article>
                </div>
            </div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    </div>
</section><!--/#sec01-->
<section id="sec02" class="sec">
    <div class="inner no-sp-padding">
        <h2 class="maintit pc"><span class="sub">脱毛サロンと医療脱毛クリニック、</span>Purilの<span class="pink">ランキング</span>を大発表！</h2>
        <h2 class="maintit sp v2">脱毛サロンと医療脱毛クリニック、<br>Purilの<span class="pink">ランキング</span>を大発表！</h2>
        <p class="txt mgn haspadding">脱毛を失敗したくないあなたへ！豊富な口コミから分かった、本当におすすめできる脱毛サロン・クリニック・脱毛器をご紹介♪</p>
        <ul class="tab cf">
            <li><h3><a href="#tab01"><span><img src="https://puril.net/img/home/icon_ranking.png" alt="">脱毛サロン</span></a></h3></li>
            <li><h3><a href="#tab02"><span><img src="https://puril.net/img/home/icon_ranking.png" alt="">医療脱毛</span></a></h3></li>
            <li><h3><a href="#tab03"><span><img src="https://puril.net/img/home/icon_ranking.png" alt="">脱毛器</span></a></h3></li>
        </ul>
        <div class="tab_wrap ranking">
            <div id="tab01" class="tab_box">
                <ul>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank1.png" alt=""></dt>
                            <dd class="logo"><a href="https://t.afi-b.com/visit.php?guid=ON&a=a6684E-M243966D&p=j648053O" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://puril.net/img/Top/koihada_top.jpg" alt=""></a></dd>
                            <dd class="right_box">
                                <p>料金が本当に安いと思うサロンNo1！「安くて早い」は、恋肌へ。</p>
                                <a href="https://t.afi-b.com/visit.php?guid=ON&a=a6684E-M243966D&p=j648053O" class="shop" onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">恋肌</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 97.4%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.87</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank2.png" alt=""></dt>
                            <dd class="logo"><a href="https://track.affiliate-b.com/visit.php?guid=ON&a=47719r-V298788m&p=j648053O"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://puril.net/img/Top/stlassh_top.png" alt=""></a></dd>
                            <dd class="right_box">
                                <p>医療者が選ぶサロンNo1！脱毛の新常識、最短6か月での全身脱毛が可能！</p>
                                <a href="https://track.affiliate-b.com/visit.php?guid=ON&a=47719r-V298788m&p=j648053O" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">ストラッシュ</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 96.4%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.82</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank3.png" alt=""></dt>
                            <dd class="logo"><a href="https://www.tcs-asp.net/alink?AC=C102738&LC=MBTY1&SQ=0&isq=100"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://puril.net/shop_img/466" alt=""></a></dd>
                            <dd class="right_box">
                                <p>メディア掲載多数！最短6ヵ月で卒業できる。早い・安い・無痛のサロン！</p>
                                <a href="https://www.tcs-asp.net/alink?AC=C102738&LC=MBTY1&SQ=0&isq=100" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">ラココ</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 94.2%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.71</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank4.png" alt=""></dt>
                            <dd class="logo"><a href="https://t.felmat.net/fmcl?ak=I184W.1.736814.P583942"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://puril.net/shop_img/636" alt=""></a></dd>
                            <dd class="right_box">
                                <p>全身45分の超高速脱毛！さらに納得の低価格で永久メンテナンス保証つき♪</p>
                                <a href="https://t.felmat.net/fmcl?ak=I184W.1.736814.P583942" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">シースリー</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 93.4%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.62</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank5.png" alt=""></dt>
                            <dd class="logo"><a href="https://t.afi-b.com/visit.php?guid=ON&a=M55347-T305688d&p=j648053O"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://puril.net/img/Top/musee_top.jpg" alt=""></a></dd>
                            <dd class="right_box">
                                <p>サロン店舗数No1！約5割が口コミで来店する圧倒的満足度の秘訣とは！？</p>
                                <a href="https://t.afi-b.com/visit.php?guid=ON&a=M55347-T305688d&p=j648053O" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">ミュゼ</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 93.4%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.62</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
                <div class="toptabbtnarea">
                    <div class="txt pc">人気の脱毛サロンは、まだまだたくさんあります！6位以下のサロンはこちらからチェック☆</div>
                    <div class="btnbox">
                        <a href="https://puril.net/column/salon/" class="btn">ランキングをもっと見る！</a>
                    </div>
                </div>
            </div>
            <div id="tab02" class="tab_box">
                <ul>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank1.png" alt=""></dt>
                            <dd class="logo"><a href="https://t.afi-b.com/visit.php?guid=ON&a=B8551a-G303613s&p=j648053O"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www.afi-b.com/upload_image/8551-1511707642-3.png" alt=""></a></dd>
                            <dd class="right_box">
                                <p>顔・VIOを除く全身脱毛が安い！料金を抑えるならレジーナクリニック！</p>
                                <a href="https://t.afi-b.com/visit.php?guid=ON&a=B8551a-G303613s&p=j648053O" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">レジーナクリニック</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 99.6%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.89</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank2.png" alt=""></dt>
                            <dd class="logo"><a href="https://t.afi-b.com/visit.php?guid=ON&a=x10802l-5364750L&p=j648053O"  rel="nofollow"><img src="https://www.afi-b.com/upload_image/10802-1553274671-3.jpg" width="650" height="250" style="border:none;" alt="HMRクリニック" /></a></dd>
                            <dd class="right_box">
                                <p>【安すぎ早すぎ医療脱毛】49箇所5回コースが159,000円！しかも、最短5カ月で完了！？</p>
                                <a href="https://t.afi-b.com/visit.php?guid=ON&a=x10802l-5364750L&p=j648053O" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">HMRクリニック</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 94.8%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.74</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank3.png" alt=""></dt>
                            <dd class="logo"><a href="https://track.affiliate-b.com/visit.php?guid=ON&a=O5974K-t195506G&p=j648053O"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www.affiliate-b.com/upload_image/5974-1379886349-3.gif" alt=""></a></dd>
                            <dd class="right_box">
                                <p>肌トラブルがあっても完全無償で治療！安心・安全な脱毛なら、美容皮膚科のリゼ。</p>
                                <a href="https://track.affiliate-b.com/visit.php?guid=ON&a=O5974K-t195506G&p=j648053O" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">リゼクリニック</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 93.2%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.66</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank4.png" alt=""></dt>
                            <dd class="logo"><a href="https://t.afi-b.com/visit.php?guid=ON&a=G10718g-2361913X&p=j648053O"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://puril.net/brand_img/78" alt=""></a></dd>
                            <dd class="right_box">
                                <p>月々5500円で医療脱毛！？安心の予約保証システムで誰でも計画通りに脱毛できます^^</p>
                                <a href="https://t.afi-b.com/visit.php?guid=ON&a=G10718g-2361913X&p=j648053O" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">フレイアクリニック</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 92.2%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.60</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank5.png" alt=""></dt>
                            <dd class="logo"><a href="https://t.afi-b.com/visit.php?guid=ON&a=J5530f-C177425s&p=j648053O"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://puril.net/brand_img/52" alt=""></a></dd>
                            <dd class="right_box">
                                <p>23時まで営業、駅チカ4分以内、1回1600円、こだわりの医療脱毛なら渋谷クリへ！</p>
                                <a href="https://t.afi-b.com/visit.php?guid=ON&a=J5530f-C177425s&p=j648053O" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">渋谷美容外科クリニック</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 91.2%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.59</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
                <div class="toptabbtnarea">
                    <div class="txt pc">人気の医療脱毛クリニックは、まだまだたくさんあります！6位以下のクリニックはこちらからチェック☆</div>
                    <div class="btnbox">
                        <a href="https://puril.net/column/clinic/" class="btn">ランキングをもっと見る！</a>
                    </div>
                </div>
            </div>
            <div id="tab03" class="tab_box">
                <ul>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank1.png" alt=""></dt>
                            <dd class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www20.a8.net/svt/bgt?aid=180906754618&wid=001&eno=01&mid=s00000010841003009000&mc=1" alt=""></a></dd>
                            <dd class="right_box">
                                <p>脱毛器ランキング2342日連続1位！真似できない圧倒的実績がここに。</p>
                                <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">ケノン</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 96.4%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.82</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank2.png" alt=""></dt>
                            <dd class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8GTYIA+3RWS+5ZU29"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www28.a8.net/svt/bgt?aid=180906754512&wid=001&eno=01&mid=s00000017614001016000&mc=1" alt=""></a></dd>
                            <dd class="right_box">
                                <p>サロンクオリティのムダ毛ケアを実現！新感覚の光美容器。</p>
                                <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8GTYIA+3RWS+5ZU29" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">レイボーテグランデ</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 94%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.70</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank3.png" alt=""></dt>
                            <dd class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8HFE42+3W0K+5ZU29"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www29.a8.net/svt/bgt?aid=180906754513&wid=001&eno=01&mid=s00000018146001011000&mc=1" alt=""></a></dd>
                            <dd class="right_box">
                                <p>レーザーの専門家が開発！本格派の家庭用レーザー脱毛器【30日間返品保証】</p>
                                <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8HFE42+3W0K+5ZU29" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">トリアビューティー</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 92.2%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.61</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank4.png" alt=""></dt>
                            <dd class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8LLFCI+3UC0+60WN5"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www26.a8.net/svt/bgt?aid=180906754520&wid=001&eno=01&mid=s00000017928001007000&mc=1" alt=""></a></dd>
                            <dd class="right_box">
                                <p>満足度94%の家庭用IPL脱毛器。ハンディタイプで持ち運びも♪</p>
                                <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8LLFCI+3UC0+60WN5" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">リーオ</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 91%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.55</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="rank"><img src="https://puril.net/img/rank5.png" alt=""></dt>
                            <dd class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+805TKI+3HS2+1TK1F5"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www22.a8.net/svt/bgt?aid=180906754484&wid=001&eno=01&mid=s00000016301011011000&mc=1" alt=""></a></dd>
                            <dd class="right_box">
                                <p>英国ウェールズ生まれの家庭用光脱毛美容器【敏感肌・男性も使用可能】</p>
                                <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+805TKI+3HS2+1TK1F5" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">スムーズスキン（SMOOTHSKIN）</a>
                                <div class="star_box">
                                    <div class="star-rating-box">
                                        <div class="empty-star">★★★★★</div>
                                        <div class="filled-star" style=" width: 89.6%;">★★★★★</div>
                                    </div>
                                    <span class="points">4.48</span>
                                    <?php /**
                                    <a href="" class="reviews">（クチコミ<span>00</span>件）</a>]
                                     */?>
                                </div>
                            </dd>
                        </dl>
                    </li>
                </ul>
                <div class="toptabbtnarea">
                    <div class="txt pc">人気の脱毛器は、まだまだたくさんあります！6位以下の脱毛器はこちらからチェック☆</div>
                    <div class="btnbox">
                        <a href="https://puril.net/column/epilator/" class="btn">ランキングをもっと見る！</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section><!--/#sec02-->
<section id="sec03" class="sec">
    <div class="inner no-sp-padding">
        <h2 class="maintit"><span>Purilに寄せられた<span class="pink">新着口コミ！</span></span></h2>
        <p class="txt mgn haspadding">脱毛経験者のリアルな口コミをご紹介！スタッフの対応は？痛みや効果は？施術室はどんな感じ？気になるアレコレを要チェック！</p>
        <ul class="tab cf">
            <li><h3><a href="#tab04"><span><img src="https://puril.net/img/home/icon_comment.png" alt="">脱毛サロン</span></a></h3></li>
            <li><h3><a href="#tab05"><span><img src="https://puril.net/img/home/icon_comment.png" alt="">医療脱毛</span></a></h3></li>
            <li><h3><a href="#tab06"><span><img src="https://puril.net/img/home/icon_comment.png" alt="">脱毛器</span></a></h3></li>
        </ul>
        <div class="tab_wrap">
            <div id="tab04" class="tab_box">
                <ul>
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
                            $blank = "";
                        } else {
                            $shopUrl = Router::url(['controller'=> 'shops', 'action'=> 'detail', $salon['Shop']['shop_id']]). "/";
                        }
                        ?>
                        <li>
                            <dl class="cf">
                                <dt class="logo"><a href="<?=$shopUrl?>" <?=$blank?> onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="<?php echo $imgUrl?>" alt=""></a></dt>
                                <dd class="right_box">
                                    <div class="titlearea">
                                        <a href="<?=$shopUrl?>" <?=$blank?> class='shop' onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><?php echo $salon['Shop']['name']?></a>
                                        <div class="star_box">
                                            <div class="star-rating-box">
                                                <div class="empty-star">★★★★★</div>
                                                <div class="filled-star" style=" width: <?php echo $salon['evaluation'] * 20?>%;">★★★★★</div>
                                            </div>
                                            <span class="points"><?php echo number_format($salon['evaluation'], 2) ?></span>
                                        </div>
                                    </div>
                                    <p class="nol"><?php echo $salon['content']?></p>
                                    <span class="ymd"><?php echo !empty($salon['post_date']) ? date('Y.m.d', strtotime($salon['post_date'])) : "";?></span>
                                    <div class="ta_r"><?php echo $this->Html->link('詳細はこちら', ['controller'=> 'shop', 'detail', $salon['Shop']['shop_id']]);?></div>
                                    <div class="arw_btn sp">
                                        <?php
                                        echo $this->Html->link($this->Html->image('/img/sp_arw01.png'), ['controller'=> 'shop', 'detail', $salon['Shop']['shop_id']], ['escape'=> false]);
                                        ?>
                                    </div>
                                </dd>
                            </dl>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="tab05" class="tab_box">
                <ul>
                    <?php
                    foreach ($medicals as $medical) {
                        if (!empty($medical['ShopImg']['shop_image_id'])) {
                            $imgUrl = Router::url(['controller'=> 'images', 'action'=> 'shopImage', $medical['ShopImg']['shop_image_id']]);
                        } else {
                            $imgUrl = "img/image_empty.jpg";
                        }

                        $shopUrl = "";
                        $blank = "";
                        if (!empty($medical['Shop']['affiliate_page_url'])) {
                            $shopUrl = $medical['Shop']['affiliate_page_url'];
                            $blank = "";
                        } else {
                            $shopUrl = Router::url(['controller'=> 'shops', 'action'=> 'detail', $medical['Shop']['shop_id']]). "/";
                        }
                        ?>
                        <li>
                            <dl class="cf">
                                <dt class="logo"><a href="<?=$shopUrl?>" <?=$blank?> onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="<?php echo $imgUrl?>" alt=""></a></dt>
                                <dd class="right_box">
                                    <div class="titlearea">
                                        <a href="<?=$shopUrl?>" <?=$blank?> class='shop' onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><?php echo $medical['Shop']['name']?></a>
                                        <div class="star_box">
                                            <div class="star-rating-box">
                                                <div class="empty-star">★★★★★</div>
                                                <div class="filled-star" style=" width: <?php echo $medical['evaluation'] * 20?>%;">★★★★★</div>
                                            </div>
                                            <span class="points"><?php echo number_format($medical['evaluation'], 2) ?></span>
                                        </div>
                                    </div>
                                    <p class="nol"><?php echo $medical['content']?></p>
                                    <span class="ymd"><?php echo !empty($medical['post_date']) ? date('Y.m.d', strtotime($medical['post_date'])) : "";?></span>
                                    <div class="ta_r"><?php echo $this->Html->link('詳細はこちら', ['controller'=> 'shop', 'detail', $medical['Shop']['shop_id']]);?></div>
                                    <div class="arw_btn sp">
                                        <?php
                                        echo $this->Html->link($this->Html->image('/img/sp_arw01.png'), ['controller'=> 'shop', 'detail', $medical['Shop']['shop_id']], ['escape'=> false]);
                                        ?>
                                    </div>
                                </dd>
                            </dl>
                        </li>
                        <?php
                    }
                    ?>
                </ul>
            </div>
            <div id="tab06" class="tab_box">
                <ul>
                    <li>
                        <dl class="cf">
                            <dt class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www20.a8.net/svt/bgt?aid=180906754618&wid=001&eno=01&mid=s00000010841003009000&mc=1" alt=""></a></dt>
                            <dd class="right_box">
                                <div class="titlearea">
                                    <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">ケノン</a>
                                    <div class="star_box">
                                        <div class="star-rating-box">
                                            <div class="empty-star">★★★★★</div>
                                            <div class="filled-star" style=" width: 100%;">★★★★★</div>
                                        </div>
                                        <span class="points">5.00</span>
                                    </div>
                                </div>
                                <p class="nol">2回の照射で足の毛はほとんど抜けました！脇はまだ残っているのですが、あと数回やればきれいになりそうな感じです。非常に満足しています</p>
                                <span class="ymd">2018.10.12</span>
                                <div class="ta_r"><a href="/column/epilator/ke-non/">詳細はこちら</a></div>
                                <div class="arw_btn sp"><a href="/column/epilator/ke-non/"><img src="https://puril.net/img/sp_arw01.png" alt="矢印"></a></div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www20.a8.net/svt/bgt?aid=180906754618&wid=001&eno=01&mid=s00000010841003009000&mc=1" alt=""></a></dt>
                            <dd class="right_box">
                                <div class="titlearea">
                                    <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">ケノン</a>
                                    <div class="star_box">
                                        <div class="star-rating-box">
                                            <div class="empty-star">★★★★★</div>
                                            <div class="filled-star" style=" width: 100%;">★★★★★</div>
                                        </div>
                                        <span class="points">5.00</span>
                                    </div>
                                </div>
                                <p class="nol">レベル10で利用しています。毛根が深くない手足等はかなりの効果が見込めるのでラージで週一程度やるとかなり脱毛効果が見込めます。</p>
                                <span class="ymd">2018.10.12</span>
                                <div class="ta_r"><a href="/column/epilator/ke-non/">詳細はこちら</a></div>
                                <div class="arw_btn sp"><a href="/column/epilator/ke-non/"><img src="https://puril.net/img/sp_arw01.png" alt="矢印"></a></div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8GTYIA+3RWS+5ZU29"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www28.a8.net/svt/bgt?aid=180906754512&wid=001&eno=01&mid=s00000017614001016000&mc=1" alt=""></a></dt>
                            <dd class="right_box">
                                <div class="titlearea">
                                    <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8GTYIA+3RWS+5ZU29" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">レイボーテグランデ</a>
                                    <div class="star_box">
                                        <div class="star-rating-box">
                                            <div class="empty-star">★★★★★</div>
                                            <div class="filled-star" style=" width: 100%;">★★★★★</div>
                                        </div>
                                        <span class="points">5.00</span>
                                    </div>
                                </div>
                                <p class="nol">全身脱毛が何周もできますし、ヘッド自体も20万回照射できるので、コスパはいいと思います。1回１回が結構効果があるので、頑張ればヘッド交換しなくても脱毛完了しちゃくかも？って感じで、買ってよかったです。</p>
                                <span class="ymd">2018.10.12</span>
                                <div class="ta_r"><a href="/column/epilator/rei-beaute/">詳細はこちら</a></div>
                                <div class="arw_btn sp"><a href="/column/epilator/rei-beaute/"><img src="https://puril.net/img/sp_arw01.png" alt="矢印"></a></div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8GTYIA+3RWS+5ZU29"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www28.a8.net/svt/bgt?aid=180906754512&wid=001&eno=01&mid=s00000017614001016000&mc=1" alt=""></a></dt>
                            <dd class="right_box">
                                <div class="titlearea">
                                    <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+8HFE42+3W0K+5ZU29" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">レイボーテグランデ</a>
                                    <div class="star_box">
                                        <div class="star-rating-box">
                                            <div class="empty-star">★★★★★</div>
                                            <div class="filled-star" style=" width: 80%;">★★★★★</div>
                                        </div>
                                        <span class="points">4.00</span>
                                    </div>
                                </div>
                                <p class="nol">濃く太い毛は効果があったのですが、産毛とか薄い毛はあまり減ったように思いません。もうすこし様子を見てみようと思います。</p>
                                <span class="ymd">2018.10.12</span>
                                <div class="ta_r"><a href="/column/epilator/rei-beaute/">詳細はこちら</a></div>
                                <div class="arw_btn sp"><a href="/column/epilator/rei-beaute/"><img src="https://puril.net/img/sp_arw01.png" alt="矢印"></a></div>
                            </dd>
                        </dl>
                    </li>
                    <li>
                        <dl class="cf">
                            <dt class="logo"><a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});"><img src="https://www20.a8.net/svt/bgt?aid=180906754618&wid=001&eno=01&mid=s00000010841003009000&mc=1" alt=""></a></dt>
                            <dd class="right_box">
                                <div class="titlearea">
                                    <a href="https://px.a8.net/svt/ejp?a8mat=2ZPGJM+A7XWMQ+2BNE+HWXLD" class="shop"  onclick="gtag('event', 'click', {'event_category': 'af','event_label': 'all'});">ケノン</a>
                                    <div class="star_box">
                                        <div class="star-rating-box">
                                            <div class="empty-star">★★★★★</div>
                                            <div class="filled-star" style=" width: 80%;">★★★★★</div>
                                        </div>
                                        <span class="points">4.00</span>
                                    </div>
                                </div>
                                <p class="nol">8か月間使用した結果…ほとんど生えてこなくなりました！最近の使用は１ヶ月に１度程度。１～２本の細い毛を処理する程度です。</p>
                                <span class="ymd">2018.10.12</span>
                                <div class="ta_r"><a href="/column/epilator/ke-non/">詳細はこちら</a></div>
                                <div class="arw_btn sp"><a href="/column/epilator/ke-non/"><img src="https://puril.net/img/sp_arw01.png" alt="矢印"></a></div>
                            </dd>
                        </dl>
                    </li>
                </ul>
            </div>
        </div>
        <div class="bnr_area pc">
            <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_1080200.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
        </div>
        <div class="bnr_area sp">
            <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_600500.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
        </div>
</section><!--/#sec03-->
<section id="sec04" class="sec">
    <div class="inner">
        <h2 class="maintit ribon ribon-pink "><span>みんなの<span class="pink">脱毛コラム</span></span></h2>
        <p class="txt mgn">脱毛に関する情報が満載！脱毛の種類や費用、必要な期間から、サロン・クリニックの選び方や安く抑える方法まで、<br>脱毛の気になるギモンを解決するお役立ち情報が満載♪脱毛で美しい肌を手に入れるためにも、必見ですよ！</p>
        <ul id="column_menu" class="cf">
            <li>
                <a href="/column/useful/">
                    <img src="https://puril.net/img/column01.png" alt="脱毛お役立ち情報">
                    <div class="txt_box">
                        <h3><div class="lead"><span>脱毛お役立ち情報</span></div></h3>
                        <p>脱毛を知るにはまずココから！脱毛費用の相場ってどれくらい？自分にあった脱毛方法の選び方は？必ず知っておきたい情報が満載！</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/qa/">
                    <img src="https://puril.net/img/column02.png" alt="脱毛Q&A">
                    <div class="txt_box">
                        <h3><div class="lead"><span>脱毛Q &amp; A</span></div></h3>
                        <p>気になる脱毛のギモンを徹底解説！思いもよらぬトラブルや不安も、しっかり備えておけばスムーズに対応できちゃう♪必ず一度はチェックですよ！</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/salon/">
                    <img src="https://puril.net/img/column03.png" alt="脱毛サロン情報">
                    <div class="txt_box">
                        <h3><div class="lead"><span>脱毛サロン情報</span></div></h3>
                        <p>美肌効果も期待できる脱毛サロン！自分にあった脱毛サロンを選ぶコツとは？評判がいいサロンはどこ？気になるポイントを徹底解説♪</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/clinic/">
                    <img src="https://puril.net/img/column04.png" alt="医療脱毛クリニック情報">
                    <div class="txt_box">
                        <h3><div class="lead"><span>医療脱毛<br class="sp">クリニック情報</span></div></h3>
                        <p>より短期間に、より高い脱毛効果を求めるなら医療脱毛が一番！行くべき診療科や費用、サロンとの違い等、医療脱毛クリニックに関するアレコレをご紹介♪</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/mens/">
                    <img src="https://puril.net/img/column05.png" alt="メンズ脱毛">
                    <div class="txt_box">
                        <h3><div class="lead"><span>メンズ脱毛</span></div></h3>
                        <p>今は男性も脱毛をする時代！ムダ毛のないキレイなボディは、モテるための必須条件。処理のポイントやサロン選びのコツを紹介します！</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/epilator/">
                    <img src="https://puril.net/img/column06.png" alt="家庭用脱毛器">
                    <div class="txt_box">
                        <h3><div class="lead"><span>家庭用脱毛器</span></div></h3>
                        <p>家庭用脱毛器は選び方が重要！家庭用脱毛器を使う際の注意点やよくあるトラブル、脱毛器の選び方や人気のアイテムをご紹介★</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/cream/">
                    <img src="https://puril.net/img/column07.png" alt="脱毛クリーム">
                    <div class="txt_box">
                        <h3><div class="lead"><span>脱毛クリーム</span></div></h3>
                        <p>脱毛クリームで本当に脱毛できる？正しい使い方とは？自宅で簡単にできる脱毛クリームのメリットデメリットや人気のクリームを紹介します！</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/soap/">
                    <img src="https://puril.net/img/column08.png" alt="脱毛石鹸">
                    <div class="txt_box">
                        <h3><div class="lead"><span>脱毛石鹸</span></div></h3>
                        <p>石鹸でも脱毛効果が期待できるってご存知でしたか？脱毛石鹸とは何か、購入できる場所やアイテムの選び方を解説します！</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/wax/">
                    <img src="https://puril.net/img/column09.png" alt="ブラジリアンワックス">
                    <div class="txt_box">
                        <h3><div class="lead"><span>ブラジリアン<br class="sp">ワックス</span></div></h3>
                        <p>手軽さから注目を浴びているブラジリアンワックス！気になる痛みや安全性、導入しているサロン等を徹底解説♪</p>
                    </div>
                </a>
            </li>
            <li>
                <a href="/column/campaign/">
                    <img src="https://puril.net/img/column10.png" alt="キャンペーン・モニター">
                    <div class="txt_box">
                        <h3><div class="lead"><span>キャンペーン<br class="sp">・モニター</span></div></h3>
                        <p>お得に脱毛するならキャンペーンやモニターの活用が必須！今、おすすめのキャンペーンとは？最新情報を随時更新中♪</p>
                    </div>
                </a>
            </li>
        </ul><!--/#column_menu-->
    </div>
</section><!--/#sec04-->
<section id="sec05" class="sec">
    <div class="inner">
        <h2 class="maintit pc ribon ribon-pink"><span>Purilが教える、脱毛迷子が<br class="sp">必ずやるべき<span class="pink">5STEP！</span></span></h2>
        <ul id="step_wrap">
            <li class="step">
                <dl>
                    <dt><img src="https://puril.net/img/step1.jpg" alt="STEP1"></dt>
                    <dd class="dd-num"><span class="step-num">STEP1</span></dd>
                    <dd class="dd-text">
                        <h3 class="tit">脱毛の種類をよく知ろう！</h3>
                        <p class="txt">
                            脱毛には、光脱毛やレーザー脱毛といった様々な種類があることをご存知ですか？さらに、その種類によってメリットやデメリット、費用、注意点も異なるんです！自分に合わない脱毛方法を選ぶと、肌トラブルを起こすことも…。<br>
                            まずは、基本となる脱毛の種類を知るコトから始めていきましょう！
                        </p>
                    </dd>
                </dl>
                <div class="recommend">
                    <div class="tit"><span>おすすめコラム</span></div>
                    <ul class="cf">
                        <li><a href="/column/useful/types/">脱毛の種類、いくつある？10種のメリット・デメリット比較検証！</a></li>
                        <li><a href="/column/useful/types/salon/">脱毛サロンが行う「光脱毛」の種類や仕組みって？脱毛で後悔する前に</a></li>
                        <li><a href="/column/useful/types/clinic/">医療レーザー脱毛の仕組みやリスクを知ろう！【失敗事例付き】</a></li>
                        <li><a href="/column/useful/types/home/">自宅でできるおすすめ脱毛法6選！安心・簡単・安い方法はどれ！？</a></li>
                        <li><a href="/column/useful/types/eikyu/">永久脱毛とは？ほとんどの人が間違えている驚愕の事実を解説！</a></li>
                        <li><a href="/column/useful/types/self/">セルフ脱毛・自己処理が招く悲劇とは？絶対注意すべき5つのポイント</a></li>
                    </ul>
                </div>
            </li>
            <li class="arrow">
                <img src="https://puril.net/img/home/column_arrow.png" alt="">
            </li>
            <li class="step">
                <dl>
                    <dt><img src="https://puril.net/img/step2.jpg" alt="STEP2"></dt>
                    <dd class="dd-num"><span class="step-num">STEP2</span></dd>
                    <dd class="dd-text">
                        <h3 class="tit">自分に合った脱毛部位をしっかり見極めよう！</h3>
                        <p class="txt">
                            脱毛の種類を理解したら、次は脱毛部位ごとの特徴をチェック！<br>
                            ワキ毛やすね毛といった王道の脱毛部位から、VIOラインやうなじなど、部位によっても特徴や注意点は異なるんです。<br>
                            他の人たちはどの部位を脱毛しているの？そうした疑問もスッキリ解決！あなたに合った脱毛部位を見つけていきましょう。
                        </p>
                    </dd>
                </dl>
                <div class="recommend">
                    <div class="tit"><span>おすすめコラム</span></div>
                    <ul class="cf">
                        <li><a href="/column/useful/parts/">脱毛部位って全部でいくつ？部位ごとの特徴から、脱毛適正を診断！</a></li>
                        <li><a href="/column/useful/parts/popular/">脱毛で人気の部位はどこ？ 1,000人に聞いた部分脱毛トレンドをご紹介♪</a></li>
                        <li><a href="/column/useful/parts/compare/">全身脱毛と部分脱毛のメリットとデメリットを徹底比較！</a></li>
                        <li><a href="/column/useful/parts/merit-demerit/">全身脱毛のメリット・デメリット｜人気のプランも合わせてご紹介！</a></li>
                        <li><a href="/column/useful/parts/face/">顔脱毛のメリット・デメリット｜肌トラブル解消も！その反面…？</a></li>
                        <li><a href="/column/useful/parts/jaw/">あご・ひげ脱毛のメリット・デメリット｜1000人の体験談で完全理解</a></li>
                        <li><a href="/column/useful/parts/underarm-hair/">ワキ脱毛のメリット・デメリット｜脇の黒ずみは？汗の量は減るの？</a></li>
                        <li><a href="/column/useful/parts/breast/">胸脱毛を行うメリット・デメリット｜異性が気にする上位のムダ毛！</a></li>
                        <li><a href="/column/useful/parts/back/">背中脱毛のメリット・デメリット｜脱毛面積の広さには要注意！</a></li>
                        <li><a href="/column/useful/parts/violine/">VIO脱毛のメリット・デメリット｜自己処理のリスク、こんなにあるの？</a></li>
                    </ul>
                </div>
            </li>
            <li class="arrow">
                <img src="https://puril.net/img/home/column_arrow.png" alt="">
            </li>
            <li class="step">
                <dl>
                    <dt><img src="https://puril.net/img/step3.jpg" alt="STEP3"></dt>
                    <dd class="dd-num"><span class="step-num">STEP3</span></dd>
                    <dd class="dd-text">
                        <h3 class="tit">脱毛の費用と効果、期間と回数をしっかり学ぼう！</h3>
                        <p class="txt">
                            脱毛で気になるのはやっぱり費用。実は、サロンかクリニックかということだけでも変わるんですよ！さらに、同じサロンでも店舗や部位によって異なるもの。<br>
                            ここでは、あなたが希望していている脱毛部位の費用や期間等の情報を整理して、分かりやすくお届けします！
                        </p>
                    </dd>
                </dl>
                <div class="recommend">
                    <div class="tit"><span>おすすめコラム</span></div>
                    <ul class="cf">
                        <li><a href="/column/useful/cost/">脱毛の費用と効果を比較！サロン？クリニック？自宅？あなたはどれ向き！？</a></li>
                        <li><a href="/column/useful/cost/salon/">脱毛サロンで料金が安いのはどこ！？費用と効果を部位別に徹底検証！</a></li>
                        <li><a href="/column/useful/cost/clinic/">医療脱毛の料金、実は割安な場合がある？！ 脱毛サロンと比較してみた。</a></li>
                        <li><a href="/column/useful/cost/home/">自宅でできる脱毛、ホントに効果あるの？費用と効果を徹底検証</a></li>
                        <li><a href="/column/useful/cost/total-body/">【最新】全身脱毛の費用と効果を完全解説。コスパ最強の脱毛はどれ！？</a></li>
                        <li><a href="/column/useful/cost/face/">顔脱毛の効果って、ぶっちゃけ費用に見合うの？口コミ大調査を敢行！</a></li>
                        <li><a href="/column/useful/time/">脱毛完了までの回数、最短で何回！？短期間で脱毛を終えたい人必見！</a></li>
                        <li><a href="/column/useful/time/part/">脱毛は部位によって毛周期が違う！サロンに通う回数を減らすコツとは</a></li>
                        <li><a href="/column/useful/time/total-body/">全身脱毛にかかる期間は平均〇年？回数を増やすだけではダメな理由</a></li>
                        <li><a href="/column/useful/time/face/">顔脱毛にかかる期間は何年？ツルツル肌になるためのベストな回数</a></li>
                    </ul>
                </div>
            </li>
            <li class="arrow">
                <img src="https://puril.net/img/home/column_arrow.png" alt="">
            </li>
            <li class="step">
                <dl>
                    <dt><img src="https://puril.net/img/step4.jpg" alt="STEP4"></dt>
                    <dd class="dd-num"><span class="step-num">STEP4</span></dd>
                    <dd class="dd-text">
                        <h3 class="tit">あなたは脱毛サロン？クリニック？確かな情報で</h3>
                        <p class="txt">
                            脱毛をする場所を考えるときに、サロンに行くかクリニックに行くかで迷いますよね？<br>
                            場所によっては、全身しかやっていない、希望する部位の脱毛をやっていないということもあります。<br>
                            「何を基準にお店を選べばいいかわからない！」というあなたへ、お店の選び方やおすすめの店舗をご紹介します★
                        </p>
                    </dd>
                </dl>
                <div class="recommend">
                    <div class="tit"><span>おすすめコラム</span></div>
                    <ul class="cf">
                        <li><a href="/column/salon/">【総集編】脱毛サロンおすすめランキングBEST20！（2018年8月）</a></li>
                        <li><a href="/column/salon/total-body/">【全身脱毛】脱毛サロンおすすめBEST20！2018年版 人気ランキングをご紹介！</a></li>
                        <li><a href="/column/salon/face/">【顔脱毛】脱毛サロンおすすめBEST20！2018年版 人気ランキングをご紹介！</a></li>
                        <li><a href="/column/salon/violine/">【VIO脱毛】脱毛サロンおすすめBEST20！2018年版 人気ランキングをご紹介！</a></li>
                        <li><a href="/column/clinic/">医療脱毛クリニックの総合おすすめランキング20選【技術ピカイチ選】</a></li>
                        <li><a href="/column/clinic/total-body/">全身脱毛でおすすめの医療脱毛クリニック20選！ランキングでご紹介！</a></li>
                    </ul>
                </div>
            </li>
            <li class="arrow">
                <img src="https://puril.net/img/home/column_arrow.png" alt="">
            </li>
            <li class="step">
                <dl>
                    <dt><img src="https://puril.net/img/step5.jpg" alt="STEP5"></dt>
                    <dd class="dd-num"><span class="step-num">STEP5</span></dd>
                    <dd class="dd-text">
                        <h3 class="tit">まだ悩む？それなら、脱毛モニターやキャンペーンもアリ！</h3>
                        <p class="txt">
                            できるだけ脱毛の費用を抑えたい！という願いは、誰もが思うこと。<br>
                            また、脱毛を完了させるには時間がかかりますから、本当に信頼できるサロン・クリニックなのかということは、できれば始める前に知っておきたいですよね？<br>
                            そんなあなたへ、事前に試せる脱毛モニターやキャンペーンをご紹介します♪まずはお試しで、というのはいかがですか？
                        </p>
                    </dd>
                </dl>
                <div class="recommend">
                    <div class="tit"><span>おすすめコラム</span></div>
                    <ul class="cf">
                        <li><a href="/column/campaign/">脱毛オトク情報｜キャンペーン・モニター情報でオトクに脱毛！</a></li>
                        <li><a href="/column/qa/advantage/">脱毛の掛け持ちで最高に得する方法とは？</a></li>
                    </ul>
                </div>
            </li>
        </ul><!--/#step_wrap-->
        <div class="bnr_area pc">
            <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_1080200.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
        </div>
        <div class="bnr_area sp">
            <a href="https://line.me/R/ti/p/%40tme6063x" target="_blank"><?php echo $this->Html->image('/img/datsumobnr_600500.jpg', ['alt'=> 'あなたに合った脱毛、ツルツル女子が３分で見つけます！']);?></a>
        </div>
    </div>
</section><!--/#sec05-->

<section id="sec06" class="sec">
    <div class="inner">
        <h2 class="maintit ribon ribon ribon-blue"><span>ツル肌メンズはモテる！？<br class="sp"><span class="blue">メンズ脱毛</span>のススメ</span></h2>
        <ul class="column_wrap cf">
            <li>
                <article class="article cf">
                    <a href="/column/mens/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/mens_01.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3 class="lead elps e2">メンズ脱毛で、「これなら間違いない」を20時間かけてまとめてみた</h3>
                            <p class="txt elps e2">男性も脱毛する人が増えていることをご存知ですか？ムダ毛がしっかり処理された肌は、女性からも評価が高いものです。そこで、メンズ脱毛はどこでできるのか、費用や、注意点は何かをまとめました。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/mens/cost/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/mens_02.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3 class="lead elps e2">メンズ脱毛の料金相場って？低価格なサロン・クリニックはここ！</h3>
                            <p class="txt elps e2">メンズ脱毛っていくらかかるの？どのくらい効果があるの？最近増えてきたメンズ脱毛の料金相場やお店選びのポイント、おすすめサロン・クリニックを紹介します。自分にぴったりのメンズ脱毛で清潔感のある男性を目指しましょう！</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/mens/merit-demerit/shin-hair/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/mens_03.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3 class="lead elps e2">すね毛脱毛のメリット・デメリット｜男はツルツル不要！減らすだけでOK。</h3>
                            <p class="txt elps e2">男のすね毛は徹底的に処理するのが良いのか？それとも手を加えずにそのままにしておくのが良いのか？ヒゲや鼻毛のように「とりあえず剃っておけば良い部位」と違い、すね毛は普段あまり露出しない分どうしたら良いのか対応に困りますよね。今回は「男性のすね毛はどうするのが良いのか？」と共に、すね毛脱毛の種類やメリット・デメリットについてご紹介します。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/mens/cost/shin-hair/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/mens_04.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3 class="lead elps e2">すね毛脱毛にかかる費用・効果を解説！メンズも脱毛が新常識</h3>
                            <p class="txt elps e2">普段はあまり肌を露出する機会の無い男性でも、夏場にはどうしても薄着になる機会がありますよね。そこで問題になるのが、すね毛問題。綺麗さっぱり剃ってしまう方がいいのか？ それとも手を付けずに生えっぱなしにしておいた方がいいのか？すね毛脱毛にかかる費用を、期間について解説します！</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/mens/cost/jaw/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/mens_05.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3 class="lead elps e2">あご・ひげ脱毛、どのくらいの費用で効果が出るの？【失敗談も紹介】</h3>
                            <p class="txt elps e2">毎日剃っても剃っても生えてくるひげに苛立ちを覚えたことはありませんか？ 今回はそんなあご・ひげ脱毛の費用や効果についてご紹介します。光脱毛・レーザー脱毛・ニードル脱毛にかかる期間と費用を徹底解説！あなたにあった脱毛方法が見つかります。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/mens/beard/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/mens_06.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3 class="lead elps e2">あご・ひげ脱毛のメリット・デメリット｜1000人の体験談で完全理解</h3>
                            <p class="txt elps e2">今回はあご・ひげ脱毛のメリットとデメリットを徹底調査！実際にひげ脱毛経験のある1000人を対象にアンケートを実施！その回答から分かったひげ脱毛のメリット・デメリット、実際の相場やオススメのサロンについてご紹介します。</p>
                        </div>
                    </a>
                </article>
            </li>
        </ul>
    </div>
</section><!--/#sec06-->
<section id="sec07" class="sec">
    <div class="inner">
        <h2 class="maintit ribon ribon-pink"><span>自宅でできる脱毛方法もたくさんある！<br class="sp"><span class="pink">安全・安心</span>に脱毛するために</span></h2>
        <ul class="column_wrap cf">
            <li>
                <article class="article cf">
                    <a href="/column/qa/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_01.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3 class="lead elps e2">脱毛が初めてなのですが、注意点や準備事項を教えてください！</h3>
                            <p class="txt elps e2">「脱毛に通いたいけどどうすれば良いんだろう……」脱毛が初めての場合、カウンセリングに行くことすら不安ですよね。この記事では、脱毛初心者に向けて、脱毛の基礎知識や注意点、事前に知っておいた方が良い情報、脱毛の意外な嬉しい情報をお伝えします。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/useful/caution/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_02.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3><div class="lead elps e2">脱毛前に知るべき注意事項やトラブル、まとめました。</div></h3>
                            <p class="txt elps e2">脱毛前に知っておかないと脱毛効果が薄くなったり、肌トラブルの原因になる項目があります。そこで脱毛前に知っておくべき注意事項やトラブルについて、トラブルを回避するための方法、脱毛サロン・クリニックでは教えてくれない得する情報もお伝えします。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/useful/caution/pain/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_03.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3><div class="lead elps e2">【脱毛の痛みが不安な方へ】最近の脱毛は痛くない？その理由を解説</div></h3>
                            <p class="txt elps e2">脱毛の痛みについては、「脱毛は死ぬほど痛い」という意見から「輪ゴムではじかれた程度」という意見までさまざまです。ではなぜ痛みを感じるのか、痛くない脱毛方法はないのか、痛みを減らせる方法などについてお話します。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/useful/caution/salon/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_04.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3><div class="lead elps e2">脱毛サロンで起きうるトラブル15選！解決法も具体的に解説！</div></h3>
                            <p class="txt elps e2">脱毛サロンではトラブルがつきもの。実は脱毛サロンでのトラブルを事前に知っておくだけで、トラブルに巻き込まれにくくなります。後悔のない脱毛するために、脱毛サロンでのトラブルと対処法を解説します。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/epilator/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_05.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3><div class="lead elps e2">家庭用脱毛器を徹底比較！おすすめ人気ランキングBEST20【2018年最新版】</div></h3>
                            <p class="txt elps e2">今、本当にオススメできる家庭用脱毛器をまとめました。値段の違いは何か、どのような性能でどのように使うと効果的なのか等を徹底解説。幅広い値段の商品をご紹介しているので、きっとあなたに合ったアイテムが見つかります。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/cream/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_06.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3><div class="lead elps e2">脱毛クリーム徹底比較！おすすめ人気ランキングBEST20【2018年最新版】</div></h3>
                            <p class="txt elps e2">注目の脱毛・除毛クリームを集めました。オススメの使用部位もご紹介しているので、あなたに合った脱毛クリームがきっと見つかります。さらに、各アイテムの口コミもご紹介。実際の使用感や気になるポイントも解説します。</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/soap/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_07.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3><div class="lead elps e2">脱毛石鹸・スプレー徹底比較！おすすめ人気ランキングBEST20【2018年最新版】</div></h3>
                            <p class="txt elps e2">自宅で手軽に除毛・抑毛したい方へ、今、オススメの脱毛石鹸・スプレー厳選10種をご紹介します。それぞれ、どういった成分が入っていてどのような効果を期待できるのか、どのような人におすすめなのかを紹介します！あなたが知らなかったアイテムがきっと見つかります！</p>
                        </div>
                    </a>
                </article>
            </li>
            <li>
                <article class="article cf">
                    <a href="/column/wax/">
                        <div class="img_box"><div class="img" style="background-image: url(<?php echo Router::url('/img/Top/safety_08.jpg')?>);"></div></div>
                        <div class="txt_box">
                            <h3><div class="lead elps e2">ブラジリアンワックス徹底比較！おすすめ人気ランキングBEST20【2018年最新版】</div></h3>
                            <p class="txt elps e2">一気に抜ける感覚が楽しいと評判のブラジリアンワックス。特に人気が高いアイテムをまとめました！含有成分もご紹介しておりますので、肌に合うかの参考になりますよ！ブラジリアンワックスは自分に合う商品を選ぶのが鉄則。ご紹介している商品の中から、きっとあなたに合った商品も見つかります！</p>
                        </div>
                    </a>
                </article>
            </li>
        </ul>
    </div>
</section><!--/#sec07-->