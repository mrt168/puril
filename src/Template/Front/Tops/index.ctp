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
<?php
echo $this->Html->css('datsumou/search');
?>
<div class="Search bg-wht">
    <header class="Search__header">
        <div class="Search__header__inner">
            <a href="#" class="Search__header__close"><i class="fas fa-angle-left"></i> 戻る</a>
            <h1 class="Search__header__title">こだわり条件</h1>
        </div>
    </header>
    <div class="Search__contents">
        <?php
        echo $this->ExForm->create('Make', ['url'=> ['controller' => 'Makes', 'action'=> 'index'], 'type'=> 'post','id'=>'Form', 'novalidate' => true]);
        ?>
        <dl class="Search__kodawari__list">
            <dt>脱毛部位</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[depilation_site_id]" id="Datsumouparts">
                        <option value=""></option>
                        <?php
                        $this->ExForm->depilationSiteSelect('Make.depilation_site_id.', null);
                        ?>
                    </select>
                </div>
            </dd>
            <dt>価格</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[price_id]">
                        <option value=""></option>
                        <?php
                        $this->ExForm->priceSelect('Make.price_id.', null);
                        ?>
                    </select>
                </div>
            </dd>
            <dt>支払い方法</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[payment_id]">
                        <option value=""></option>
                        <?php $this->ExForm->paymentSelect('Make.payment_id.', null); ?>
                    </select>
                </div>
            </dd>
            <dt>特典・割引</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[discount_id]">
                        <option value=""></option>
                        <?php $this->ExForm->discountSelect('Make.discount_id.', null); ?>
                    </select>
                </div>
            </dd>
            <dt>脱毛タイプ</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->depilationSelect('Make.other_condition_id.', null); ?>
                    </select>
                </div>
            </dd>
            <dt>診療料(医療脱毛の場合)</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->departmentSelect('Make.other_condition_id.', null); ?>
                    </select>
                </div>
            </dd>
            <dt>サポート体制</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->supportSelect('Make.other_condition_id.', null); ?>
                    </select>
                </div>
            </dd>
            <dt>予約・受付・キャンセル</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->receptionistSelect('Make.other_condition_id.', null); ?>
                    </select>
                </div>
            </dd>
            <dt>立地・施設</dt>
            <dd>
                <div class="Search__select">
                    <select name="Make[other_condition_id][]">
                        <option value=""></option>
                        <?php $this->ExForm->locationSelect('Make.other_condition_id.', null); ?>
                    </select>
                </div>
            </dd>
        </dl>
        <dl id="" class="Search__kodawari__selected">
            <dt>現在設定している条件</dt>
            <dd id="Output"><span id="OutputArea"></span><span id="OutputDatsumouparts"></span><span id="OutputPrice"></span><span id="OutputPayment"></span><span id="OutputDatsumoutype"></span><span id="OutputConsultation"></span><span id="OutputSupport"></span><span id="OutputReception"></span><span id="OutputStation"></span></dd>
        </dl>
        <div class="Search__kodawari__btns">

            <button type="reset" id="clear" class="Search__kodawari__btn" data-type="clear">クリア</button>
            <button class="Search__kodawari__btn" data-type="search" type="submit" name="search">検索</button>
        </div>
        <?php
        echo $this->ExForm->end();
        ?>
        <!--        <div class="Search__kodawari__ranking"><a href=""><i class="fas fa-crown"></i>ランキングで検索する</a></div>-->
    </div>
</div>
<div class="top-main">
    <header class="datsumou-header">
        <?php
        echo $this->element('Front/header')
        ?>

        <div class="datsumou-header-mv">
            <h1 class="datsumou-header-mv-inner">
                <span class="datsumou-header-mv-inner__text--large">みんな</span>の<br>
                <span class="datsumou-header-mv-inner__text--middle">脱毛口コミ</span>サイト
                <span class="datsumou-header-mv-inner__text-search__list">
                    <span class="datsumou-header-mv-inner__text--small">掲載件数</span>
                    <span class="datsumou-header-mv-inner__text--middle">10000件以上！</span>
                </span>
            </h1>
        </div>
    </header>
    <main class="datsumou-main">
        <div class="datsumou-search">
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
            <div class="datsumou-search__inner">
                <h2 class="datsumou-search__title">サロン・クリニックを探す</h2>
                <!--            <ul class="datsumou-searcharea__list">-->
                <!--                <li>-->
                <!--                    <a href="">-->
                <!--                        <img src="/puril/images/datsumou-search-ico01-sp.png" alt="脱毛">-->
                <!--                        <p><span>エリア・駅</span>から探す</p>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!--                <li>-->
                <!--                    <a href="">-->
                <!--                        <img src="/puril/images/datsumou-search-ico02-sp.png" alt="リラク">-->
                <!--                        <p><span>現在地</span>から探す</p>-->
                <!--                    </a>-->
                <!--                </li>-->
                <!--            </ul>-->
            </div>
        </div>

        <div class="datsumou-search__list">
            <div class="datsumou-area__inner">
                <ul class="datsumou-area__list">
                    <li>
                        <a
                                href="<?php echo Router::url('/datsumou/search')?>"><img
                                    src="/puril/images/datsumou-area-ico01-sp.png" alt="">地域<span
                                    class="small">から探す</span></a>
                    </li>
                    <!--                <li>-->
                    <!--                    <a href="">脱毛部位<span class="small">から探す</span></a>-->
                    <!--                </li>-->
                    <!--                    <li>-->
                    <!--                        <a-->
                    <!--                            href="--><?php //echo Router::url('/datsumou/brands')?><!--">脱毛サロン・クリニック一覧<span-->
                    <!--                                class="small">から探す</span></a>-->
                    <!--                    </li>-->
                    <li class="kodawari-search">
                        <a href=""><img src="/puril/images/datsumou-area-ico02-sp.png" alt="">こだわり条件<span class="small">から探す</span></a>
                    </li>
                    <li class="">
                        <a href="<?php echo Router::url('/datsumou/brands')?>">脱毛サロン、クリニック一覧<span class="small">から探す</span></a>
                    </li>
                </ul>
            </div>
        </div>

        <div class="datsumou-ranking">
            <div class="datsumou-ranking__inner">
                <h2 class="datsumou-ranking__title">
                    脱毛ランキングから探す
                </h2>
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
                                    endswitch; ?>
                                    <li>
                                        <a
                                                href="<?=$osusume['url']?>">
                                            <p
                                                    class="datsumou-ranking-panel__evaluation <?php echo $countCss; ?>">
                                                <?=number_format($osusume['star'], 2)?>
                                            </<span>
                                            <?php echo $this->Html->image($osusume['img'], ['alt'=> ''])?>
                                            <p class="datsumou-ranking-panel__text"><?=$name?>
                                            </p>
                                        </a>
                                    </li>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </ul>
                            <a href="<?php echo Router::url('/datsumou/ranking')?>"
                               class="datsumou-ranking__btn">ランキングを見るPC</a>
                        </div>
                        <div id="panel02" class="datsumou-ranking-panel-inner panel02">
                            <ul class="datsumou-ranking-panel__list">
                                <?php
                                $osusumes = [
                                    'レジーナクリニック'=> [
                                        'url'=> 'https://t.afi-b.com/visit.php?guid=ON&a=B8551a-G303613s&p=j648053O',
                                        'img'=> 'https://www.afi-b.com/upload_image/8551-1511707642-3.png',
                                        'star' => '4.89',
                                    ],
                                    'HMRクリニック'=> [
                                        'url'=> 'https://t.afi-b.com/visit.php?guid=ON&a=x10802l-5364750L&p=j648053O',
                                        'img'=> 'https://www.afi-b.com/upload_image/10802-1553274671-3.jpg',
                                        'star' => '4.74',
                                    ],
                                    'リゼクリニック'=> [
                                        'url'=> 'https://track.affiliate-b.com/visit.php?guid=ON&a=O5974K-t195506G&p=j648053O',
                                        'img'=> 'https://www.affiliate-b.com/upload_image/5974-1379886349-3.gif',
                                        'star' => '4.66',
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
                                    endswitch; ?>
                                    <li>
                                        <a
                                                href="<?=$osusume['url']?>">
                                            <p
                                                    class="datsumou-ranking-panel__evaluation <?php echo $countCss; ?>">
                                                <?=number_format($osusume['star'], 2)?>
                                            </p>
                                            <?php echo $this->Html->image($osusume['img'], ['alt'=> ''])?>
                                            <p class="datsumou-ranking-panel__text"><?=$name?>
                                            </p>
                                        </a>
                                    </li>
                                    <?php
                                    $count++;
                                }
                                ?>
                            </ul>
                            <a href="<?php echo Router::url('/datsumou/ranking')?>" class="datsumou-ranking__btn">ランキングを見る</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="datsumou-ranking">

            <div class="datsumou-evaluation">
                <div class="datsumou-evaluation__inner">
                    <h2 class="datsumou-evaluation__title">
                        新着口コミから探す
                    </h2>
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
                                        } ?>
                                        <li>
                                            <div class="voice-box">
                                                <a class="datsumou-evaluation-panel__list__img" href="<?=$shopUrl?>" <?=$blank?> onclick="gtag('event',
                                        'click', {'event_category': 'af','event_label': 'all'});">
                                                    <img src="<?php echo $imgUrl?> alt="">
                                                </a>
                                                <a href="<?php echo Router::url(['controller' => 'datsumou/shop', 'detail', $salon['Shop']['shop_id']], true);?>" class="datsumou-evaluation-panel__text">
                                                    <h3 class="datsumou-evaluation-panel__title"><?php echo $salon['Shop']['name']?>
                                                    </h3>
                                                    <p class="datsumou-evaluation-panel__thin">
                                                        <?php
                                                        if(empty($salon['question1_evaluation'])) {

                                                        } else if( mb_strlen($salon['question1_evaluation']) > 40) {
                                                            echo mb_substr($salon['question1_evaluation'],0,40).'...';
                                                        } else {
                                                            echo $salon['question1_evaluation'];
                                                        }
                                                        ?>
                                                    </p>
                                                    <p class="datsumou-evaluation-panel__star">
                                            <span class="orange">
                                                <?php
                                                $reviewCount = 0;
                                                while ($reviewCount < $salon['evaluation']):
                                                    echo '★';
                                                    $reviewCount++;
                                                endwhile; ?>
                                            </span>
                                                        <?php
                                                        while (5 - $reviewCount > 0):
                                                            echo '★';
                                                            $reviewCount++;
                                                        endwhile; ?>
                                                        <span class="red"><?php echo number_format($salon['evaluation'], 2) ?>
                                            </span>
                                                        <span class="date"><?php echo !empty($salon['post_date']) ? date('Y.m.d', strtotime($salon['post_date'])) : ""; ?></span>
                                                    </p>
                                                </a>
                                            </div>
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
        </div>
        <div class="datsumou-characteristic">
            <h2 class="datsumou-characteristic__title">
                Purilの3つの特徴
            </h2>
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
    </main>
    <a href="https://puril.net/campaign/">
        <img class="datsumou-bnr" src="/puril/images/cash-back-bnr-sp.png" alt="">
    </a>
    <?php
    echo $this->element('Front/footer') ?>
</div>
<script>
    $(function () {
        $('.datsumou-search__list .kodawari-search').click(function (e) {
            e.preventDefault();
            $('.Search').addClass('active')
            $('.top-main').hide()
            $(window).scrollTop(0)
        })
        $('.Search__header__close').click(function (e) {
            e.preventDefault();
            $('.Search').removeClass('active')
            $('.top-main').show()
        })
    });
    window.onload = function () {
        var $formObject = document.getElementById( "Form" );
        for( var $i = 0; $i < $formObject.length; $i++ ) {
            $formObject.elements[$i].onkeyup = function(){
                getValue();
            };
            $formObject.elements[$i].onchange = function(){
                getValue();
            };
        }
    }
    function getValue() {
        var $formObject = document.getElementById( "Form" );
        console.log($("#Datsumouparts").val());
        // document.getElementById( "OutputArea" ).innerHTML = $formObject.["Make.price_id"].value + '&nbsp;';
        document.getElementById( "OutputDatsumouparts" ).innerHTML = $('[name="Make[depilation_site_id]"] option:selected').text() + '&nbsp;';
        document.getElementById( "OutputPrice" ).innerHTML = $('[name="Make[price_id]"] option:selected').text() + '&nbsp;';
        document.getElementById( "OutputPayment" ).innerHTML =$('[name="Make[payment_id]"] option:selected').text() + '&nbsp;';
        document.getElementById( "OutputDatsumoutype" ).innerHTML = $('[name="Make[discount_id]"] option:selected').text() + '&nbsp;';
        var otherText = '';
        $('[name="Make[other_condition_id][]"] option:selected').each(function(){
           if($(this).text() != '') {
               otherText+= $(this).text() + ' ';
           }
        });
        document.getElementById( "OutputConsultation" ).innerHTML = otherText + '&nbsp;';
        // document.getElementById( "OutputSupport" ).innerHTML = $formObject.supportArea.value + '&nbsp;';
        // document.getElementById( "OutputReception" ).innerHTML = $formObject.receptionArea.value + '&nbsp;';
        // document.getElementById( "OutputStation" ).innerHTML = $formObject.stationArea.value + '&nbsp;';
    }
    document.getElementById("clear").onclick = function() {
        document.getElementById( "OutputArea" ).innerHTML = "";
        document.getElementById( "OutputDatsumouparts" ).innerHTML = "";
        document.getElementById( "OutputPrice" ).innerHTML = "";
        document.getElementById( "OutputPayment" ).innerHTML = "";
        document.getElementById( "OutputDatsumoutype" ).innerHTML = "";
        document.getElementById( "OutputConsultation" ).innerHTML = "";
        document.getElementById( "OutputSupport" ).innerHTML = "";
        document.getElementById( "OutputReception" ).innerHTML = "";
        document.getElementById( "OutputStation" ).innerHTML = "";
    };
</script>
</body>
